<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\{Schema, DB};

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('module');
            $table->string('action');
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });

         DB::table('roles')->insert([
            [
                'name'          => 'Admin',
                'slug'          => 'admin',
                'module'        => 'admin',
                'action'        => 'admin',
                'description'   => 'مدير النظام - كامل الصلاحيات',
                'status'        => 1,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],[
                'name'          => 'User',
                'slug'          => 'user',
                'module'        => 'user',
                'action'        => 'user',
                'description'   => 'مدير النظام - ليس لديه إي صلاحية إلا بدعم من الأدمن',
                'status'        => 1,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],[
                'name'          => 'Dashboard',
                'slug'          => 'dashboard.index',
                'module'        => 'dashboard',
                'action'        => 'index',
                'description'   => 'عرض لوحة التحكم',
                'status'        => 1,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            // Users
            [
                'name'        => 'User Index',
                'slug'        => 'users.index',
                'module'      => 'users',
                'action'      => 'index',
                'description' => 'عرض المستخدمين',
                'status'        => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],[
                'name'        => 'User Create',
                'slug'        => 'users.create',
                'module'      => 'users',
                'action'      => 'create',
                'description' => 'إضافة مستخدم',
                'status'        => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],[
                'name'        => 'User Show',
                'slug'        => 'users.show',
                'module'      => 'users',
                'action'      => 'show',
                'description' => 'عرض مستخدم',
                'status'        => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],[
                'name'        => 'User Edit',
                'slug'        => 'users.edit',
                'module'      => 'users',
                'action'      => 'edit',
                'description' => 'تعديل مستخدم',
                'status'        => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],[
                'name'        => 'User Delete',
                'slug'        => 'users.delete',
                'module'      => 'users',
                'action'      => 'delete',
                'description' => 'حذف مستخدم',
                'status'        => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],[
                'name'        => 'User Trash',
                'slug'        => 'users.trash',
                'module'      => 'users',
                'action'      => 'trash',
                'description' => 'سلة محذوفات المستخدمين',
                'status'        => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],[
                'name'        => 'User Restore',
                'slug'        => 'users.restore',
                'module'      => 'users',
                'action'      => 'restore',
                'description' => 'استرجاع مستخدم',
                'status'        => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],[
                'name'        => 'User Force Delete',
                'slug'        => 'users.force-delete',
                'module'      => 'users',
                'action'      => 'force-delete',
                'description' => 'حذف مستخدم نهائيًا',
                'status'        => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],[
                'name'        => 'User Remove Image',
                'slug'        => 'users.remove-image',
                'module'      => 'users',
                'action'      => 'remove-image',
                'description' => 'حذف صورة المستخدم',
                'status'      => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],[
                'name'        => 'User Status',
                'slug'        => 'users.status',
                'module'      => 'users',
                'action'      => 'status',
                'description' => 'تغيير حالة مستخدم',
                'status'        => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            // Roles
            [
                'name'        => 'Role Index',
                'slug'        => 'roles.index',
                'module'      => 'roles',
                'action'      => 'index',
                'description' => 'عرض الأدوار',
                'status'        => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],[
                'name'        => 'Role Create',
                'slug'        => 'roles.create',
                'module'      => 'roles',
                'action'      => 'create',
                'description' => 'إضافة دور',
                'status'        => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],[
                'name'        => 'Role Show',
                'slug'        => 'roles.show',
                'module'      => 'roles',
                'action'      => 'show',
                'description' => 'عرض دور',
                'status'        => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],[
                'name'        => 'Role Edit',
                'slug'        => 'roles.edit',
                'module'      => 'roles',
                'action'      => 'edit',
                'description' => 'تعديل دور',
                'status'        => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],[
                'name'        => 'Role Delete',
                'slug'        => 'roles.delete',
                'module'      => 'roles',
                'action'      => 'delete',
                'description' => 'حذف دور',
                'status'        => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],[
                'name'        => 'Role Trash',
                'slug'        => 'roles.trash',
                'module'      => 'roles',
                'action'      => 'trash',
                'description' => 'سلة محذوفات الأدوار',
                'status'        => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],[
                'name'        => 'Role Restore',
                'slug'        => 'roles.restore',
                'module'      => 'roles',
                'action'      => 'restore',
                'description' => 'استرجاع دور',
                'status'        => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],[
                'name'        => 'Role Force Delete',
                'slug'        => 'roles.force-delete',
                'module'      => 'roles',
                'action'      => 'force-delete',
                'description' => 'حذف دور نهائيًا',
                'status'        => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],[
                'name'        => 'Role Status',
                'slug'        => 'roles.status',
                'module'      => 'roles',
                'action'      => 'status',
                'description' => 'تغيير حالة دور',
                'status'        => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }

       

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
