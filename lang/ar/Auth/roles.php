
<?php

return [
    // General — عام
    'title' => 'الأدوار',
    'list_subtitle' => 'إدارة الأدوار المسجلة في النظام.',
    'create_title' => 'إضافة دور جديد',
    'edit_title' => 'تعديل الدور',
    'show_title' => 'تفاصيل الدور',
    'trash_title' => 'سلة الأدوار المحذوفة',
    'create_subtitle' => 'أدخل معلومات الدور الجديد.',
    'edit_subtitle' => 'عدّل معلومات الدور أدناه.',
    'show_subtitle' => 'عرض معلومات الدور.',
    'trash_subtitle' => 'إدارة الأدوار المحذوفة واستعادتها أو حذفها نهائيًا.',
    'breadcrumb_home' => 'الرئيسية',

    // Success and error messages — رسائل النجاح والخطأ
    'created_successfully' => 'تم إنشاء الدور بنجاح.',
    'create_error' => 'حدث خطأ أثناء إنشاء الدور.',
    'not_found' => 'الدور غير موجود.',
    'updated_successfully' => 'تم تحديث الدور بنجاح.',
    'update_error' => 'حدث خطأ أثناء تحديث الدور.',
    'deleted_successfully' => 'تم نقل الدور إلى سلة المحذوفات بنجاح.',
    'delete_error' => 'حدث خطأ أثناء حذف الدور.',
    'not_found_trash' => 'الدور غير موجود في سلة المحذوفات.',
    'restored_successfully' => 'تمت استعادة الدور بنجاح.',
    'restore_error' => 'حدث خطأ أثناء استعادة الدور.',
    'force_deleted_successfully' => 'تم حذف الدور نهائيًا بنجاح.',
    'force_delete_error' => 'حدث خطأ أثناء حذف الدور نهائيًا.',
    'enable_successfully' => 'تم تفعيل الدور بنجاح.',
    'disable_successfully' => 'تم تعطيل الدور بنجاح.',
    'change_status_error' => 'حدث خطأ أثناء تغيير حالة الدور.',

    // Fields — الحقول
    'fields' => [
        'id' => 'المعرّف',
        'name' => 'اسم الدور',
        'slug' => 'المعرّف المختصر (Slug)',
        'module' => 'الوحدة',
        'action' => 'الإجراء',
        'status' => 'الحالة',
        'description' => 'الوصف',
        'created_at' => 'تاريخ الإنشاء',
        'updated_at' => 'تاريخ التحديث',
        'deleted_at' => 'تاريخ الحذف',
    ],

    // Status — الحالة
    'status' => [
        'active' => 'مفعّل',
        'inactive' => 'معطّل',
    ],

    // Buttons — الأزرار
    'buttons' => [
        'create' => 'إضافة دور',
        'activate' => 'تفعيل الدور',
        'deactivate' => 'تعطيل الدور',
        'change_status' => 'تغيير الحالة',
        'show' => 'عرض التفاصيل',
        'edit' => 'تعديل',
        'delete' => 'حذف',
        'restore' => 'استعادة',
        'force_delete' => 'حذف نهائي',
        'save' => 'حفظ',
        'update' => 'تحديث',
        'cancel' => 'إلغاء',
        'back' => 'رجوع',
        'reset' => 'إعادة تعيين',
    ],

    // Confirmations — رسائل التأكيد
    'confirm' => [
        'delete' => 'هل أنت متأكد من نقل هذا الدور إلى سلة المحذوفات؟',
        'restore' => 'هل أنت متأكد من استعادة هذا الدور؟',
        'force_delete' => 'هل أنت متأكد من حذف هذا الدور نهائيًا؟ لا يمكن التراجع عن هذا الإجراء.',
    ],

    // Empty states — الحالات الفارغة
    'empty' => [
        'no_roles' => 'لا توجد أدوار لعرضها حاليًا.',
        'no_deleted_roles' => 'سلة المحذوفات فارغة.',
    ],

    'number_of_roles' => 'دورًا',

    // Validation — رسائل التحقق
    'validation' => [
        'name_required' => 'حقل اسم الدور مطلوب.',
        'name_string' => 'يجب أن يكون اسم الدور نصًا.',
        'name_max' => 'يجب ألا يتجاوز اسم الدور 255 حرفًا.',

        'slug_required' => 'حقل المعرّف المختصر مطلوب.',
        'slug_string' => 'يجب أن يكون المعرّف المختصر نصًا.',
        'slug_max' => 'يجب ألا يتجاوز المعرّف المختصر 255 حرفًا.',
        'slug_unique' => 'هذا المعرّف المختصر مستخدم مسبقًا.',

        'module_required' => 'حقل الوحدة مطلوب.',
        'module_string' => 'يجب أن تكون الوحدة نصًا.',
        'module_max' => 'يجب ألا يتجاوز اسم الوحدة 255 حرفًا.',

        'action_required' => 'حقل الإجراء مطلوب.',
        'action_string' => 'يجب أن يكون الإجراء نصًا.',
        'action_max' => 'يجب ألا يتجاوز الإجراء 255 حرفًا.',

        'description_string' => 'يجب أن يكون الوصف نصًا.',

        'status_required' => 'حقل الحالة مطلوب.',
        'status_boolean' => 'يجب أن تكون الحالة مفعّلة أو معطّلة.',
    ],
];
