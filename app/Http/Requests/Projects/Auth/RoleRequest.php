<?php

namespace App\Http\Requests\Projects\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Get the role ID when updating — جلب رقم الدور عند التعديل
        $role = $this->route('role') ?? $this->route('id');

        // Unique slug rule — منع تكرار المعرّف
        $slug = Rule::unique('roles', 'slug');

        if ($role) {
            $slug->ignore(is_object($role) ? $role->getKey() : $role);
        }

        return [
            'name'          => ['required', 'string', 'max:255'],
            'slug'          => ['required', 'string', 'max:255', $slug],
            'module'        => ['required', 'string', 'max:255'],
            'action'        => ['required', 'string', 'max:255'],
            'description'   => ['nullable', 'string'],
            'status'        => ['required', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'         => __('Auth/roles.validation.name_required'),
            'name.string'           => __('Auth/roles.validation.name_string'),
            'name.max'              => __('Auth/roles.validation.name_max'),

            'slug.required'         => __('Auth/roles.validation.slug_required'),
            'slug.string'           => __('Auth/roles.validation.slug_string'),
            'slug.max'              => __('Auth/roles.validation.slug_max'),
            'slug.unique'           => __('Auth/roles.validation.slug_unique'),

            'module.required'       => __('Auth/roles.validation.module_required'),
            'module.string'         => __('Auth/roles.validation.module_string'),
            'module.max'            => __('Auth/roles.validation.module_max'),

            'action.required'       => __('Auth/roles.validation.action_required'),
            'action.string'         => __('Auth/roles.validation.action_string'),
            'action.max'            => __('Auth/roles.validation.action_max'),

            'description.string'    => __('Auth/roles.validation.description_string'),

            'status.required'       => __('Auth/roles.validation.status_required'),
            'status.boolean'        => __('Auth/roles.validation.status_boolean'),
        ];
    }
}
