<?php

return [
    'view' => [
        'title'    => 'تسجيل الدخول',
        'login'    => 'البريد الإلكتروني أو اسم المستخدم',
        'password' => 'كلمة المرور',
        'remember' => 'تذكرني',
        'submit'   => 'دخول',
        'logout'   => 'تسجيل الخروج',
        'welcome_back'         => 'أهلًا بعودتك',
        'sign_in_description'  => 'سجّل الدخول للمتابعة إلى لوحة التحكم',
        'login_placeholder'    => 'أدخل البريد الإلكتروني أو اسم المستخدم',
        'forgot_password'      => 'نسيت كلمة المرور؟',
        'password_placeholder' => 'أدخل كلمة المرور',
        'show_password'        => 'إظهار كلمة المرور',
        'no_account'           => 'ليس لديك حساب؟',
        'create_account'       => 'إنشاء حساب',
    ],

    'controller' => [
        'login_failed'            => 'بيانات الدخول غير صحيحة أو الحساب غير متاح.',
        'too_many_attempts'       => 'محاولات تسجيل الدخول كثيرة. حاول مجددًا بعد :seconds ثانية.',
        'logged_in_successfully'  => 'تم تسجيل الدخول بنجاح.',
        'logged_out_successfully' => 'تم تسجيل الخروج بنجاح.',
    ],

    'validation' => [
        'login_required'    => 'البريد الإلكتروني أو اسم المستخدم مطلوب.',
        'login_string'      => 'البريد الإلكتروني أو اسم المستخدم يجب أن يكون نصًا.',
        'login_max'         => 'البريد الإلكتروني أو اسم المستخدم يجب ألا يتجاوز 255 حرفًا.',
        'password_required' => 'كلمة المرور مطلوبة.',
        'password_string'   => 'كلمة المرور يجب أن تكون نصًا.',
        'remember_boolean'  => 'قيمة تذكرني غير صحيحة.',
    ],
];