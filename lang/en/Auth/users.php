<?php

return [

    'view' => [
        'title'              => 'Users',
        'create'             => 'Add User',
        'edit'               => 'Edit User',
        'show'               => 'View User',
        'permissions'        => 'User Permissions',
        'id'                 => 'ID',
        'image'              => 'Image',
        'name'               => 'Name',
        'surname'            => 'Surname',
        'gender'             => 'Gender',
        'username'           => 'Username',
        'email'              => 'Email',
        'password'           => 'Password',
        'password_confirmation' => 'Confirm Password',
        'status'             => 'Status',
        'actions'            => 'Actions',
        'male'               => 'Male',
        'female'             => 'Female',
        'active'             => 'Active',
        'inactive'           => 'Inactive',
        'module_name'        => 'Module Name',
    ],

    'index' => [
        'manage_users'   => 'Manage user accounts',
        'delete_confirm' => 'Are you sure you want to move this user to the trash?',
        'users_count'    => 'users',
    ],

    'form' => [
        'enter_the_user_information_below'  => 'Enter the user information below.',
        'update_the_user_information_below' => 'Update the user information below.',
        'password_placeholder_create'      => 'Enter the password',
        'password_placeholder_edit'        => 'Leave empty to keep the current password',
        'delete_image'                     => 'Delete Image',
        'delete_image_confirm'             => 'Are you sure you want to delete this user\'s image?',
    ],

    'role' => [
        'manage_permissions_for'   => 'Manage permissions for :name',
        'permissions_auto_save'    => 'Each permission is saved automatically when changed',
        'no_permissions_available' => 'No permissions available.',
    ],

    'show' => [
        'user_information'         => 'User Information',
        'account_information'      => 'View account information',
        'created_at'               => 'Created At',
        'updated_at'               => 'Last Updated',
        'assigned_permissions'     => 'Permissions assigned directly to this account',
        'admin_permissions_notice' => 'This user is an administrator and has full permissions according to the system settings.',
        'permission_name'          => 'Permission',
        'permission_slug'          => 'Identifier',
        'permission_action'        => 'Action',
        'permission_enabled'       => 'Enabled',
        'permission_disabled'      => 'Disabled',
        'no_assigned_permissions'  => 'No permissions are assigned to this user.',
    ],

    'trash' => [
        'users_trash'          => 'Users Trash',
        'deleted_users'        => 'Temporarily deleted users',
        'manage_deleted_users' => 'Manage deleted users',
        'back_to_users'        => 'Back to Users',
        'restore_confirm'      => 'Are you sure you want to restore this user?',
        'force_delete_confirm' => 'Warning! This user will be permanently deleted and cannot be restored. Are you sure?',
        'no_deleted_users'     => 'No deleted users found.',
        'deleted_users_count'  => 'deleted users',
    ],

    'controller' => [ /** UserController **/
        'created_successfully'       => 'User created successfully.',
        'updated_successfully'       => 'User updated successfully.',
        'deleted_successfully'       => 'User moved to trash successfully.',
        'restored_successfully'      => 'User restored successfully.',
        'force_deleted_successfully' => 'User permanently deleted.',
        'image_deleted_successfully' => 'User image deleted successfully.',
        'roles_updated_successfully' => 'User permissions updated successfully.',
        'enable_successfully'        => 'User enabled successfully.',
        'disable_successfully'       => 'User disabled successfully.',

        'not_found'                  => 'The requested user was not found.',
        'not_found_trash'            => 'The requested user was not found in the trash.',

        'create_error'               => 'There was a problem creating the user.',
        'update_error'               => 'There was a problem updating the user.',
        'delete_error'               => 'There was a problem deleting the user.',
        'restore_error'              => 'There was a problem restoring the user.',
        'force_delete_error'         => 'There was a problem permanently deleting the user.',
        'change_status_error'        => 'There was a problem changing the user status.',
        'remove_image_error'         => 'There was a problem removing the image.',
        'roles_update_error'         => 'Unable to update user permissions.',

        'new_image_delete_error'     => 'Unable to delete the new image.',
        'old_image_delete_error'     => 'Unable to delete the old image.',
        'user_image_delete_error'    => 'Unable to delete the user image.',
        'image_file_delete_error'    => 'Unable to delete the image file.',
        'image_cleanup_error'        => 'The image was unlinked from the account, but its file could not be deleted from the server.',
    ],

    'validation' => [  /** UserRequest **/
        'name_required'      => 'Name is required.',
        'name_string'        => 'Name must be a string.',
        'name_max'           => 'Name must not exceed 255 characters.',
        'surname_required'   => 'Surname is required.',
        'surname_string'     => 'Surname must be a string.',
        'surname_max'        => 'Surname must not exceed 255 characters.',
        'username_required'  => 'Username is required.',
        'username_string'    => 'Username must be a string.',
        'username_max'       => 'Username must not exceed 255 characters.',
        'username_unique'    => 'Username is already in use.',
        'email_required'     => 'Email address is required.',
        'email_email'        => 'Please enter a valid email address.',
        'email_max'          => 'Email address must not exceed 255 characters.',
        'email_unique'       => 'Email address is already in use.',
        'gender_required'    => 'Gender is required.',
        'gender_in'          => 'Please select a valid gender.',
        'image_image'        => 'The uploaded file must be an image.',
        'image_mimes'        => 'The image must be JPG, JPEG, PNG, or WEBP.',
        'image_max'          => 'The image size must not exceed 5 MB.',
        'password_required'  => 'Password is required.',
        'password_string'    => 'Password must be a string.',
        'password_min'       => 'Password must be at least 8 characters.',
        'password_confirmed' => 'Password confirmation does not match.',
        'status_required'    => 'User status is required.',
        'status_boolean'     => 'User status is invalid.',
    ],




/***************************************************************************** */
    'title' => 'Users',
    'user'  => 'User',
    'create' => 'Add User',
    'edit' => 'Edit User',
    'show' => 'Show User',
    'role' => 'Roles User',
    

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

    'new_image_delete_error'     => 'Unable to delete the new image.',
    'old_image_delete_error'     => 'Unable to delete the old image.',
    'user_image_delete_error'    => 'Unable to delete the user image.',
    'image_file_delete_error'    => 'Unable to delete the image file.',
    'image_cleanup_error'        => 'The image was unlinked from the account, but its file could not be deleted from the server.',
    'roles_updated_successfully' => 'User permissions updated successfully.',
    'roles_update_error'         => 'Unable to update user permissions.',




    'permissions'              => 'User Permissions',
    'manage_permissions_for'   => 'Manage permissions for :name',
    'permissions_auto_save'    => 'Each permission is saved automatically when changed',
    'module_name'              => 'Module Name',
    'no_permissions_available' => 'No permissions available.',

    'permission_actions' => [
        'index'        => 'List',
        'create'       => 'Create',
        'edit'         => 'Edit',
        'show'         => 'View Details',
        'delete'       => 'Delete',
        'trash'        => 'Trash',
        'restore'      => 'Restore',
        'force_delete' => 'Delete Permanently',
        'remove_image' => 'Remove Image',
        'status'       => 'Change Status',
    ],

    'modules' => [
        'admin'     => 'Administrator',
        'user'      => 'Regular User',
        'dashboard' => 'Dashboard',
        'users'     => 'Users',
        'roles'     => 'Roles and Permissions',
    ],
];