<?php

namespace App\Http\Controllers\Projects\Auth;

use App\Models\{User, Role};
use App\Http\Controllers\Controller;
use App\Http\Requests\Projects\Auth\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\{DB, File};
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource User. ---  عرض المستخدمين.
     */
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->get();

        return view('Projects.Auth.User.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource. نموذج إضافة المستخدم.
     */
    public function create()
    {
        $roles = Role::where('status', 1)->get();

        return view('Projects.Auth.User.form', compact('roles'));
    }

    /**
     * حفظ المستخدم.
     */
    public function store(UserRequest $request)
    {
        $newImagePath = null;

        try {
            $data = $request->safe()->except(['roles', 'roles_present', 'image']);
            $data['image'] = null;
            
            /*
            |--------------------------------------------------------------------------
            | Upload Image رفع الصورة.
            |--------------------------------------------------------------------------
            */
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = Str::uuid().'.'.$image->extension();
                File::ensureDirectoryExists(public_path('uploads/users'));
                $image->move(public_path('uploads/users'), $imageName);
                $newImagePath = 'uploads/users/'.$imageName;

                $data['image'] = $newImagePath;
            }

            User::create($data);

        } catch (\Exception $ex) {
            report($ex);

            // تنظيف الصورة الجديدة إذا فشل إنشاء المستخدم.
            if ($newImagePath) {
                try {
                    if (is_file(public_path($newImagePath)) && !File::delete(public_path($newImagePath))) {
                        throw new \RuntimeException('تعذّر حذف الصورة الجديدة.');
                    }
                } catch (\Exception $imageEx) {
                    report($imageEx);
                }
            }
            return redirect(route('users.index'))->with(['error' => __('Auth/users.controller.create_error')]);
        }
        return redirect(route('users.index'))->with(['success' => __('Auth/users.controller.created_successfully')]);
    }

    /**
     * Display the specified resource. عرض المستخدم وصلاحياته.
     */
    public function show($user)
    {
        $user = User::with('roles')->find($user);

        if (!$user) {
            return redirect(route('users.index'))->with(['error' => __('Auth/users.controller.not_found')]);
        }

        $roles = Role::where('status', 1)->orderBy('id')->get();

        return view('Projects.Auth.User.show', compact('user', 'roles'));
    }

    /**
     * Display the specified resource. عرض المستخدم وصلاحياته.
     */
    public function Role($user)
    {
        $user = User::with('roles')->find($user);

        if (!$user) {
            return redirect(route('users.index'))->with(['error' => __('Auth/users.controller.not_found')]);
        }

        $roles = Role::where('status', 1)->orderBy('id')->get();

        return view('Projects.Auth.User.role', compact('user', 'roles'));
    }

    /**
     * Show the form for editing the specified resource. نموذج تعديل المستخدم.
     */
    public function edit($user)
    {
        $user = User::with('roles')->find($user);

        if (!$user) {
            return redirect(route('users.index'))->with(['error' => __('Auth/users.controller.not_found')]);
        }

        $roles = Role::where('status', 1)->get();

        return view('Projects.Auth.User.form', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.تحديث بيانات المستخدم.
     */
    public function update(UserRequest $request, $user)
    {
        $newImagePath = null;

        try {
            $user = User::find($user);
            if (!$user) {
                return redirect(route('users.index'))->with(['error' => __('Auth/users.controller.not_found')]);
            }
            $data = $request->safe()->except(['roles', 'roles_present', 'image']);
            $oldImagePath = $user->image;

            // إبقاء كلمة المرور الحالية إذا كان الحقل فارغًا.
            /*
            |--------------------------------------------------------------------------
            | Password
            |--------------------------------------------------------------------------
            */
            if (empty($data['password'])) {
                unset($data['password']);
            }
            /*
            |--------------------------------------------------------------------------
            | Update Image رفع الصورة الجديدة.
            |--------------------------------------------------------------------------
            */
            
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = Str::uuid().'.'.$image->extension();

                File::ensureDirectoryExists(public_path('uploads/users'));
                $image->move(public_path('uploads/users'), $imageName);

                $newImagePath = 'uploads/users/'.$imageName;
                $data['image'] = $newImagePath;
            }

            $user->update($data);

        } catch (\Exception $ex) {
            report($ex);

            // تنظيف الصورة الجديدة إذا فشل التحديث.
            if ($newImagePath) {
                try {
                    if (is_file(public_path($newImagePath)) && !File::delete(public_path($newImagePath))) {
                        throw new \RuntimeException(__('Auth/users.controller.new_image_delete_error'));
                    }
                } catch (\Exception $imageEx) {
                    report($imageEx);
                }
            }

            return redirect(route('users.index'))->with(['error' => __('Auth/users.controller.update_error')]);
        }

        // Remove the specified resource from storage. حذف الصورة القديمة بعد نجاح التحديث.
        if ($newImagePath && $oldImagePath) {
            try {
                $directory = realpath(public_path('uploads/users'));
                $imagePath = realpath(public_path($oldImagePath));

                if ($directory !== false && $imagePath !== false && str_starts_with($imagePath, $directory.DIRECTORY_SEPARATOR) && is_file($imagePath)) {
                    if (!File::delete($imagePath)) {
                        throw new \RuntimeException(__('Auth/users.controller.old_image_delete_error'));
                    }
                }
            } catch (\Exception $imageEx) {
                report($imageEx);
            }
        }

        return redirect(route('users.index'))->with(['success' => __('Auth/users.controller.updated_successfully')]);
    }

    /**
     * حذف المستخدم مؤقتًا.
     */
    public function destroy($user)
    {
        try {

            $user = User::find($user);
            if (!$user) {
                return redirect(route('users.index'))->with(['error' => __('Auth/users.controller.not_found')]);
            }

            $user->delete();
            return redirect(route('users.index'))->with(['success' => __('Auth/users.controller.deleted_successfully')]);
        } catch (\Exception $ex) {
            report($ex);
            return redirect(route('users.index'))->with(['error' => __('Auth/users.controller.delete_error')]);
        }
    }

    /**
     * Display deleted users. --- عرض المستخدمين المحذوفين مؤقتًا.
     */
    public function trash()
    {
        $users = User::onlyTrashed()->orderBy('deleted_at', 'DESC')->paginate(10);
        return view('Projects.Auth.User.trash', compact('users'));
    }

    /**
     * Restore user. --- استرجاع المستخدم من سلة المحذوفات.
     */
    public function restore($user)
    {
        try {
            $user = User::onlyTrashed()->find($user);

            if (!$user) {
                return redirect(route('users.trash'))->with(['error' => __('Auth/users.controller.not_found_trash')]);
            }

            $user->restore();

            return redirect(route('users.trash'))->with(['success' => __('Auth/users.controller.restored_successfully')]);
        } catch (\Exception $ex) {
            report($ex);
            return redirect(route('users.trash'))->with(['error' => __('Auth/users.controller.restore_error')]);
        }
    }

    /**
     * Force delete user. --- حذف المستخدم نهائيًا.
     */
    public function forceDestroy($user)
    {
        try {

            $user = User::onlyTrashed()->find($user);

            if (!$user) {
                return redirect(route('users.trash'))->with(['error' => __('Auth/users.controller.not_found_trash')]);
            }

            $oldImagePath = $user->image;

            // حذف روابط الصلاحيات والمستخدم ضمن عملية واحدة.
            DB::transaction(function () use ($user) {
                $user->roles()->detach();
                $user->forceDelete();
            });

        } catch (\Exception $ex) {
            report($ex);

            return redirect(route('users.trash'))->with(['error' => __('Auth/users.controller.force_delete_error')]);
        }

        // حذف الصورة بعد نجاح الحذف النهائي.
        if ($oldImagePath) {
            try {
                $directory = realpath(public_path('uploads/users'));
                $imagePath = realpath(public_path($oldImagePath));

                if ($directory !== false && $imagePath !== false && str_starts_with($imagePath, $directory.DIRECTORY_SEPARATOR) && is_file($imagePath)) {
                    if (!File::delete($imagePath)) {
                        throw new \RuntimeException(__('Auth/users.controller.user_image_delete_error'));
                    }
                }
            } catch (\Exception $imageEx) {
                report($imageEx);
            }
        }
        return redirect(route('users.trash'))->with(['success' => __('Auth/users.controller.force_deleted_successfully')]);
    }

    /**
     * حذف صورة المستخدم فقط.
     */
    public function removeImage($user)
    {
        try {
            $user = User::find($user);
            if (!$user) {
                return redirect(route('users.index'))->with(['error' => __('Auth/users.controller.not_found')]);
            }

            $oldImagePath = $user->image;
            // حذف مسار الصورة من Database
            $user->update(['image' => null]);

        } catch (\Exception $ex) {
            report($ex);

            return redirect(route('users.index'))->with(['error' => __('Auth/users.controller.remove_image_error')]);
        }

        // تنظيف الملف بعد نجاح تحديث قاعدة البيانات.
        if ($oldImagePath) {
            try {
                $directory = realpath(public_path('uploads/users'));
                $imagePath = realpath(public_path($oldImagePath));

                if ($directory !== false && $imagePath !== false && str_starts_with($imagePath, $directory.DIRECTORY_SEPARATOR) && is_file($imagePath)) {
                    if (!File::delete($imagePath)) {
                        throw new \RuntimeException(__('Auth/users.controller.image_file_delete_error'));
                    }
                }
            } catch (\Exception $imageEx) {
                report($imageEx);

                return redirect(route('users.edit', $user->id))->with(['error' => __('Auth/users.controller.image_cleanup_error')]);
            }
        }

        return redirect(route('users.edit', $user->id))->with(['success' => __('Auth/users.controller.image_deleted_successfully')]);
    }

    /**
     * Change User Status تفعيل أو تعطيل المستخدم.
     */
    public function updateStatus(User $user)
    {
        try {
            $user->update(['status' => !$user->status]);

            return redirect(route('users.index'))->with(['success' => $user->status ? __('Auth/users.controller.enable_successfully') : __('Auth/users.controller.disable_successfully'),]);
        } catch (\Exception $ex) {
            report($ex);
            return redirect(route('users.index'))->with(['error' => __('Auth/users.controller.change_status_error')]);
        }
    }

    /**
     * إضافة أو إزالة صلاحية واحدة.
     */
    public function updateRole(Request $request, User $user)
    {
        $actor = $request->user();

        abort_unless($actor && $actor->status && $actor->hasRole('admin'), 403);

        $data = $request->validate([
            'role_id' => ['required', 'integer', Rule::exists('roles', 'id')->where('status', 1)->whereNull('deleted_at')],
            'enabled' => ['required', 'boolean'],
        ]);

        try {
            if ($request->boolean('enabled')) {
                $user->roles()->syncWithoutDetaching([$data['role_id']]);
            } else {
                $user->roles()->detach($data['role_id']);
            }

            return back()->with(['success' => __('Auth/users.controller.roles_updated_successfully')]);
        } catch (\Exception $ex) {
            report($ex);

            return back()->with(['error' => __('Auth/users.controller.roles_update_error')]);
        }
    }
}