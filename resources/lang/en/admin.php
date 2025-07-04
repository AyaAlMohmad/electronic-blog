<?php

return [
    'dashboard' => [
        'title' => 'Admin Dashboard',
        'description' => 'Overview of your platform\'s performance',
        
        'stats' => [
            'total_posts' => 'Total Posts',
            'approved_posts' => 'Approved Posts',
            'pending_posts' => 'Pending Posts',
            'writer_requests' => 'Writer Requests',
            'total_comments' => 'Total Comments',
            'avg_likes_per_post' => 'Avg Likes/Post',
            'approval_rate' => 'Approval Rate',
        ],
        
        'charts' => [
            'monthly_posts' => '📅 Monthly Posts',
            'top_categories' => '🏷️ Most Used Categories',
            'top_liked_posts' => '👍 Top Liked Posts',
            'top_commented_posts' => '💬 Top Commented Posts',
            'top_writers' => '🧑‍💻 Top Writers',
            'active_writers' => '🌟 Most Active Writers',
            'approval_time' => '⏱️ Average Approval Time',
            'approval_time_description' => 'Time between submission and approval',
        ],
        
        'units' => [
            'hours' => 'Hours',
            'posts' => 'posts',
            'likes' => 'likes',
        ]
    ],
    'sections' => [
        'title' => 'Sections',
        'create_button' => 'Create New',
        'table' => [
            'name_ar' => 'Name (AR)',
            'name_en' => 'Name (EN)',
            'image' => 'Image',
            'actions' => 'Actions',
            'no_data' => 'No sections found',
        ],
        'actions' => [
            'view' => 'View',
            'edit' => 'Edit',
            'delete' => 'Delete',
            'delete_confirm' => 'Are you sure?',
        ],
        'card' => [
            'collapse' => 'Collapse',
            'reload' => 'Reload',
            'expand' => 'Expand',
            'close' => 'Close',
        ],
        'details' => [
            'title' => 'Section Details :id',
            'name' => 'Name',
            'image' => 'Image',
            'back_button' => 'Back',
        ],
    ],
    'create' => [
        'title' => 'Create Section',
        'submit' => 'Save',
        'cancel' => 'Cancel',
    ],
    'edit' => [
        'title' => 'Edit Section',
        'submit' => 'Update',
        'cancel' => 'Cancel',
    ],
    'form' => [
        'name' => 'Name',
        'image' => 'Image',
        'name_placeholder' => 'Enter name in :locale',
        'image_required' => 'Image is required',
    ],
    'subsections' => [
        'index' => [
            'title' => 'Subsections',
            'create_button' => 'Create New',
            'table' => [
                'name_ar' => 'Name (AR)',
                'name_en' => 'Name (EN)',
                'section' => 'Section',
                'actions' => 'Actions',
                'no_data' => 'No subsections found',
            ],
            'actions' => [
                'view' => 'View',
                'edit' => 'Edit',
                'delete' => 'Delete',
                'delete_confirm' => 'Are you sure?',
            ],
            'card' => [
                'collapse' => 'Collapse',
                'reload' => 'Reload',
                'expand' => 'Expand',
                'close' => 'Close',
            ],
        ],
        'show' => [
            'title' => 'Subsection Details :id',
            'section' => 'Section',
            'back_button' => 'Back',
        ],
        'create' => [
            'title' => 'Create Subsection',
            'submit' => 'Save',
            'cancel' => 'Cancel',
            'select_section' => 'Select Section',
        ],
        'edit' => [
            'title' => 'Edit Subsection',
            'submit' => 'Update',
            'cancel' => 'Cancel',
            'select_section' => 'Select Section',
        ],
        'form' => [
            'name' => 'Name',
            'name_placeholder' => 'Enter name in :locale',
            'section' => 'Section',
        ],
    ],
    'posts' => [
        'details' => [
            'title' => 'Post Details',
            'no_image' => 'No Image',
            'date' => 'Date',
            'short_description' => 'Short Description',
            'description' => 'Description',
            'writer' => 'Writer',
            'unknown_writer' => 'Unknown',
            'back_button' => 'Back to List',
        ],
        'pending' => [
            'title' => 'Pending Posts',
            'approved_button' => 'Approved Posts',
            'table' => [
                'id' => 'ID',
                'title' => 'Title',
                'writer' => 'Writer',
                'date' => 'Date',
                'image' => 'Image',
                'action_type' => 'Action Type',
                'actions' => 'Actions',
                'no_data' => 'No pending posts found',
                'new' => 'New',
                'edited' => 'Edited',
            ],
            'actions' => [
                'view' => 'View',
                'approve' => 'Approve',
                'delete' => 'Delete',
                'confirm_delete' => 'Are you sure?',
               
                    'approve' => 'Approve',
                    'delete' => 'Delete',
                    'confirm_delete' => 'Are you sure you want to delete this post?',
                
            ],
            'card' => [
                'collapse' => 'Collapse',
                'reload' => 'Reload',
                'expand' => 'Expand',
                'close' => 'Close',
            ],
        ],
        'approved' => [
            'title' => 'Approved Posts',
            'pending_button' => 'Pending Posts',
            'table' => [
                'id' => 'ID',
                'title' => 'Title',
                'writer' => 'Writer',
                'date' => 'Date',
                'image' => 'Image',
                'actions' => 'Actions',
                'no_data' => 'No approved posts found',
            ],
            'actions' => [
                'view' => 'View',
                'approve' => 'Approve',
                'reject' => 'Reject',
                'delete' => 'Delete',
                'confirm_approve' => 'Are you sure to approve this post?',
                'confirm_reject' => 'Are you sure to reject this post?',
                'confirm_delete' => 'Are you sure to delete this post?',
           
               
                'confirm_reject' => 'Send Rejection',
                'reject_reason' => 'Reason for Rejection',
                'reason_label' => 'Please provide a reason for rejecting this post',
            ],
        ],
     
      
    ],
    'cancel' => 'Cancel',    
    'about_us' => [
        'index' => [
            'title' => 'About Us',
            'create_button' => 'Create New',
            'table' => [
                'title_ar' => 'Title (AR)',
                'title_en' => 'Title (EN)',
                'short_description_ar' => 'Short Description (AR)',
                'short_description_en' => 'Short Description (EN)',
                'image' => 'Image',
                'actions' => 'Actions',
                'no_data' => 'No about us content found',
            ],
            'actions' => [
                'view' => 'View',
                'edit' => 'Edit',
                'delete' => 'Delete',
                'delete_confirm' => 'Are you sure?',
            ],
            'card' => [
                'collapse' => 'Collapse',
                'reload' => 'Reload',
                'expand' => 'Expand',
                'close' => 'Close',
            ],
        ],
        'show' => [
            'title' => 'About Us Details :id',
            'title_label' => 'Title',
            'description_label' => 'Description',
            'short_description_label' => 'Short Description',
            'image_label' => 'Image',
            'back_button' => 'Back',
        ],
        'create' => [
            'title' => 'Create About Us',
            'submit' => 'Save',
            'cancel' => 'Cancel',
            'title_placeholder' => 'Enter title in :locale',
            'description_placeholder' => 'Enter description in :locale',
            'short_description_placeholder' => 'Enter short description in :locale',
            'image_required' => 'Image is required',
        ],
        'edit' => [
            'title' => 'Edit About Us',
            'submit' => 'Update',
            'cancel' => 'Cancel',
            'title_placeholder' => 'Enter title in :locale',
            'description_placeholder' => 'Enter description in :locale',
            'short_description_placeholder' => 'Enter short description in :locale',
        ],
    ],
    'contact_us' => [
        'index' => [
            'title' => 'Contact Information',
            'create_button' => 'Create New',
            'table' => [
                'email' => 'Email',
                'phone' => 'Phone',
                'fax' => 'Fax',
                'map' => 'Map',
                'address_ar' => 'Address (AR)',
                'address_en' => 'Address (EN)',
                'actions' => 'Actions',
                'no_data' => 'No contact information found',
            ],
            'actions' => [
                'view' => 'View',
                'edit' => 'Edit',
                'delete' => 'Delete',
                'delete_confirm' => 'Are you sure?',
            ],
            'card' => [
                'collapse' => 'Collapse',
                'reload' => 'Reload',
                'expand' => 'Expand',
                'close' => 'Close',
            ],
        ],
        'show' => [
            'title' => 'Contact Details',
            'email' => 'Email',
            'phone' => 'Phone',
            'fax' => 'Fax',
            'map_url' => 'Map URL',
            'address' => 'Address',
            'back_button' => 'Back',
        ],
        'create' => [
            'title' => 'Create Contact Info',
            'submit' => 'Save',
            'cancel' => 'Cancel',
            'email_placeholder' => 'Enter email',
            'phone_placeholder' => 'Enter phone',
            'fax_placeholder' => 'Enter fax',
            'map_placeholder' => 'Enter map link',
            'address_placeholder' => 'Enter address in :locale',
        ],
        'edit' => [
            'title' => 'Edit Contact Info',
            'submit' => 'Update',
            'cancel' => 'Cancel',
        ],
    ],
    'users' => [
        'index' => [
            'title' => 'Users',
            'table' => [
                'name' => 'Name',
                'email' => 'Email',
                'image' => 'Image',
                'actions' => 'Actions',
                'no_data' => 'No users found',
            ],
            'actions' => [
                'view' => 'View',
                'edit' => 'Edit',
                'delete' => 'Delete',
                'delete_confirm' => 'Are you sure?',
            ],
            'card' => [
                'collapse' => 'Collapse',
                'reload' => 'Reload',
                'expand' => 'Expand',
                'close' => 'Close',
            ],
        ],
        'show' => [
            'title' => 'User Details :id',
            'name' => 'Name',
            'email' => 'Email',
            'image' => 'Image',
            'back_button' => 'Back',
        ],
        'edit' => [
            'title' => 'Edit User',
            'submit' => 'Save Changes',
            'cancel' => 'Cancel',
            'name' => 'Full Name',
            'email' => 'Email Address',
            'image' => 'Profile Image',
            'is_admin' => 'Administrator',
            'is_writer' => 'Writer',
        ],
    ],
    'writers' => [
        'approve' => [
            'title' => 'Approve Writer: :name',
            'current_info' => 'Current User Info',
            'name' => 'Name',
            'email' => 'Email',
            'bio_ar' => 'Biography (Arabic)',
            'bio_en' => 'Biography (English)',
            'subsection' => 'Subsection',
            'select_subsection' => 'Select Subsection',
            'profile_image' => 'Profile Image',
            'keep_current_image' => 'Leave empty to use current profile image',
            'back' => 'Back',
            'approve_button' => 'Approve Writer',
        ],
        'approved' => [
            'title' => 'Approved Writers',
            'table' => [
                'id' => 'ID',
                'name' => 'Name',
                'email' => 'Email',
                'profile' => 'Writer Profile',
                'actions' => 'Actions',
                'no_data' => 'No approved writers',
                'no_image' => 'No Image',
            ],
            'actions' => [
                'view' => 'View',
                'revoke' => 'Revoke',
                'revoke_confirm' => 'Revoke writer privileges?',
            ],
        ],
        'pending' => [
            'title' => 'Pending Writer Requests',
            'approved_button' => 'Approved Writers',
            'table' => [
                'id' => 'ID',
                'name' => 'Name',
                'email' => 'Email',
                'profile' => 'Profile',
                'actions' => 'Actions',
                'no_data' => 'No pending writer requests',
                'no_image' => 'No Image',
            ],
            'actions' => [
                'approve' => 'Approve',
                'reject' => 'Reject',
                'reject_confirm' => 'Are you sure?',
            ],
            'card' => [
                'collapse' => 'Collapse',
                'reload' => 'Reload',
                'expand' => 'Expand',
                'close' => 'Close',
            ],
        ],
        'show' => [
            'title' => 'Writer Profile',
            'member_since' => 'Member since: :date',
            'biography' => 'Biography',
            'user_info' => 'User Information',
            'status' => 'Status',
            'approved_writer' => 'Approved Writer',
            'writer_details' => 'Writer Details',
            'subsection' => 'Subsection',
            'articles_written' => 'Articles Written',
            'approved_on' => 'Approved On',
            'back_button' => 'Back to List',
        ],
    ],
  

];