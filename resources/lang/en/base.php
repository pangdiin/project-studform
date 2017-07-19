<?php

return [
	'alerts'    => [
		'default' => [
			'title' => 'Information',
	    	'class'	=> 'info',
	    	'icon'	=> 'fa fa-info',
	    	'message' => 'Null'
		],

	    'success' => [
	    	'title' => 'Request Success',
	    	'icon'	=> 'fa fa-check',
	    	'class'	=> 'success',
	    	'messages' => [
	    		'created'             => ':attribute has been successfully created.'  ,
			    'deleted'             => ':attribute has been successfully deleted.'  ,
			    'deleted_permanently' => ':attribute has been deleted permanently.'   ,
			    'restored'            => ':attribute has been successfully restored.' ,
			    'updated'             => ':attribute has been successfully updated.'  ,
	    	]
	    ],
	    'failed' => [
	    	'title' => 'Request Failed',
	    	'icon'	=> 'fa fa-times',
	    	'class' => 'danger',
	    	'messages' => [
	    		'created'             => 'There was an error in creating the :attribute.'  ,
			    'deleted'             => 'There was an error in deleting the :attribute.'  ,
			    'deleted_permanently' => 'There was an error in deleting permanently the :attribute.'   ,
			    'restored'            => 'There was an error in restoring the :attribute.' ,
			    'updated'             => 'There was an error in updating the :attribute'  ,
	    	]
	    ],
	    'info'	=> [
	    	'title' => 'Information',
	    	'icon'	=> 'fa fa-info-circle',
	    	'class' => 'info',
	    	'messages' => [
	    		'created'             => 'There was an error in creating the :attribute.'  ,
			    'deleted'             => 'There was an error in deleting the :attribute.'  ,
			    'deleted_permanently' => ':attribute has been deleted permanently.'   ,
			    'restored'            => ':attribute has been successfully restored.' ,
			    'updated'             => ':attribute has been successfully updated.'  ,
	    	]
	    ],
	    'warning'	=> [
	    	'title' => 'Warning',
	    	'icon'	=> 'fa fa-exclamation',
	    	'class' => 'warning',
	    	'messages' => [
	    		'created'             => 'There was an error in creating the :attribute.'  ,
			    'deleted'             => 'There was an error in deleting the :attribute.'  ,
			    'deleted_permanently' => ':attribute has been deleted permanently.'   ,
			    'restored'            => ':attribute has been successfully restored.' ,
			    'updated'             => ':attribute has been successfully updated.'  ,
	    	]
	    ]
	],
	'buttons' => [
	    'add' => [
	        'label' => 'Add',
	        'class' => 'btn btn-success',
	        'icon'  => 'fa fa-plus'
	    ],
	    'create' => [
	        'label' => 'Create',
	        'class' => 'btn btn-success',
	        'icon'  => 'fa fa-plus'
	    ],

	    'edit' => [
	        'label' => 'Edit',
	        'class' => 'btn btn-primary',
	        'icon'  => 'fa fa-floppy-o'
	    ],

	    'update' => [
	        'label' => 'Update',
	        'class' => 'btn btn-primary',
	        'icon'  => 'fa fa-floppy-o'
	    ],

	    'delete' => [
	        'label' => 'Delete',
	        'class' => 'btn btn-danger',
	        'icon'  => 'fa fa-trash'
	    ],
	    'restore'   => [
            'label' => 'Restore',
            'class' => 'btn btn-info',
            'icon'  => 'fa fa-refresh'
        ],
        'permanent_delete'   => [
            'label' => 'Delete Permanently',
            'class' => 'btn btn-danger',
            'icon'  => 'fa fa-trash'
        ],

	    'save' => [
	        'label' => 'Save',
	        'class' => 'btn btn-primary',
	        'icon'  => 'fa fa-floppy-o'
	    ],

	    'save_continue' => [
	    	'label'	=> 'Save &amp; Continue',
	    	'class' => 'btn btn-success',
	    	'icon' 	=> 'fa fa-floppy-o'
	    ],

	    'view'  => [
	        'label' => 'View',
	        'class' => 'btn btn-info',
	        'icon'  => 'fa fa-search'
	    ],
	    'cancel'	=> [
	    	'label'	=> 'Cancel',
	    	'class'	=> 'btn btn-warning',
	    	'icon'	=> 'fa fa-times'
	    ],
	    'activate' 	=> [
	    	'label' => 'Activate',
	    	'class'	=> 'btn btn-success',
	    	'icon'	=> 'fa fa-play',
	    ],
	    'disable' 	=> [
	    	'label' => 'Disable',
	    	'class'	=> 'btn btn-warning',
	    	'icon'	=> 'fa fa-pause',
	    ],
	],

	'table'	=> [
		'id'				=> 'ID #',
		'name'				=> 'Name',
		'title'				=> 'Title',
		'status'			=> 'Status',
		'created_at'		=> 'Created Date',
		'updated_at'		=> 'Last Updated',
		'action'			=> 'Actions'
	],

	'search' => [
		'no_results' => 'It appears that we could not find any data.'
	],
	'history' => [
    	'created' 				=> ' has created ',
    	'updated' 				=> ' has updated ',
    	'deleted' 				=> ' has deleted ',
    	'restored' 				=> ' has restored ',
    	'permanently_deleted' 	=> ' has deleted permanently ',
    ]
];