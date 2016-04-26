<?php 
return array(
	/**
	 * Model title
	 *
	 * @type string
	 */
	'title' => 'Chief Users',

	/**
	 * The singular name of your model
	 *
	 * @type string
	 */
	'single' => 'Chief user',

	/**
	 * The class name of the Eloquent model that this config represents
	 *
	 * @type string
	 */
	'model' => 'App\UserChief',

	/**
	 * The columns array
	 *
	 * @type array
	 */
	'columns' => array(
	    'UserChiefBadgeNumber' => array(
	        'title' => 'Badge Number/Plantilla (User ID)'
	    ),
	    'RankID' => array(
	    	'title' => 'Rank',
	    	'relationship' => 'rank',
	    	'select' => '(:table).RankCode'
	    ),
	    'UserChiefFirstName' => array(
	    	'title' => 'First Name'
	    ),
	    'UserChiefLastName' => array(
	    	'title' => 'Last Name'
	    ),
	    'UserChiefMiddleName' => array(
	    	'title' => 'Middle Name'
	    ),
	    'UserChiefQualifier' => array(
	    	'title' => 'Qualifer (i.e. Jr, Sr, III)'
	    ),
	    'UserChiefPicturePath' => array(
	    	'title' => 'Chief User Photo',
	    	'output' => "<img src='/usc/public/uploads/userpictures/unit/cropped/(:value)' height='100' />"
	    ),
	    'UserChiefPassword' => array(
	    	'title' => 'Password'
	    ),
	    'ChiefID' => array(
	    	'title' => 'Chief',
	    	'relationship' => 'chief',
	    	'select' => '(:table).ChiefAbbreviation'
	    ),
	    'UserChiefIsActive' => array(
	    	'title' => 'Is Active?',
	    	'select' => "IF((:table).UserChiefIsActive, 'Yes', 'No')",
	    )
	),

	/**
	 * The edit fields array
	 *
	 * @type array
	 */
	'edit_fields' => array(
	    'UserChiefBadgeNumber' => array(
	        'title' => 'Badge Number/Plantilla',
	        'type' => 'text'
	    ),
	    'rank' => array(
	    	'title' => 'Rank',
	    	'type' => 'relationship',
	    	'name_field' => 'RankCode'
	    ),
	    'UserChiefFirstName' => array(
	    	'title' => 'First Name',
	    	'type' => 'text'
	    ),
	    'UserChiefLastName' => array(
	    	'title' => 'Last Name',
	    	'type' => 'text'
	    ),
	    'UserChiefMiddleName' => array(
	    	'title' => 'Middle Name',
	    	'type' => 'text'
	    ),
	    'UserChiefQualifier' => array(
	    	'title' => 'Qualifer (i.e. Jr, Sr, III)',
	    	'type' => 'text'
	    ),
	    'UserChiefPicturePath' => array(
	    	'title' => 'Chief User Photo',
	    	'type' => 'image',
	    	'naming' => 'random',
	    	'location' => public_path() . '/uploads/userpictures/unit/originals/',
	    	'size_limit' => 2,
	    	'sizes' => array(
	    		array(300, 300, 'crop', public_path() . '/uploads/userpictures/unit/cropped/', 100)
	    	)
	    ),
	    'UserChiefPassword' => array(
	    	'title' => 'Password',
	    	'type' => 'password'
	    ),
	    'chief' => array(
	    	'title' => 'Chief',
	    	'type' => 'relationship',
	    	'name_field' => 'ChiefName'
	    ),
	    'UserChiefIsActive' => array(
	    	'title' => 'Is Active',
	    	'type' => 'bool',
	    	'value' => '1'
	    )
	),

	'rules' => array(
    	'UserChiefBadgeNumber' => 'required|unique:user_chiefs,UserChiefBadgeNumber',
    	'UserChiefFirstName' => 'required',
    	'UserChiefLastName' => 'required',
    	'UserChiefPassword' => 'required|min:7|max:16',
    	'RankID' => 'required',
    	'ChiefID' => 'required'
	),

	'messages' => array(
    	'UserChiefBadgeNumber.required' => 'Badge Number is required',
    	'UserChiefBadgeNumber.unique' => 'Badge Number must be unique',
    	'UserChiefFirstName.required' => 'First Name is required',
    	'UserChiefLastName.required' => 'Last Name is required',
    	'UserChiefPassword.required' => 'Password is required',
    	'UserChiefPassword.min' => 'Password must be minimum of 7 characters',
    	'UserChiefPassword.max' => 'Password must be maximum of 16 characters',
    	'RankID.required' => 'Rank is required',
    	'ChiefID.required' => 'Chief is required'
	)

	
);