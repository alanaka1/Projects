
<?php

return [
    // General
    'title' => 'Roles',
    'list_subtitle' => 'Manage the roles registered in the system.',
    'create_title' => 'Create New Role',
    'edit_title' => 'Edit Role',
    'show_title' => 'Role Details',
    'trash_title' => 'Deleted Roles',
    'create_subtitle' => 'Enter the information for the new role.',
    'edit_subtitle' => 'Update the role information below.',
    'show_subtitle' => 'View role information.',
    'trash_subtitle' => 'Manage deleted roles, restore them, or permanently delete them.',
    'breadcrumb_home' => 'Home',

    // Success and error messages
    'created_successfully' => 'Role created successfully.',
    'create_error' => 'An error occurred while creating the role.',
    'not_found' => 'Role not found.',
    'updated_successfully' => 'Role updated successfully.',
    'update_error' => 'An error occurred while updating the role.',
    'deleted_successfully' => 'Role moved to the trash successfully.',
    'delete_error' => 'An error occurred while deleting the role.',
    'not_found_trash' => 'Role not found in the trash.',
    'restored_successfully' => 'Role restored successfully.',
    'restore_error' => 'An error occurred while restoring the role.',
    'force_deleted_successfully' => 'Role permanently deleted successfully.',
    'force_delete_error' => 'An error occurred while permanently deleting the role.',
    'enable_successfully' => 'Role activated successfully.',
    'disable_successfully' => 'Role deactivated successfully.',
    'change_status_error' => 'An error occurred while changing the role status.',

    // Fields
    'fields' => [
        'id' => 'ID',
        'name' => 'Role Name',
        'slug' => 'Slug',
        'module' => 'Module',
        'action' => 'Action',
        'status' => 'Status',
        'description' => 'Description',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
        'deleted_at' => 'Deleted At',
    ],

    // Status
    'status' => [
        'active' => 'Active',
        'inactive' => 'Inactive',
    ],

    // Buttons
    'buttons' => [
        'create' => 'Create Role',
        'activate' => 'Activate Role',
        'deactivate' => 'Deactivate Role',
        'change_status' => 'Change Status',
        'show' => 'View Details',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'restore' => 'Restore',
        'force_delete' => 'Delete Permanently',
        'save' => 'Save',
        'update' => 'Update',
        'cancel' => 'Cancel',
        'back' => 'Back',
        'reset' => 'Reset',
    ],

    // Confirmations
    'confirm' => [
        'delete' => 'Are you sure you want to move this role to the trash?',
        'restore' => 'Are you sure you want to restore this role?',
        'force_delete' => 'Are you sure you want to permanently delete this role? This action cannot be undone.',
    ],

    // Empty states
    'empty' => [
        'no_roles' => 'There are no roles to display.',
        'no_deleted_roles' => 'The trash is empty.',
    ],

    'number_of_roles' => 'roles',

    // Validation
    'validation' => [
        'name_required' => 'The role name is required.',
        'name_string' => 'The role name must be a string.',
        'name_max' => 'The role name may not exceed 255 characters.',

        'slug_required' => 'The slug is required.',
        'slug_string' => 'The slug must be a string.',
        'slug_max' => 'The slug may not exceed 255 characters.',
        'slug_unique' => 'This slug is already in use.',

        'module_required' => 'The module is required.',
        'module_string' => 'The module must be a string.',
        'module_max' => 'The module may not exceed 255 characters.',

        'action_required' => 'The action is required.',
        'action_string' => 'The action must be a string.',
        'action_max' => 'The action may not exceed 255 characters.',

        'description_string' => 'The description must be a string.',

        'status_required' => 'The status is required.',
        'status_boolean' => 'The status must be active or inactive.',
    ],
];
