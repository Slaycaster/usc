<?php

return array(
	/**
	 * Model title
	 *
	 * @type string
	 */
	'title' => 'Division',

	/**
	 * The singular name of your model
	 *
	 * @type string
	 */
	'single' => 'division',

	/**
	 * The class name of the Eloquent model that this config represents
	 *
	 * @type string
	 */
	'model' => 'App\Division',

	/**
	 * The columns array
	 *
	 * @type array
	 */
	'columns' => array(
	    'DivisionName' => array(
	        'title' => 'Division Name'
	    ),
	    'DivisionAbbreviation' => array(
	    	'title' => 'Abbreviation'
	    ),
	    'DivisionPicturePath' => array(
	    	'title' => 'Image',
	    	'output' => "<img src='/usc/public/uploads/divisionpictures/cropped/(:value)' height='100' />"
	    ),
	    'UnitID' => array(
	    	'title' => 'Unit',
	    	'relationship' => 'unit',
	    	'select' => "CONCAT((:table).UnitAbbreviation, ' - ', (:table).UnitName)"
	    )
	),

	/**
	 * The edit fields array
	 *
	 * @type array
	 */
	'edit_fields' => array(
	    'DivisionName' => array(
	        'title' => 'Division Name',
	        'type' => 'text'
	    ),
	    'DivisionAbbreviation' => array(
	    	'title' => 'Abbreviation',
	    	'type' => 'text'
	    ),
	    'DivisionPicturePath' => array(
	    	'title' => 'Image',
	    	'type' => 'image',
	    	'naming' => 'random',
	    	'location' => public_path() . '/uploads/divisionpictures/originals/',
	    	'size_limit' => 2,
	    	'sizes' => array(
	    		array(300, 300, 'crop', public_path() . '/uploads/divisionpictures/cropped/', 100)
	    	)
	    ),
	    'unit' => array(
	    	'title' => 'Unit',
	    	'type' => 'relationship',
	    	'name_field' => 'UnitName'
	    )
	),

	/**
	 * The filter fields
	 *
	 * @type array
	 */
	'filters' => array(
	    'DivisionName' => array(
	        'title' => 'By Division'
	    ),
	    'unit' => array(
	    	'title' => 'By Unit',
	    	'type' => 'relationship',
	    	'name_field' => 'UnitName'
	    )
	),

	'rules' => array(
    	'DivisionName' => 'required|unique:divisions,DivisionName',
    	'DivisionAbbreviation' => 'required|unique:divisions,DivisionAbbreviation',
    	'UnitID' => 'required'
	),

	'messages' => array(
    	'DivisionName.required' => 'Division Name is required',
    	'DivisionAbbreviation.required' => 'Division Abbreviation is required',
    	'UnitID.required' => 'Unit is required',
    	'DivisionName.unique' => 'Division Name must be unique',
    	'DivisionAbbreviation.unique' => 'Division Abbreviation must be unique'
	)
);