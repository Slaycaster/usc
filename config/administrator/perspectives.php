<?php

return array(
	/**
	 * Model title
	 *
	 * @type string
	 */
	'title' => 'Perspective',

	/**
	 * The singular name of your model
	 *
	 * @type string
	 */
	'single' => 'perspective',

	/**
	 * The class name of the Eloquent model that this config represents
	 *
	 * @type string
	 */
	'model' => 'App\Perspective',

	/**
	 * The columns array
	 *
	 * @type array
	 */
	'columns' => array(
	    'PerspectiveName' => array(
	        'title' => 'Perspective Name'
	    )
	),

	/**
	 * The edit fields array
	 *
	 * @type array
	 */
	'edit_fields' => array(
	    'PerspectiveName' => array(
	        'title' => 'Perspective Name',
	        'type' => 'text'
	    )
	),

	'rules' => array(
    	'PerspectiveName' => 'required|unique:perspectives,PerspectiveName'
	),

	'messages' => array(
    	'PerspectiveName.required' => 'Perspective Name is required',
    	'PerspectiveName.unique' => 'Perspective must be unique'
	)

);