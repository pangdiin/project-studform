@section('after-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugin/dropzone.min.css') }}">
@append

@section('after-scripts')
    <script type="text/javascript" src="{{ asset('js/plugin/dropzone.min.js') }}"></script>
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
		(function ($) {
			$.fn.multipleImageDropzone = function(options){
				var settings = $.extend({
					dropzone: '',
					has_images : [],
					paramName: 'photos',
					acceptedFiles: 'image/*',
					trigger: '[name=btn_submit]',
					maxFilesize: 2,
					maxFile: 10,
					defaultImageContainer: '#image-default',
					dataForm: [],
					removeImages: []
					
				}, options);
				return this.each(function () {
		        	//if a source is specified
		            if (settings.dropzone === '') {
		                if (console) {console.log('Please specify a dropzone first'); }
		                return;
		            }

		            var form 			= $(this);
		            var drop_id 		= settings.dropzone;
		            var paramName 		= settings.paramName;
		            var maxFilesize 	= settings.maxFilesize;
		            var acceptedFiles 	= settings.acceptedFiles;
		            var urlLink			= form.attr('action');
		            var thumbnailUrls   = settings.has_images;
		            var dropzone = new Dropzone(drop_id, {
		            	url: urlLink,
		            	autoProcessQueue: false,
		            	type: 'POST',
		            	paramName: paramName,
					  	uploadMultiple: true,
		            	maxFiles: settings.maxFiles,
		            	maxFilesize: maxFilesize,
		            	acceptedFiles: acceptedFiles,
			            addRemoveLinks: true,
		            	headers: {
			                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			            },
			            init: function() {
					    	var myDropzone = this;

					    	if (thumbnailUrls) {
					            for (var i = 0; i < thumbnailUrls.length; i++) {
					                var mockFile = { 
					                    name: thumbnailUrls[i].id, 
					                    size: 12345, 
					                    status: Dropzone.COMPLETE, 
					                    url: thumbnailUrls[i].photo 
					                };
					                // Call the default addedfile event handler
					                myDropzone.emit("addedfile", mockFile);

					                // And optionally show the thumbnail of the file:
					                myDropzone.emit("thumbnail", mockFile, thumbnailUrls[i].photo);
					                myDropzone.files.push(mockFile);
					            }
					        }


					    	this.on('addedfile', function(file){
						    	$(settings.defaultImageContainer).hide();
						    });
						    this.on('removedfile', function(file){
						    	var id = file.name;
						    	settings.removeImages.push({id});
						    	if(this.files.length <= 0) {
							    	$(settings.defaultImageContainer).show();
			                    }
						    });
						    // Trigger
			                $(settings.trigger).click(function(e){
			                    e.preventDefault();
			                    e.stopPropagation();
			                    swalLoader();
			                    if(myDropzone.getQueuedFiles().length > 0){
			                        myDropzone.processQueue();
			                    }else{
			                    	if(settings.removeImages.length > 0){
			                    		swalLoader();
			                    		var _method = form.find('[name=_method]').val();
			                    		var remove = settings.removeImages;
			                    		$.ajax({
			                    			url: urlLink,
			                    			type: 'PATCH', 
			                    			dataType: 'json',
			                    			data: { method: _method, removed: remove, photos:[] },
			                    			success: function(data){
			                    				console.log(data);
			                    				swalSuccess(data.message, "reload");
			                    			}, error: function(data){
			                    				swal.close();
										        swalError("An error occured during the update of the gallery. ",'reload');
			                    			}
			                    		});

			                    	}else{
			                    		swalError("You haven't changed anything at this point.");
			                    	}

			                    }
			                });
			                this.on("sendingmultiple", function(file, xhr, formData) {
			                	form.find('select, input, textarea, textarea.textarea').each(function(key, value){
			                		var name = $(this).attr('name');
			                		formData.append(name, $(this).val());
			                	});
			                	formData.append('removed', settings.removeImages);
			                });

			                this.on("successmultiple", function(files, response) {
						      // Gets triggered when the files have successfully been sent.
						      // Redirect user or notify of success.
								swalSuccess(response.message, "dont", function(){
									reload();
								});
								
						    });
						    this.on("errormultiple", function(files, response) {
						      // Gets triggered when there was an error sending the files.
						      // Maybe show form again, and notify user of error
							    // Set Error Oops
						        this.removeFile(this.files[0]);
						        swalError(response.message);

							 //    reset();
							 //    page = 1;
								// loadTrainings({filter:"all", sort_key:"start_date", sort_dir: "DESC", page: 1});

						    });
						}
					});
		        });
			};



			
			$.fn.singleDropzoneForm = function(options){
				// Render options
		        var settings = $.extend({
		            // Form
		            dropzone: '',
		            // If image exists
		            has_image: null,
		            // paramName
		            paramName: 'image',
		            // paramName
		            acceptedFiles: 'image/*',
		            // Triger
		            trigger: '[name=btn_submit]',
					// Check if image required
		            is_image_required: true,
		            // Dropzone Settings
		            maxFilesize: 2,
		            // Default image ID
		            defaultImageContainer: '#image-default',
		            // data
		            dataForm: [], 

		            //Callbacks
		            onLoadStart: function (box) {
		            }, //Right after the button has been clicked
		            onLoadDone: function (response) {
			            swalSuccess(response.message);
		            }, //When the source has been loaded
		            onErrorDone: function (response) {
			            swalError('An error occured');
		            } //When error has occured

		        }, options);
		        return this.each(function () {
		        	//if a source is specified
		            if (settings.dropzone === '') {
		                if (console) {console.log('Please specify a dropzone first'); }
		                return;
		            }

		            // Initialize Variables
		            var form 			= $(this);
		            var drop_id 		= settings.dropzone;
		            var paramName 		= settings.paramName;
		            var maxFilesize 	= settings.maxFilesize;
		            var acceptedFiles 	= settings.acceptedFiles;
		            var urlLink			= form.attr('action');

		            var dropzone = new Dropzone(drop_id, {
		            	url: urlLink,
		            	autoProcessQueue: false,
		            	type: 'POST',
		            	paramName: paramName,
		            	maxFiles: 1,
		            	maxFilesize: maxFilesize,
		            	acceptedFiles: acceptedFiles,
			            uploadMultiple: false,
			            addRemoveLinks: true,
		            	headers: {
			                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			            },
			            init: function(){
			            	var myDropzone = this;
			            	// Adding Image
			                this.on("addedfile", function(file) {
			                    if(this.files[1] != null) {
			                        this.removeFile(this.files[0]);
			                    }
			                    if(!settings.has_image){
				                    $(drop_id).css('height', 'auto');
				                    $(drop_id).css('padding-top', '0');
			                    }
			                    $(settings.defaultImageContainer).hide();
			                });
			            	// Remove Image
			                this.on("removedfile", function(file) {
			                    $(settings.defaultImageContainer).show();
			                    if(!settings.has_image){
				                    $(drop_id).css('height', '240px');
				                    $(drop_id).css('padding-top', '60px');
				                }
			                });
			                // Trigger
			                $(settings.trigger).click(function(e){
			                    e.preventDefault();
			                    e.stopPropagation();
			                    swalLoader();
			                    if(myDropzone.getQueuedFiles().length > 0){
			                        myDropzone.processQueue();
			                    }else{
			                    	if(settings.is_image_required){
			                            swalError('Image is required.');
			                    	}else{
			                    		reload();
			                            form.submit();
			                    	}
			                    }
			                });


			                // Ajax Process
			                this.on("success", function(files, response) {
			                	settings.onLoadDone(response);
			                });


			                this.on("error", function(files, response) {
			                	settings.onErrorDone(response);
			                });

			                this.on("sending", function(file, xhr, formData) {
			                	form.find('select, input, textarea, textarea.textarea').each(function(key, value){
			                		var name = $(this).attr('name');
			                		formData.append(name, $(this).val());
			                	});
			                });
			            }
		            });
		        });
			};
		})(jQuery);
    </script>
@append