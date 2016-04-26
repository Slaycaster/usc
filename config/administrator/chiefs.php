<?php

return array(
	/**
	 * Model title
	 *
	 * @type string
	 */
	'title' => 'Chief',

	/**
	 * The singular name of your model
	 *
	 * @type string
	 */
	'single' => 'chief',

	/**
	 * The class name of the Eloquent model that this config represents
	 *
	 * @type string
	 */
	'model' => 'App\Chief',

	/**
	 * The columns array
	 *
	 * @type array
	 */
	'columns' => array(
	    'ChiefName' => array(
	        'title' => 'Chief Name'
	    ),
	    'ChiefAbbreviation' => array(
	    	'title' => 'Abbreviation (i.e. CPSM, ITMS)'
	    ),
	    'PicturePath' => array(
	    	'title' => 'Image',
	    	'output' => "<img src='/usc/public/uploads/chiefpictures/cropped/(:value)' height='100' />"
	    )

	),

	/**
	 * The edit fields array
	 *
	 * @type array
	 */
	'edit_fields' => array(
	    'ChiefName' => array(
	        'title' => 'Chief Name',
	        'type' => 'text'
	    ),
	    'ChiefAbbreviation' => array(
	    	'title' => 'Abbreviation (i.e. CPSM, ITMS)',
	    	'type' => 'text'
	    ),
	    'PicturePath' => array(
	    	'title' => 'Image',
	    	'type' => 'image',
	    	'naming' => 'random',
	    	'location' => public_path() . '/uploads/chiefpictures/originals/',
	    	'size_limit' => 2,
	    	'sizes' => array(
	    		array(300, 300, 'crop', public_path() . '/uploads/chiefpictures/cropped/', 100)
	    	)
	    )
	),

	/**
	 * The filter fields
	 *
	 * @type array
	 */
	'filters' => array(
	    'ChiefName' => array(
	        'title' => 'By Chief'
	    )
	),

	'rules' => array(
    	'ChiefName' => 'required|unique:chiefs,ChiefName',
    	'ChiefAbbreviation' => 'required|unique:chiefs,ChiefAbbreviation'
	),

	'messages' => array(
    	'ChiefName.required' => 'Chief Name is required',
    	'ChiefAbbreviation.required' => 'Chief Abbreviation is required',
    	'ChiefName.unique' => 'Chief Name must be unique',
    	'ChiefAbbreviation.unique' => 'Chief Abbreviation must be unique'
	)
);