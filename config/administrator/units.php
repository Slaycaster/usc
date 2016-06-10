<?php

return array(
	/**
	 * Model title
	 *
	 * @type string
	 */
	'title' => 'Unit',

	/**
	 * The singular name of your model
	 *
	 * @type string
	 */
	'single' => 'unit',

	/**
	 * The class name of the Eloquent model that this config represents
	 *
	 * @type string
	 */
	'model' => 'App\Unit',

	/**
	 * The columns array
	 *
	 * @type array
	 */
	'columns' => array(
	    'UnitName' => array(
	        'title' => 'Unit Name'
	    ),
	    'UnitAbbreviation' => array(
	    	'title' => 'Abbreviation (i.e. CPSM, ITMS)'
	    ),
	    'PicturePath' => array(
	    	'title' => 'Image',
	    	'output' => "<img src='/usc/public/uploads/unitpictures/cropped/(:value)' height='100' />"
	    ),
	    'StaffID' => array(
	    	'title' => 'Staff',
	    	'relationship' => 'staff',
	    	'select' => "CONCAT((:table).StaffAbbreviation, ' - ', (:table).StaffName)"

	    )
	),

	/**
	 * The edit fields array
	 *
	 * @type array
	 */
	'edit_fields' => array(
	    'UnitName' => array(
	        'title' => 'Unit Name',
	        'type' => 'text'
	    ),
	    'UnitAbbreviation' => array(
	    	'title' => 'Abbreviation (i.e. CPSM, ITMS)',
	    	'type' => 'text'
	    ),
	    'PicturePath' => array(
	    	'title' => 'Image',
	    	'type' => 'image',
	    	'naming' => 'random',
	    	'location' => public_path() . '/uploads/unitpictures/originals/',
	    	'size_limit' => 2,
	    	'sizes' => array(
	    		array(300, 300, 'crop', public_path() . '/uploads/unitpictures/cropped/', 100)
	    	)
	    ),
	    'staff' => array(
	    	'title' => 'Staff',
	    	'type' => 'relationship',
	    	'name_field' => 'StaffName'
	    )
	),

	/**
	 * The filter fields
	 *
	 * @type array
	 */
	'filters' => array(
	    'UnitName' => array(
	        'title' => 'By Unit'
	    ),
	    'staff' => array(
	    	'title' => 'By Staff',
	    	'type' => 'relationship',
	    	'name_field' => 'StaffName'
	    )
	),

	'rules' => array(
    	'UnitName' => 'required|unique:units,UnitName',
    	'UnitAbbreviation' => 'required|unique:units,UnitAbbreviation'
	),

	'messages' => array(
    	'UnitName.required' => 'Unit Name is required',
    	'UnitAbbreviation.required' => 'Unit Abbreviation is required',
    	'UnitName.unique' => 'Unit Name must be unique',
    	'UnitAbbreviation.unique' => 'Unit Abbreviation must be unique'
	)
);