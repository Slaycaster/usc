<?php 
return array(
	/**
	 * Model title
	 *
	 * @type string
	 */
	'title' => 'Secondary Unit Users',

	/**
	 * The singular name of your model
	 *
	 * @type string
	 */
	'single' => 'Secondary Unit User',

	/**
	 * The class name of the Eloquent model that this config represents
	 *
	 * @type string
	 */
	'model' => 'App\UserSecondaryUnit',

	/**
	 * The columns array
	 *
	 * @type array
	 */
	'columns' => array(
	    'UserSecondaryUnitBadgeNumber' => array(
	        'title' => 'Badge Number/Plantilla (User ID)'
	    ),
	    'RankID' => array(
	    	'title' => 'Rank',
	    	'relationship' => 'rank',
	    	'select' => '(:table).RankCode'
	    ),
	    'UserSecondaryUnitFirstName' => array(
	    	'title' => 'First Name'
	    ),
	    'UserSecondaryUnitLastName' => array(
	    	'title' => 'Last Name'
	    ),
	    'UserSecondaryUnitMiddleName' => array(
	    	'title' => 'Middle Name'
	    ),
	    'UserSecondaryUnitQualifier' => array(
	    	'title' => 'Qualifer (i.e. Jr, Sr, III)'
	    ),
	    'UserSecondaryUnitPicturePath' => array(
	    	'title' => 'Unit User Photo',
	    	'output' => "<img src='/usc/public/uploads/userpictures/secondary/cropped/(:value)' height='100' />"
	    ),
	    'UserSecondaryUnitPassword' => array(
	    	'title' => 'Password'
	    ),
	    'SecondaryUnitID' => array(
	    	'title' => 'SecondaryUnit',
	    	'relationship' => 'secondary_unit',
	    	'select' => '(:table).SecondaryUnitAbbreviation'
	    ),
	    'UserSecondaryUnitIsActive' => array(
	    	'title' => 'Is Active?',
	    	'select' => "IF((:table).UserSecondaryUnitIsActive, 'Yes', 'No')",
	    )
	),

	/**
	 * The edit fields array
	 *
	 * @type array
	 */
	'edit_fields' => array(
	    'UserSecondaryUnitBadgeNumber' => array(
	        'title' => 'Badge Number/Plantilla',
	        'type' => 'text'
	    ),
	    'rank' => array(
	    	'title' => 'Rank',
	    	'type' => 'relationship',
	    	'name_field' => 'RankCode'
	    ),
	    'UserSecondaryUnitFirstName' => array(
	    	'title' => 'First Name',
	    	'type' => 'text'
	    ),
	    'UserSecondaryUnitLastName' => array(
	    	'title' => 'Last Name',
	    	'type' => 'text'
	    ),
	    'UserSecondaryUnitMiddleName' => array(
	    	'title' => 'Middle Name',
	    	'type' => 'text'
	    ),
	    'UserSecondaryUnitQualifier' => array(
	    	'title' => 'Qualifer (i.e. Jr, Sr, III)',
	    	'type' => 'text'
	    ),
	    'UserSecondaryUnitPicturePath' => array(
	    	'title' => 'Unit User Photo',
	    	'type' => 'image',
	    	'naming' => 'random',
	    	'location' => public_path() . '/uploads/userpictures/secondary/originals/',
	    	'size_limit' => 2,
	    	'sizes' => array(
	    		array(300, 300, 'crop', public_path() . '/uploads/userpictures/secondary/cropped/', 100)
	    	)
	    ),
	    'UserSecondaryUnitPassword' => array(
	    	'title' => 'Password',
	    	'type' => 'password'
	    ),
	    'secondary_unit' => array(
	    	'title' => 'Secondary Unit',
	    	'type' => 'relationship',
	    	'name_field' => 'SecondaryUnitName'
	    ),
	    'UserSecondaryUnitIsActive' => array(
	    	'title' => 'Is Active',
	    	'type' => 'bool',
	    	'value' => '1'
	    )
	),

	'rules' => array(
    	'UserSecondaryUnitBadgeNumber' => 'required|unique:user_secondary_units,UserSecondaryUnitBadgeNumber',
    	'UserSecondaryUnitFirstName' => 'required',
    	'UserSecondaryUnitLastName' => 'required',
    	'UserSecondaryUnitPassword' => 'required|min:7|max:16',
    	'RankID' => 'required',
    	'SecondaryUnitID' => 'required'
	),

	'messages' => array(
    	'UserSecondaryUnitBadgeNumber.required' => 'Badge Number is required',
    	'UserSecondaryUnitBadgeNumber.unique' => 'Badge Number must be unique',
    	'UserSecondaryUnitFirstName.required' => 'First Name is required',
    	'UserSecondaryUnitLastName.required' => 'Last Name is required',
    	'UserSecondaryUnitPassword.required' => 'Password is required',
    	'UserSecondaryUnitPassword.min' => 'Password must be minimum of 7 characters',
    	'UserSecondaryUnitPassword.max' => 'Password must be maximum of 16 characters',
    	'RankID.required' => 'Rank is required',
    	'SecondaryUnitID.required' => 'Unit is required'
	)

	
);