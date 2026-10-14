<?php

return [
    'title' => 'المستخدمين',
    'user'  => 'المستخدم',
    'create' => 'إضافة مستخدم',
    'edit' => 'تعديل المستخدم',
    'show' => 'عرض المستخدم',

    'name' => 'الاسم',
    'surname' => 'الكنية',
    'username' => 'اسم المستخدم',
    'email' => 'البريد الإلكتروني',
    'gender' => 'الجنس',
    'image' => 'الصورة',
    'password' => 'كلمة المرور',
    'password_confirmation' => 'تأكيد كلمة المرور',
    'status' => 'الحالة',
    'role' => 'الدور',
    'actions' => 'الإجراءات',

    'users_trash' => 'سلة مهملات المستخدمين',
    'manage_deleted_users' => 'إدارة المستخدمين المحذوفين.',
    'deleted_users_count' => 'المستخدمون المحذوفون.',
    'number_active_users' => 'عدد المستخدمين الموجودين',

    'active' => 'فعال',
    'inactive' => 'غير فعال',
    'male' => 'ذكر',
    'female' => 'أنثى',

    'delete_image'  => 'حذف الصورة',
    'back_to_users' => 'العودة إلى المستخدمين',

    'delete_confirm' => 'هل أنت متأكد من حذف هذا المستخدم؟',
    'restore_confirm' => 'هل أنت متأكد من استرجاع هذا المستخدم؟',
    'force_delete_confirm' => 'تحذير! سيتم حذف المستخدم نهائيًا ولا يمكن استرجاعه هل أنت متأكد؟',
    'delete_image_confirm' => 'هل أنت متأكد من حذف صورة المستخدم؟',

    'created_successfully' => 'تمت إضافة المستخدم بنجاح.',
    'updated_successfully' => 'تم تعديل المستخدم بنجاح.',
    'deleted_successfully' => 'تم نقل المستخدم إلى سلة المحذوفات بنجاح.',
    'restored_successfully' => 'تم استرجاع المستخدم بنجاح.',
    'force_deleted_successfully' => 'تم حذف المستخدم نهائيًا.',

    'enter_the_user_information_below'      => 'أدخل معلومات المستخدم أدناه.',
    'update_the_user_information_below'     => 'قم بتحديث معلومات المستخدم أدناه.',

    'password_placeholder_create' => 'أدخل كلمة المرور',
    'password_placeholder_edit' => 'اتركه فارغاً للإبقاء على كلمة المرور الحالية',


    'not_found' => 'المستخدم المطلوب غير موجود.',
    'not_found_trash' => 'المستخدم المطلوب غير موجود في سلة المحذوفات.',

    'create_error' => 'حدثت مشكلة أثناء إضافة المستخدم.',
    'update_error' => 'حدثت مشكلة أثناء تعديل المستخدم.',
    'delete_error' => 'حدثت مشكلة أثناء حذف المستخدم.',
    'restore_error' => 'حدثت مشكلة أثناء استرجاع المستخدم.',
    'force_delete_error' => 'حدثت مشكلة أثناء الحذف النهائي للمستخدم.',
    'change_status_error' => 'حدثت مشكلة أثناء تغيير حالة المستخدم.',
    'remove_image_error' => 'حدثت مشكلة أثناء حذف الصورة.',

    'image_deleted_successfully' => 'تم حذف صورة المستخدم بنجاح.',

    'cannot_force_delete' => 'لا يمكن حذف المستخدم نهائيًا لأنه مرتبط ببيانات أخرى.',
    'enable_successfully' => 'تم تفعيل المستخدم بنجاح.',
    'disable_successfully' => 'تم تعطيل المستخدم بنجاح.',

    'no_deleted_users' => 'لا يوجد مستخدمون محذوفون.',



    'validation' => [
        'name_required' => 'الاسم مطلوب.',
        'name_string' => 'الاسم يجب أن يكون نصًا.',
        'name_max' => 'الاسم يجب ألا يتجاوز 255 حرفًا.',

        'surname_required' => 'الكنية مطلوبة.',
        'surname_string' => 'الكنية يجب أن تكون نصًا.',
        'surname_max' => 'الكنية يجب ألا تتجاوز 255 حرفًا.',

        'username_required' => 'اسم المستخدم مطلوب.',
        'username_string' => 'اسم المستخدم يجب أن يكون نصًا.',
        'username_max' => 'اسم المستخدم يجب ألا يتجاوز 255 حرفًا.',
        'username_unique' => 'اسم المستخدم مستخدم مسبقًا.',

        'email_required' => 'البريد الإلكتروني مطلوب.',
        'email_email' => 'يرجى إدخال بريد إلكتروني صحيح.',
        'email_max' => 'البريد الإلكتروني يجب ألا يتجاوز 255 حرفًا.',
        'email_unique' => 'البريد الإلكتروني مستخدم مسبقًا.',

        'gender_required' => 'الجنس مطلوب.',
        'gender_in' => 'يرجى اختيار جنس صحيح.',

        'image_image' => 'الملف المرفوع يجب أن يكون صورة.',
        'image_mimes' => 'صيغة الصورة يجب أن تكون JPG أو JPEG أو PNG أو WEBP.',
        'image_max' => 'حجم الصورة يجب ألا يتجاوز 5 ميغابايت.',

        'password_required' => 'كلمة المرور مطلوبة.',
        'password_string' => 'كلمة المرور يجب أن تكون نصًا.',
        'password_min' => 'كلمة المرور يجب أن تحتوي على 8 أحرف على الأقل.',
        'password_confirmed' => 'تأكيد كلمة المرور غير متطابق.',

        'status_required' => 'حالة المستخدم مطلوبة.',
        'status_boolean' => 'حالة المستخدم غير صحيحة.',
    ],

];