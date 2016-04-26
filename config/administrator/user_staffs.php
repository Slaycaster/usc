<?php 
return array(
	/**
	 * Model title
	 *
	 * @type string
	 */
	'title' => 'Staff Users',

	/**
	 * The singular name of your model
	 *
	 * @type string
	 */
	'single' => 'Staff user',

	/**
	 * The class name of the Eloquent model that this config represents
	 *
	 * @type string
	 */
	'model' => 'App\UserStaff',

	/**
	 * The columns array
	 *
	 * @type array
	 */
	'columns' => array(
	    'UserStaffBadgeNumber' => array(
	        'title' => 'Badge Number/Plantilla (User ID)'
	    ),
	    'RankID' => array(
	    	'title' => 'Rank',
	    	'relationship' => 'rank',
	    	'select' => '(:table).RankCode'
	    ),
	    'UserStaffFirstName' => array(
	    	'title' => 'First Name'
	    ),
	    'UserStaffLastName' => array(
	    	'title' => 'Last Name'
	    ),
	    'UserStaffMiddleName' => array(
	    	'title' => 'Middle Name'
	    ),
	    'UserStaffQualifier' => array(
	    	'title' => 'Qualifer (i.e. Jr, Sr, III)'
	    ),
	    'UserStaffPicturePath' => array(
	    	'title' => 'Staff User Photo',
	    	'output' => "<img src='/usc/public/uploads/userpictures/unit/cropped/(:value)' height='100' />"
	    ),
	    'UserStaffPassword' => array(
	    	'title' => 'Password'
	    ),
	    'StaffID' => array(
	    	'title' => 'Staff',
	    	'relationship' => 'staff',
	    	'select' => '(:table).StaffAbbreviation'
	    ),
	    'UserStaffIsActive' => array(
	    	'title' => 'Is Active?',
	    	'select' => "IF((:table).UserStaffIsActive, 'Yes', 'No')",
	    )
	),

	/**
	 * The edit fields array
	 *
	 * @type array
	 */
	'edit_fields' => array(
	    'UserStaffBadgeNumber' => array(
	        'title' => 'Badge Number/Plantilla',
	        'type' => 'text'
	    ),
	    'rank' => array(
	    	'title' => 'Rank',
	    	'type' => 'relationship',
	    	'name_field' => 'RankCode'
	    ),
	    'UserStaffFirstName' => array(
	    	'title' => 'First Name',
	    	'type' => 'text'
	    ),
	    'UserStaffLastName' => array(
	    	'title' => 'Last Name',
	    	'type' => 'text'
	    ),
	    'UserStaffMiddleName' => array(
	    	'title' => 'Middle Name',
	    	'type' => 'text'
	    ),
	    'UserStaffQualifier' => array(
	    	'title' => 'Qualifer (i.e. Jr, Sr, III)',
	    	'type' => 'text'
	    ),
	    'UserStaffPicturePath' => array(
	    	'title' => 'Staff User Photo',
	    	'type' => 'image',
	    	'naming' => 'random',
	    	'location' => public_path() . '/uploads/userpictures/unit/originals/',
	    	'size_limit' => 2,
	    	'sizes' => array(
	    		array(300, 300, 'crop', public_path() . '/uploads/userpictures/unit/cropped/', 100)
	    	)
	    ),
	    'UserStaffPassword' => array(
	    	'title' => 'Password',
	    	'type' => 'password'
	    ),
	    'staff' => array(
	    	'title' => 'Staff',
	    	'type' => 'relationship',
	    	'name_field' => 'StaffName'
	    ),
	    'UserStaffIsActive' => array(
	    	'title' => 'Is Active',
	    	'type' => 'bool',
	    	'value' => '1'
	    )
	),

	'rules' => array(
    	'UserStaffBadgeNumber' => 'required|unique:user_staffs,UserStaffBadgeNumber',
    	'UserStaffFirstName' => 'required',
    	'UserStaffLastName' => 'required',
    	'UserStaffPassword' => 'required|min:7|max:16',
    	'RankID' => 'required',
    	'StaffID' => 'required'
	),

	'messages' => array(
    	'UserStaffBadgeNumber.required' => 'Badge Number is required',
    	'UserStaffBadgeNumber.unique' => 'Badge Number must be unique',
    	'UserStaffFirstName.required' => 'First Name is required',
    	'UserStaffLastName.required' => 'Last Name is required',
    	'UserStaffPassword.required' => 'Password is required',
    	'UserStaffPassword.min' => 'Password must be minimum of 7 characters',
    	'UserStaffPassword.max' => 'Password must be maximum of 16 characters',
    	'RankID.required' => 'Rank is required',
    	'UnitID.required' => 'Unit is required'
	)

	
);