<?php

return array(
	/**
	 * Model title
	 *
	 * @type string
	 */
	'title' => 'Secondary Unit',

	/**
	 * The singular name of your model
	 *
	 * @type string
	 */
	'single' => 'Secondary Unit',

	/**
	 * The class name of the Eloquent model that this config represents
	 *
	 * @type string
	 */
	'model' => 'App\SecondaryUnit',

	/**
	 * The columns array
	 *
	 * @type array
	 */
	'columns' => array(
	    'SecondaryUnitName' => array(
	        'title' => 'Unit Name'
	    ),
	    'SecondaryUnitAbbreviation' => array(
	    	'title' => 'Abbreviation (i.e. CPSM, ITMS)'
	    ),
	    'PicturePath' => array(
	    	'title' => 'Image',
	    	'output' => "<img src='/usc/public/uploads/secondaryunitpictures/cropped/(:value)' height='100' />"
	    ),
	    'UnitID' => array(
	    	'title' => 'Unit Office',
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
	    'SecondaryUnitName' => array(
	        'title' => 'Unit Name',
	        'type' => 'text'
	    ),
	    'SecondaryUnitAbbreviation' => array(
	    	'title' => 'Abbreviation (i.e. CPSM, ITMS)',
	    	'type' => 'text'
	    ),
	    'PicturePath' => array(
	    	'title' => 'Image',
	    	'type' => 'image',
	    	'naming' => 'random',
	    	'location' => public_path() . '/uploads/secondaryunitpictures/originals/',
	    	'size_limit' => 2,
	    	'sizes' => array(
	    		array(300, 300, 'crop', public_path() . '/uploads/secondaryunitpictures/cropped/', 100)
	    	)
	    ),
	    'unit' => array(
	    	'title' => 'Unit Name',
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
	    'SecondaryUnitName' => array(
	        'title' => 'By Unit'
	    ),
	    'unit' => array(
	    	'title' => 'By Unit',
	    	'type' => 'relationship',
	    	'name_field' => 'UnitName'
	    )
	),

	'rules' => array(
    	'SecondaryUnitName' => 'required|unique:secondary_units,SecondaryUnitName',
    	'SecondaryUnitAbbreviation' => 'required|unique:secondary_units,SecondaryUnitAbbreviation',
    	'UnitID' => 'required'
	),

	'messages' => array(
    	'SecondaryUnitName.required' => 'Secondary Unit Name is required',
    	'SecondaryUnitAbbreviation.required' => 'Secondary Unit Abbreviation is required',
    	'UnitID.required' => 'Unit is required',
    	'SecondaryUnitName.unique' => 'Unit Name must be unique',
    	'SecondaryUnitAbbreviation.unique' => 'Unit Abbreviation must be unique'
	)
);