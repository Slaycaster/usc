<?php 
return array(
	/**
	 * Model title
	 *
	 * @type string
	 */
	'title' => 'Tertiary Unit Users',

	/**
	 * The singular name of your model
	 *
	 * @type string
	 */
	'single' => 'Tertiary Unit User',

	/**
	 * The class name of the Eloquent model that this config represents
	 *
	 * @type string
	 */
	'model' => 'App\UserTertiaryUnit',

	/**
	 * The columns array
	 *
	 * @type array
	 */
	'columns' => array(
	    'UserTertiaryUnitBadgeNumber' => array(
	        'title' => 'Badge Number/Plantilla (User ID)'
	    ),
	    'RankID' => array(
	    	'title' => 'Rank',
	    	'relationship' => 'rank',
	    	'select' => '(:table).RankCode'
	    ),
	    'UserTertiaryUnitFirstName' => array(
	    	'title' => 'First Name'
	    ),
	    'UserTertiaryUnitLastName' => array(
	    	'title' => 'Last Name'
	    ),
	    'UserTertiaryUnitMiddleName' => array(
	    	'title' => 'Middle Name'
	    ),
	    'UserTertiaryUnitQualifier' => array(
	    	'title' => 'Qualifer (i.e. Jr, Sr, III)'
	    ),
	    'UserTertiaryUnitPicturePath' => array(
	    	'title' => 'Unit User Photo',
	    	'output' => "<img src='/usc/public/uploads/userpictures/tertiary/cropped/(:value)' height='100' />"
	    ),
	    'UserTertiaryUnitPassword' => array(
	    	'title' => 'Password'
	    ),
	    'TertiaryUnitID' => array(
	    	'title' => 'TertiaryUnit',
	    	'relationship' => 'tertiary_unit',
	    	'select' => '(:table).TertiaryUnitAbbreviation'
	    ),
	    'UserTertiaryUnitIsActive' => array(
	    	'title' => 'Is Active?',
	    	'select' => "IF((:table).UserTertiaryUnitIsActive, 'Yes', 'No')",
	    )
	),

	/**
	 * The edit fields array
	 *
	 * @type array
	 */
	'edit_fields' => array(
	    'UserTertiaryUnitBadgeNumber' => array(
	        'title' => 'Badge Number/Plantilla',
	        'type' => 'text'
	    ),
	    'rank' => array(
	    	'title' => 'Rank',
	    	'type' => 'relationship',
	    	'name_field' => 'RankCode'
	    ),
	    'UserTertiaryUnitFirstName' => array(
	    	'title' => 'First Name',
	    	'type' => 'text'
	    ),
	    'UserTertiaryUnitLastName' => array(
	    	'title' => 'Last Name',
	    	'type' => 'text'
	    ),
	    'UserTertiaryUnitMiddleName' => array(
	    	'title' => 'Middle Name',
	    	'type' => 'text'
	    ),
	    'UserTertiaryUnitQualifier' => array(
	    	'title' => 'Qualifer (i.e. Jr, Sr, III)',
	    	'type' => 'text'
	    ),
	    'UserTertiaryUnitPicturePath' => array(
	    	'title' => 'Unit User Photo',
	    	'type' => 'image',
	    	'naming' => 'random',
	    	'location' => public_path() . '/uploads/userpictures/tertiary/originals/',
	    	'size_limit' => 2,
	    	'sizes' => array(
	    		array(300, 300, 'crop', public_path() . '/uploads/userpictures/tertiary/cropped/', 100)
	    	)
	    ),
	    'UserTertiaryUnitPassword' => array(
	    	'title' => 'Password',
	    	'type' => 'password'
	    ),
	    'tertiary_unit' => array(	
	    	'title' => 'Tertiary Unit',
	    	'type' => 'relationship',
	    	'name_field' => 'TertiaryUnitName'
	    ),
	    'UserTertiaryUnitIsActive' => array(
	    	'title' => 'Is Active',
	    	'type' => 'bool',
	    	'value' => '1'
	    )
	),

	'rules' => array(
    	'UserTertiaryUnitBadgeNumber' => 'required|unique:user_tertiary_units,UserTertiaryUnitBadgeNumber',
    	'UserTertiaryUnitFirstName' => 'required',
    	'UserTertiaryUnitLastName' => 'required',
    	'UserTertiaryUnitPassword' => 'required|min:7|max:16',
    	'RankID' => 'required',
    	'TertiaryUnitID' => 'required'
	),

	'messages' => array(
    	'UserTertiaryUnitBadgeNumber.required' => 'Badge Number is required',
    	'UserTertiaryUnitBadgeNumber.unique' => 'Badge Number must be unique',
    	'UserTertiaryUnitFirstName.required' => 'First Name is required',
    	'UserTertiaryUnitLastName.required' => 'Last Name is required',
    	'UserTertiaryUnitPassword.required' => 'Password is required',
    	'UserTertiaryUnitPassword.min' => 'Password must be minimum of 7 characters',
    	'UserTertiaryUnitPassword.max' => 'Password must be maximum of 16 characters',
    	'RankID.required' => 'Rank is required',
    	'TertiaryUnitID.required' => 'Unit is required'
	)

	
);