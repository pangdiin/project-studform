<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script>
	// Disable paste filter to avoid confusion on browsers on which it is enabled by default and may affect results.
	// Read more in http://docs.ckeditor.com/#!/guide/dev_advanced_content_filter-section-filtering-pasted-and-dropped-content
	CKEDITOR.config.pasteFilter = null;

	CKEDITOR.config.height = 150;
	// Auto Grow has nothing to do with ACF.
	// However, to make users comfortable while pasting content into a tiny editing area, we would let the editor grow.
	CKEDITOR.config.extraPlugins = 'autogrow';
	CKEDITOR.config.autoGrow_maxHeight = 500;
	CKEDITOR.config.autoGrow_minHeight = 150;
    CKEDITOR.config.filebrowserImageBrowseUrl = '/laravel-filemanager?type=Images';
    CKEDITOR.config.filebrowserImageUploadUrl = '/laravel-filemanager/upload?type=Images&_token=';
    CKEDITOR.config.filebrowserBrowseUrl = '/laravel-filemanager?type=Files';
    CKEDITOR.config.filebrowserUploadUrl = '/laravel-filemanager/upload?type=Files&_token=';


    // Allowed tags 
    CKEDITOR.config.allowedContent = json_decode('{{ preg_replace('/\s+/', ' ', trim(config('ckeditor.rules.tags'))) }}');
    $('.textarea').ckeditor();
</script>
