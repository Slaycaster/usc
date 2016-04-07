<?php

return array(

	/**
	 * Model title
	 *
	 * @type string
	 */
	'title' => 'Rank',

	/**
	 * The singular name of your model
	 *
	 * @type string
	 */
	'single' => 'rank',

	/**
	 * The class name of the Eloquent model that this config represents
	 *
	 * @type string
	 */
	'model' => 'App\Rank',

	/**
	 * The columns array
	 *
	 * @type array
	 */
	'columns' => array(
	    'RankCode' => array(
	    	'title' => 'Rank Code'
	    ),
	    'RankName' => array(
	        'title' => 'Rank Name'
	    ),
	    'Hierarchy' => array(
	    	'title' => 'Hierarchy (1 being the highest)'
	    )
	),

	/**
	 * The edit fields array
	 *
	 * @type array
	 */
	'edit_fields' => array(
	    'RankCode' => array(
	    	'title' => 'Rank Code',
	    	'type' => 'text'
	    ),
	    'RankName' => array(
	        'title' => 'Rank Name',
	        'type' => 'text'
	    ),
	    'Hierarchy' => array(
	    	'title' => 'Hierarchy (1 being the highest)',
	    	'type' => 'number',
	    	'symbol' => '#'
	    )
	),

	'filters' => array(
		'RankCode' => array(
	        'title' => 'By Rank Code'
	    ),
	    'RankName' => array(
	        'title' => 'By Rank Name'
	    ),
	    'Hierarchy' => array(
	        'title' => 'By Hierarchy',
	        'type' => 'number',
	        'symbol' => '#'
	    ),
	),

	'rules' => array(
    	'RankName' => 'required|unique:ranks,RankName',
    	'RankCode' => 'required|unique:ranks,RankCode',
    	'Hierarchy' => 'required'
	),

	'messages' => array(
    	'RankName.required' => 'Rank Name is required',
    	'RankCode.required' => 'Rank Code is required',
    	'Hierarchy.required' => 'Hierarchy is required',
    	'RankName.unique' => 'Rank Name must be unique',
    	'RankCode.unique' => 'Rank Code must be unique'
	)

);