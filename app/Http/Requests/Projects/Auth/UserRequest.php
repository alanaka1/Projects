<?php

namespace App\Http\Requests\Projects\Auth;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
// use Illuminate\Contracts\Validation\ValidationRule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request. صلاحية تنفيذ الطلب تُفحص عبر middleware المسار.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * قواعد التحقق.
     * * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $user = $this->route('user');

        return [
            'name'     => ['required', 'string', 'max:255'],
            'surname'  => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users', 'username')->ignore($user)],
            'email'    => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user)],
            'gender'   => ['required', 'in:male,female'],
            'image'    => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'password' => [$this->isMethod('POST') ? 'required' : 'nullable', 'string', 'min:8', 'confirmed'],
            'status'   => ['required', 'boolean'],
        ];
    }

    /**
     * Get the validation messages that apply to the request. رسائل التحقق.
     */
    public function messages(): array
    {
        return [
            'name.required'      => __('Auth/users.validation.name_required'),
            'name.string'        => __('Auth/users.validation.name_string'),
            'name.max'           => __('Auth/users.validation.name_max'),
            'surname.required'   => __('Auth/users.validation.surname_required'),
            'surname.string'     => __('Auth/users.validation.surname_string'),
            'surname.max'        => __('Auth/users.validation.surname_max'),
            'username.required'  => __('Auth/users.validation.username_required'),
            'username.string'    => __('Auth/users.validation.username_string'),
            'username.max'       => __('Auth/users.validation.username_max'),
            'username.unique'    => __('Auth/users.validation.username_unique'),
            'email.required'     => __('Auth/users.validation.email_required'),
            'email.email'        => __('Auth/users.validation.email_email'),
            'email.max'          => __('Auth/users.validation.email_max'),
            'email.unique'       => __('Auth/users.validation.email_unique'),
            'gender.required'    => __('Auth/users.validation.gender_required'),
            'gender.in'          => __('Auth/users.validation.gender_in'),
            'image.image'        => __('Auth/users.validation.image_image'),
            'image.mimes'        => __('Auth/users.validation.image_mimes'),
            'image.max'          => __('Auth/users.validation.image_max'),
            'password.required'  => __('Auth/users.validation.password_required'),
            'password.string'    => __('Auth/users.validation.password_string'),
            'password.min'       => __('Auth/users.validation.password_min'),
            'password.confirmed' => __('Auth/users.validation.password_confirmed'),
            'status.required'    => __('Auth/users.validation.status_required'),
            'status.boolean'     => __('Auth/users.validation.status_boolean'),
        ];
    }
}