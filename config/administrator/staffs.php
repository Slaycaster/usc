<?php

return array(
	/**
	 * Model title
	 *
	 * @type string
	 */
	'title' => 'Staff',

	/**
	 * The singular name of your model
	 *
	 * @type string
	 */
	'single' => 'staff',

	/**
	 * The class name of the Eloquent model that this config represents
	 *
	 * @type string
	 */
	'model' => 'App\Staff',

	/**
	 * The columns array
	 *
	 * @type array
	 */
	'columns' => array(
	    'StaffName' => array(
	        'title' => 'Staff Name'
	    ),
	    'StaffAbbreviation' => array(
	    	'title' => 'Abbreviation (i.e. CPSM, ITMS)'
	    ),
	    'PicturePath' => array(
	    	'title' => 'Image',
	    	'output' => "<img src='/usc/public/uploads/staffpictures/cropped/(:value)' height='100' />"
	    ),
	    'ChiefID' => array(
	    	'title' => 'Chief',
	    	'relationship' => 'Chief',
	    	'select' => "CONCAT((:table).ChiefAbbreviation, ' - ', (:table).ChiefName)"
	    )
	),

	/**
	 * The edit fields array
	 *
	 * @type array
	 */
	'edit_fields' => array(
	    'StaffName' => array(
	        'title' => 'Staff Name',
	        'type' => 'text'
	    ),
	    'StaffAbbreviation' => array(
	    	'title' => 'Abbreviation (i.e. CPSM, ITMS)',
	    	'type' => 'text'
	    ),
	    'PicturePath' => array(
	    	'title' => 'Image',
	    	'type' => 'image',
	    	'naming' => 'random',
	    	'location' => public_path() . '/uploads/staffpictures/originals/',
	    	'size_limit' => 2,
	    	'sizes' => array(
	    		array(300, 300, 'crop', public_path() . '/uploads/staffpictures/cropped/', 100)
	    	)
	    ),
	    'Chief' => array(
	    	'title' => 'Chief',
	    	'type' => 'relationship',
	    	'name_field' => 'ChiefName'
	    )
	),

	/**
	 * The filter fields
	 *
	 * @type array
	 */
	'filters' => array(
	    'StaffName' => array(
	        'title' => 'By Staff'
	    ),
	    'Chief' => array(
	    	'title' => 'By Chief',
	    	'type' => 'relationship',
	    	'name_field' => 'ChiefName'
	    )
	),

	'rules' => array(
    	'StaffName' => 'required|unique:staffs,StaffName',
    	'StaffAbbreviation' => 'required|unique:staffs,StaffAbbreviation',
    	'ChiefID' => 'required'
	),

	'messages' => array(
    	'StaffName.required' => 'Staff Name is required',
    	'StaffAbbreviation.required' => 'Staff Abbreviation is required',
    	'ChiefID.required' => 'Chief is required',
    	'StaffName.unique' => 'Staff Name must be unique',
    	'StaffAbbreviation.unique' => 'Staff Abbreviation must be unique'
	)
);