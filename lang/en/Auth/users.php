<?php

return [
    'title' => 'Users',
    'user'  => 'User',
    'create' => 'Add User',
    'edit' => 'Edit User',
    'show' => 'Show User',
    

    'name' => 'Name',
    'surname' => 'Surname',
    'username' => 'Username',
    'email' => 'Email',
    'gender' => 'Gender',
    'image' => 'Image',
    'password' => 'Password',
    'password_confirmation' => 'Confirm Password',
    'status' => 'Status',
    'role' => 'Role',
    'actions' => 'Actions',

    'users_trash' => 'Users Trash',
    'manage_deleted_users' => 'Manage deleted users.',
    'deleted_users_count' => 'Deleted Users.',
    'number_active_users' => 'Number of active users',

    'active' => 'Active',
    'inactive' => 'Inactive',
    'male' => 'Male',
    'female' => 'Female',

    'delete_image'  => 'Delete Image',
    'back_to_users' => 'Back to Users',
    
    'delete_confirm' => 'Are you sure you want to delete this user?',
    'restore_confirm' => 'Are you sure you want to restore this user?',
    'force_delete_confirm' => 'Warning! This user will be permanently deleted and cannot be restored Are you sure?',
    'delete_image_confirm' => 'Are you sure you want to delete the users photo?',

    'created_successfully' => 'User created successfully.',
    'updated_successfully' => 'User updated successfully.',
    'deleted_successfully' => 'User moved to trash successfully.',
    'restored_successfully' => 'User restored successfully.',
    'force_deleted_successfully' => 'User permanently deleted.',

    'enter_the_user_information_below'      => 'Enter the user information below.',
    'update_the_user_information_below'     => 'Update the user information below.',

    'password_placeholder_create' => 'Enter Password',
    'password_placeholder_edit' => 'Leave empty to keep current password',

    
    'not_found' => 'The requested user was not found.',
    'not_found_trash' => 'The requested user was not found in the trash.',

    'create_error' => 'There was a problem creating the user.',
    'update_error' => 'There was a problem updating the user.',
    'delete_error' => 'There was a problem deleting the user.',
    'restore_error' => 'There was a problem restoring the user.',
    'force_delete_error' => 'There was a problem permanently deleting the user.',
    'change_status_error' => 'There was a problem changing the user status.',
    'remove_image_error' => 'There was a problem removing the image.',

    'image_deleted_successfully' => 'User image deleted successfully.',

    'cannot_force_delete' => 'The user cannot be permanently deleted because they are associated with other data.',

    'enable_successfully' => 'User enabled successfully.',
    'disable_successfully' => 'User disabled successfully.',

    'no_deleted_users' => 'No deleted users found.',


    'validation' => [
        'name_required' => 'Name is required.',
        'name_string' => 'Name must be a string.',
        'name_max' => 'Name must not exceed 255 characters.',

        'surname_required' => 'Surname is required.',
        'surname_string' => 'Surname must be a string.',
        'surname_max' => 'Surname must not exceed 255 characters.',

        'username_required' => 'Username is required.',
        'username_string' => 'Username must be a string.',
        'username_max' => 'Username must not exceed 255 characters.',
        'username_unique' => 'Username is already in use.',

        'email_required' => 'Email address is required.',
        'email_email' => 'Please enter a valid email address.',
        'email_max' => 'Email address must not exceed 255 characters.',
        'email_unique' => 'Email address is already in use.',

        'gender_required' => 'Gender is required.',
        'gender_in' => 'Please select a valid gender.',

        'image_image' => 'The uploaded file must be an image.',
        'image_mimes' => 'The image must be JPG, JPEG, PNG, or WEBP.',
        'image_max' => 'The image size must not exceed 5 MB.',

        'password_required' => 'Password is required.',
        'password_string' => 'Password must be a string.',
        'password_min' => 'Password must be at least 8 characters.',
        'password_confirmed' => 'Password confirmation does not match.',

        'status_required' => 'User status is required.',
        'status_boolean' => 'User status is invalid.',
    ],
];