@include('backend.menu.forms.components.nestables')
<script type="text/javascript" src="{{ asset('js/plugin/jquery-sortable.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugin/nested.js') }}"></script> 
<script type="text/javascript">

    (function ($) {

        $.fn.menuStructure = function (options) {
            // Render options
            var settings = $.extend({
                // Max depth
                maxDepth: 2,
                // Existing Nodes
                nodes: [],
                // To Delete Nodes
                delete_nodes: [],
                // Form
                source: '.nestable-menu',
                // Triger
                btn_add: '.add-item',
                // Triger
                trigger: '[name=btn_save]',
                //Callbacks
                onLoadStart: function (box) {
                }, //Right after the button has been clicked
                onLoadDone: function (box) {
                    reload();
                }, //When the source has been loaded
                onErrorDone: function (box) {
                } //When error has occured

            }, options);

            var tpl = {
                listGroup: $('#tpl_menu_list_group').html(),
                listItem: $('#tpl_menu_list_item').html(),
            };

            //The overlay
            var overlay = $('<div class="overlay"><div class="fa fa-refresh fa-spin"></div></div>');

            // initialize Nestable
            function initNestable(form) 
            {
                var target = form.find(settings.source);
                target.nestable({
                    group: 1,
                    maxDepth: settings.maxDepth,
                    expandBtnHTML: '',
                    collapseBtnHTML: '',
                });
            }

            /**
             * Rendering
             * Menu List Group and List Items
             */ 
            // Menu
            function renderMenu() {
                var target = $(settings.source);
                target.append(renderListGroup(settings.nodes));
            };
            // Group
            function renderListGroup(data) 
            {
                var listGroup = $(tpl.listGroup);
                data.forEach(function (value, index) {
                    listGroup.append(renderListItem(value));
                });
                return listGroup;
            };

            // Item
            function renderListItem(data) {
                var listItem = tpl.listItem;
                var itemType = array_get(data, 'type', '');

                var title = array_get(data, 'title');
                if (!array_length(title)) {
                    title = array_get(data, 'model_title', '');
                }

                listItem = listItem.replace(/__title__/gi, title);
                listItem = listItem.replace(/__type__/gi, itemType);
                var $listItem = $(listItem);

                $listItem.find('[data-field=title] input[type=text]').val(array_get(data, 'title', ''));
                $listItem.find('[data-field=icon_font] input[type=text]').val(array_get(data, 'icon_font', ''));
                $listItem.find('[data-field=css_class] input[type=text]').val(array_get(data, 'css_class', ''));
                $listItem.find('[data-field=target] select').val(array_get(data, 'target', ''));

                if (itemType !== 'custom-link') {
                    $listItem.find('[data-field=url]').remove();
                    $listItem.data('url', array_get(data, 'url', ''));
                } else {
                    $listItem.find('[data-field=url] input[type=text]').val(array_get(data, 'url', ''));
                    $listItem.data('url', array_get(data, 'url', null));
                }

                $listItem.data('id', array_get(data, 'id', ''));
                $listItem.data('related_id', array_get(data, 'related_id', ''));
                $listItem.data('type', array_get(data, 'type', ''));
                $listItem.data('title', array_get(data, 'title', ''));
                $listItem.data('model_title', array_get(data, 'model_title', ''));
                $listItem.data('icon_font', array_get(data, 'icon_font', ''));
                $listItem.data('css_class', array_get(data, 'css_class', ''));
                $listItem.data('target', array_get(data, 'target', ''));

                if (array_get(data, 'children', [])) {
                    $listItem.append(renderListGroup(array_get(data, 'children')));
                }
                return $listItem;
            }
                // body...



            // Click  Hanclers

            // In Form
            function handleDetails(form) 
            {

                /**
                 * Toggle item details
                 */
                $('body').on('click', '.dd-item .dd3-content a.show-item-details', function (event) {
                    event.preventDefault();
                    $(this).toggleClass('active');
                    $(this).closest('.dd-item').toggleClass('active');
                });

                /**
                 * Change details value
                 */
                $('body').on('change keyup', '.dd-item .item-details .fields input[type=text], .dd-item .item-details .fields select', function (event) {
                    event.preventDefault();
                    var $current = $(this);
                    var $label = $current.closest('label'),
                        $currentItem = $current.closest('.dd-item');
                    $currentItem.data($label.attr('data-field'), $current.val());
                });
            }

            // Outside Triggers

            function handleAddNew() 
            {
                var target = $(settings.source);

                /**
                 * Determine when the list group exists
                 * If not exists, create new
                 */
                if (!array_length(target.find('> .dd-list'))) {
                    target.append($(tpl.listGroup));
                }

                /**
                 * Handle click button add item
                 */
                $('body').on('click', '.box-link-menus ' + settings.btn_add, function (event) {
                    event.preventDefault();
                    var box = $(this).closest('.box-link-menus');
                    
                    switch (box.data('type')) {
                        case 'custom-link':
                            target.find('> .dd-list').append(addCustomLink(box));
                            break;
                        default:
                            target.find('> .dd-list').append(addOtherLinks(box));
                            break;
                    }
                });

                var addCustomLink = function ($_box) {
                    var data = {
                        id: null,
                        related_id: null,
                        type: $_box.data('type'),
                        title: $_box.find('input[type=text][data-field=title]').val(),
                        model_title: null,
                        url: $_box.find('input[type=text][data-field=url]').val(),
                        css_class: $_box.find('input[type=text][data-field=css_class]').val(),
                        icon_font: $_box.find('input[type=text][data-field=icon_font]').val(),
                        target: $_box.find('select[data-field=target]').val(),
                    };

                    if (!data.title || !data.url) {
                        return;
                    }

                    $_box.find('input[type=text]').val('');
                    return renderListItem(data);
                };

                var addOtherLinks = function ($_box) {
                    var globalData = {
                        id: null,
                        type: $_box.data('type'),
                    };
                    var data = [];
                    // Checkbox
                    $_box.find('input[type=checkbox]:checked').each(function () {
                        var $current = $(this);
                        var $label = $current.closest('label');
                        var currentData = $.extend(true, {
                            related_id: $current.val(),
                            title: null,
                            model_title: $label.text().trim(),
                            url: $current.closest('span').attr('data-url'),
                            css_class: '',
                            icon_font: '',
                        }, globalData);
                        data.push(renderListItem(currentData));
                    });

                    $_box.find('input[type=checkbox]').prop('checked', false);

                    // Select
                    $_box.find('option:checked').each(function () {
                        var $current = $(this);
                        var $label = $current;
                        var currentData = $.extend(true, {
                            related_id: $current.val(),
                            title: null,
                            model_title: $label.text().trim(),
                            url: $current.closest('span').attr('data-url'),
                            css_class: '',
                            icon_font: '',
                        }, globalData);
                        data.push(renderListItem(currentData));
                    });

                    $_box.find('option:checked').prop('checked', false);

                    return data;
                }

            }

            function handleRemove(form) 
            {
                /**
                 * Remove node
                 */
                $('body').on('click', '.dd-item .item-details .btn-remove', function (event) {
                    event.preventDefault();
                    var $parent = $(this).closest('.dd-item');
                    var $childs = $parent.find('> .dd-list > .dd-item');
                    if (array_length($childs)) {
                        $parent.after($childs);
                    }
                    settings.delete_nodes.push($parent.data('id'));
                    $parent.remove();
                });
            };

            return this.each(function () 
            {
                //if a source is specified
                if (settings.source === '') {
                    if (console) {
                        console.log('Please specify a source first - form()');
                    }
                    return;
                }
                //the box
                var form = $(this);
                renderMenu();
                initNestable(form);  
                handleDetails();
                handleAddNew();
                handleRemove(); 

                form.find(settings.trigger).click(function(e){
                    e.preventDefault();
                    swalLoader();

                    var nodes = json_encode($(settings.source).nestable('serialize'));
                    var deleted = json_encode(settings.delete_nodes);

                    $.ajax({
                        url: form.attr('action'),
                        type: 'POST',
                        data: {
                            _method:    'PATCH',
                            name:       form.find('[name=name]').val(),
                            position:   form.find('[name=position]').val(),
                            menu_structure: nodes,
                            delete_nodes:  deleted,
                        },
                        success:function(data){
                            // swalSuccess(data.message);
                            window.history.back();
                        },
                        error: function(data){
                            swalError(data.message);
                        }
                    });
                });
            });
        };
    })(jQuery);
</script>

