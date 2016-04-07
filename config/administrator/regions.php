<?php

return array(
	/**
	 * Model title
	 *
	 * @type string
	 */
	'title' => 'Region',

	/**
	 * The singular name of your model
	 *
	 * @type string
	 */
	'single' => 'region',

	/**
	 * The class name of the Eloquent model that this config represents
	 *
	 * @type string
	 */
	'model' => 'App\Region',

	/**
	 * The columns array
	 *
	 * @type array
	 */
	'columns' => array(
	    'RegionName' => array(
	        'title' => 'Region Name'
	    ),
	    'RegionAbbreviation' => array(
	    	'title' => 'Abbreviation (i.e. NCR, CAR)'
	    )
	),

	/**
	 * The edit fields array
	 *
	 * @type array
	 */
	'edit_fields' => array(
	     'RegionName' => array(
	        'title' => 'Region Name',
	        'type' => 'text'
	    ),
	    'RegionAbbreviation' => array(
	    	'title' => 'Abbreviation (i.e. NCR, CAR)',
	    	'type' => 'text'
	    )
	),

	'rules' => array(
    	'RegionName' => 'required|unique:regions,RegionName',
    	'RegionAbbreviation' => 'required|unique:regions,RegionAbbreviation'
	),

	'messages' => array(
    	'RegionName.required' => 'Region Name is required',
    	'RegionAbbreviation.required' => 'Region Abbreviation is required',
    	'RegionName.unique' => 'Region Name must be unique',
    	'RegionAbbreviation.unique' => 'RegionAbbreviation must be unique'
	)

);
