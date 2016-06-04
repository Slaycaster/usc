<?php

return array(
	/**
	 * Model title
	 *
	 * @type string
	 */
	'title' => 'Tertiary Unit',

	/**
	 * The singular name of your model
	 *
	 * @type string
	 */
	'single' => 'Tertiary Unit',

	/**
	 * The class name of the Eloquent model that this config represents
	 *
	 * @type string
	 */
	'model' => 'App\TertiaryUnit',

	/**
	 * The columns array
	 *
	 * @type array
	 */
	'columns' => array(
	    'TertiaryUnitName' => array(
	        'title' => 'Unit Name'
	    ),
	    'TertiaryUnitAbbreviation' => array(
	    	'title' => 'Abbreviation (i.e. CPSM, ITMS)'
	    ),
	    'PicturePath' => array(
	    	'title' => 'Image',
	    	'output' => "<img src='/usc/public/uploads/tertiaryunitpictures/cropped/(:value)' height='100' />"
	    ),
	    'SecondaryUnitID' => array(
	    	'title' => 'Secondary Unit Office',
	    	'relationship' => 'secondary_unit',
	    	'select' => "CONCAT((:table).SecondaryUnitAbbreviation, ' - ', (:table).SecondaryUnitName)"
	    )
	),

	/**
	 * The edit fields array
	 *
	 * @type array
	 */
	'edit_fields' => array(
	    'TertiaryUnitName' => array(
	        'title' => 'Unit Name',
	        'type' => 'text'
	    ),
	    'TertiaryUnitAbbreviation' => array(
	    	'title' => 'Abbreviation (i.e. CPSM, ITMS)',
	    	'type' => 'text'
	    ),
	    'PicturePath' => array(
	    	'title' => 'Image',
	    	'type' => 'image',
	    	'naming' => 'random',
	    	'location' => public_path() . '/uploads/tertiaryunitpictures/originals/',
	    	'size_limit' => 2,
	    	'sizes' => array(
	    		array(300, 300, 'crop', public_path() . '/uploads/tertiaryunitpictures/cropped/', 100)
	    	)
	    ),
	    'secondary_unit' => array(
	    	'title' => 'Secondary Unit Name',
	    	'type' => 'relationship',
	    	'name_field' => 'SecondaryUnitName'
	    )
	),

	/**
	 * The filter fields
	 *
	 * @type array
	 */
	'filters' => array(
	    'TertiaryUnitName' => array(
	        'title' => 'By Tertiary Unit'
	    ),
	    'secondary_unit' => array(
	    	'title' => 'By Secondary Unit',
	    	'type' => 'relationship',
	    	'name_field' => 'SecondaryUnitName'
	    )
	),

	'rules' => array(
    	'TertiaryUnitName' => 'required|unique:units,UnitName',
    	'TertiaryUnitAbbreviation' => 'required|unique:units,UnitAbbreviation',
    	'SecondaryUnitID' => 'required'
	),

	'messages' => array(
    	'TertiaryUnitName.required' => 'Tertiary Unit Name is required',
    	'TertiaryUnitAbbreviation.required' => 'Tertiary Unit Abbreviation is required',
    	'SecondaryUnitID.required' => 'Secondary Unit is required',
    	'TertiaryUnitName.unique' => 'Tertiary Unit Name must be unique',
    	'TertiaryUnitAbbreviation.unique' => 'Tertiary Unit Abbreviation must be unique'
	)
);