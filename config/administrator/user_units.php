<?php 
return array(
	/**
	 * Model title
	 *
	 * @type string
	 */
	'title' => 'Unit Users',

	/**
	 * The singular name of your model
	 *
	 * @type string
	 */
	'single' => 'Unit user',

	/**
	 * The class name of the Eloquent model that this config represents
	 *
	 * @type string
	 */
	'model' => 'App\UserUnit',

	/**
	 * The columns array
	 *
	 * @type array
	 */
	'columns' => array(
	    'UserUnitBadgeNumber' => array(
	        'title' => 'Badge Number/Plantilla (User ID)'
	    ),
	    'RankID' => array(
	    	'title' => 'Rank',
	    	'relationship' => 'rank',
	    	'select' => '(:table).RankCode'
	    ),
	    'UserUnitFirstName' => array(
	    	'title' => 'First Name'
	    ),
	    'UserUnitLastName' => array(
	    	'title' => 'Last Name'
	    ),
	    'UserUnitMiddleName' => array(
	    	'title' => 'Middle Name'
	    ),
	    'UserUnitQualifier' => array(
	    	'title' => 'Qualifer (i.e. Jr, Sr, III)'
	    ),
	    'UserUnitPicturePath' => array(
	    	'title' => 'Unit User Photo',
	    	'output' => "<img src='/usc/public/uploads/userpictures/unit/cropped/(:value)' height='100' />"
	    ),
	    'UserUnitPassword' => array(
	    	'title' => 'Password'
	    ),
	    'UnitID' => array(
	    	'title' => 'Unit',
	    	'relationship' => 'unit',
	    	'select' => '(:table).UnitAbbreviation'
	    ),
	    'UserUnitIsActive' => array(
	    	'title' => 'Is Active?',
	    	'select' => "IF((:table).UserUnitIsActive, 'Yes', 'No')",
	    )
	),

	/**
	 * The edit fields array
	 *
	 * @type array
	 */
	'edit_fields' => array(
	    'UserUnitBadgeNumber' => array(
	        'title' => 'Badge Number/Plantilla',
	        'type' => 'text'
	    ),
	    'rank' => array(
	    	'title' => 'Rank',
	    	'type' => 'relationship',
	    	'name_field' => 'RankCode'
	    ),
	    'UserUnitFirstName' => array(
	    	'title' => 'First Name',
	    	'type' => 'text'
	    ),
	    'UserUnitLastName' => array(
	    	'title' => 'Last Name',
	    	'type' => 'text'
	    ),
	    'UserUnitMiddleName' => array(
	    	'title' => 'Middle Name',
	    	'type' => 'text'
	    ),
	    'UserUnitQualifier' => array(
	    	'title' => 'Qualifer (i.e. Jr, Sr, III)',
	    	'type' => 'text'
	    ),
	    'UserUnitPicturePath' => array(
	    	'title' => 'Unit User Photo',
	    	'type' => 'image',
	    	'naming' => 'random',
	    	'location' => public_path() . '/uploads/userpictures/unit/originals/',
	    	'size_limit' => 2,
	    	'sizes' => array(
	    		array(300, 300, 'crop', public_path() . '/uploads/userpictures/unit/cropped/', 100)
	    	)
	    ),
	    'UserUnitPassword' => array(
	    	'title' => 'Password',
	    	'type' => 'password'
	    ),
	    'unit' => array(
	    	'title' => 'Unit',
	    	'type' => 'relationship',
	    	'name_field' => 'UnitName'
	    ),
	    'UserUnitIsActive' => array(
	    	'title' => 'Is Active',
	    	'type' => 'bool',
	    	'value' => '1'
	    )
	),

	'rules' => array(
    	'UserUnitBadgeNumber' => 'required|unique:user_units,UserUnitBadgeNumber',
    	'UserUnitFirstName' => 'required',
    	'UserUnitLastName' => 'required',
    	'UserUnitPassword' => 'required|min:7|max:16',
    	'RankID' => 'required',
    	'UnitID' => 'required'
	),

	'messages' => array(
    	'UserUnitBadgeNumber.required' => 'Badge Number is required',
    	'UserUnitBadgeNumber.unique' => 'Badge Number must be unique',
    	'UserUnitFirstName.required' => 'First Name is required',
    	'UserUnitLastName.required' => 'Last Name is required',
    	'UserUnitPassword.required' => 'Password is required',
    	'UserUnitPassword.min' => 'Password must be minimum of 7 characters',
    	'UserUnitPassword.max' => 'Password must be maximum of 16 characters',
    	'RankID.required' => 'Rank is required',
    	'UnitID.required' => 'Unit is required'
	)

	
);