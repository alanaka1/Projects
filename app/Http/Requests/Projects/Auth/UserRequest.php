<?php

namespace App\Http\Requests\Projects\Auth;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
// use Illuminate\Contracts\Validation\ValidationRule;

class UserRequest extends FormRequest
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
    
    /**
     * Get the validation rules that apply to the request.
    */
    public function rules(): array
    {
        $user = $this->route('user');

        return [
            'name'      => ['required', 'string', 'max:255',],
            'surname'   => ['required', 'string', 'max:255',],
            'username'  => ['required', 'string', 'max:255', Rule::unique('users', 'username')->ignore($user?->id),],
            'email'     => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user?->id),],
            'gender'    => ['required', 'in:male,female',],
            'image'     => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120',],
            'password'  => [$this->isMethod('POST') ? 'required' : 'nullable', 'string', 'min:8', 'confirmed',],
            'status'    => ['required', 'boolean',],
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     */
    public function messages(): array
    {
        return [
            'name.required'         => 'الاسم مطلوب.',
            'name.string'           => 'الاسم يجب أن يكون نصًا.',
            'name.max'              => 'الاسم يجب ألا يتجاوز 255 حرفًا.',
            'surname.required'      => 'الكنية مطلوبة.',
            'surname.string'        => 'الكنية يجب أن تكون نصًا.',
            'surname.max'           => 'الكنية يجب ألا تتجاوز 255 حرفًا.',
            'username.required'     => 'اسم المستخدم مطلوب.',
            'username.string'       => 'اسم المستخدم يجب أن يكون نصًا.',
            'username.max'          => 'اسم المستخدم يجب ألا يتجاوز 255 حرفًا.',
            'username.unique'       => 'اسم المستخدم مستخدم مسبقًا.',
            'email.required'        => 'البريد الإلكتروني مطلوب.',
            'email.email'           => 'يرجى إدخال بريد إلكتروني صحيح.',
            'email.max'             => 'البريد الإلكتروني يجب ألا يتجاوز 255 حرفًا.',
            'email.unique'          => 'البريد الإلكتروني مستخدم مسبقًا.',
            'gender.required'       => 'الجنس مطلوب.',
            'gender.in'             => 'يرجى اختيار جنس صحيح.',
            'image.image'           => 'الملف المرفوع يجب أن يكون صورة.',
            'image.mimes'           => 'صيغة الصورة يجب أن تكون JPG أو JPEG أو PNG أو WEBP.',
            'image.max'             => 'حجم الصورة يجب ألا يتجاوز 5 ميغابايت.',
            'password.required'     => 'كلمة المرور مطلوبة.',
            'password.string'       => 'كلمة المرور يجب أن تكون نصًا.',
            'password.min'          => 'كلمة المرور يجب أن تحتوي على 8 أحرف على الأقل.',
            'password.confirmed'    => 'تأكيد كلمة المرور غير متطابق.',
            'status.required'       => 'حالة المستخدم مطلوبة.',
            'status.boolean'        => 'حالة المستخدم غير صحيحة.',
        ];
    }
}
