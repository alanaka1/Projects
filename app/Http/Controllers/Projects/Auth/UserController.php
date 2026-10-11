<?php

namespace App\Http\Controllers\Projects\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Projects\Auth\UserRequest;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource User. --- اعرض قائمة بمورد المستخدم.
     */
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->get();
        return view('Projects.Auth.User.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Projects.Auth.User.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        try{

            // $data = [
            //     'name'      => $request->name,
            //     'surname'   => $request->surname,
            //     'username'  => $request->username,
            //     'email'     => $request->email,
            //     'gender'    => $request->gender,
            //     'password'  => $request->password,
            //     'status'    => $request->status ?? 1,
            // ];

            // if (!empty($data['password'])) {
            //     $data['password'] = Hash::make($data['password']);
            // } else {
            //     unset($data['password']);
            // }

            $data = $request->validated();
            $data['status'] = $data['status'] ?? 1;
            $data['image'] = null;

            /*
            |--------------------------------------------------------------------------
            | Upload Image
            |--------------------------------------------------------------------------
            */
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/users'), $imageName);
                $data['image'] = 'uploads/users/' . $imageName;
            }else {
                $data['image'] = null;
            }

            User::create($data);
            
                return redirect(route('users.index'))->with(['success' => 'تمت إضافة المستخدم بنجاح']);
            }catch(\Exception $ex){
                return redirect(route('users.index'))->with(['error' => 'حدثت مشكلة أثناء إضافة المستخدم']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($user)
    {
        $user = User::find($user);

        if (!$user) {
            return redirect(route('users.index'))->with(['error' => 'المستخدم المطلوب غير موجود']);
        }

        return view('Projects.Auth.User.show',compact('user'));
        }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($user)
    {
        $user = User::find($user);

        if (!$user) {
            return redirect(route('users.index'))->with(['error' => 'المستخدم المطلوب غير موجود']);
        }

        return view('Projects.Auth.User.form', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, $user)
    {
        try{
            $user = User::find($user);
            if(!$user){
                return redirect(route('users.index'))->with(['error' => 'المستخدم المطلوب غير موجود']);
            }
            $data = $request->validated();
            // $data = $request->only(['name', 'surname', 'username', 'email', 'password', 'status', 'gender']);

            /*
            |--------------------------------------------------------------------------
            | Password
            |--------------------------------------------------------------------------
            */

            if (empty($data['password'])) {
                unset($data['password']);
            }
            // if (!empty($data['password'])) {
            //     $data['password'] = Hash::make($data['password']);
            // } else {
            //     unset($data['password']);
            // }

            /*
            |--------------------------------------------------------------------------
            | Update Image
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('image')) {
                // Delete old image
                if (!empty($user->image)) {
                    $oldImage = public_path($user->image);
                    if (file_exists($oldImage)) {
                        unlink($oldImage);
                    }
                }
                
                // Upload new image حفظ الصورة الجديدة
                $image = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/users'), $imageName);
                // Save new image path حفظ مسار الصورة الجديدة في database
                $data['image'] = 'uploads/users/' . $imageName;
            }

            $user->update($data);
    
            return redirect(route('users.index'))->with(['success' => 'تم تعديل المستخدم بنجاح']);
        }catch(\Exception $ex){
            return redirect(route('users.index'))->with(['error' => 'حدثت مشكلة أثناء تعديل المستخدم']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user)
    {
        try {

            $user = User::find($user);
            if (!$user) {
                return redirect(route('users.index'))->with(['error' => 'المستخدم المطلوب غير موجود']);
            }
            
            $user->delete();
            return redirect(route('users.index'))->with(['success' => 'تم نقل المستخدم إلى سلة المحذوفات بنجاح']);
        } catch (\Exception $ex) {
            return redirect(route('users.index'))->with(['error' => 'حدثت مشكلة أثناء حذف المستخدم']);
        }
    }

    /**
     * Display deleted users. --- عرض المستخدمين المحذوفين مبدئيًا.
    */
    public function trash()
    {
        $users = User::onlyTrashed()->orderBy('deleted_at', 'DESC')->paginate(10);
        return view('Projects.Auth.User.trash', compact('users'));
    }

    /**
     * DRestore user. --- استرجاع المستخدم من سلة المحذوفات.
    */
    
    public function restore($user)
    {
        try {

            $user = User::onlyTrashed()->find($user);

            if (!$user) {
                return redirect(route('users.trash'))->with(['error' => 'المستخدم المطلوب غير موجود في سلة المحذوفات']);
            }

            $user->restore();

            return redirect(route('users.trash'))->with(['success' => 'تم استرجاع المستخدم بنجاح']);
        } catch (\Exception $ex) {
            return redirect(route('users.trash'))->with(['error' => 'حدثت مشكلة أثناء استرجاع المستخدم']);
        }
    }

    /**
     * Force delete user. --- حذف المستخدم نهائيًا من سلة المحذوفات.
    */

    public function forceDestroy($user)
    {
        try {

            $user = User::onlyTrashed()->find($user);

            if (!$user) {
                return redirect(route('users.trash'))->with(['error' => 'المستخدم المطلوب غير موجود في سلة المحذوفات']);
            }

            // التحقق من ارتباط المستخدم بأي Role
            // if ($user->roles()->exists() || $user->accounts()->exists() || $user->transactions()->exists() || $user->currencyTransfers()->exists()) {
            //     return redirect(route('users.trash'))->with(['error' => 'لا يمكن حذف المستخدم نهائيًا لأنه مرتبط بصلاحيات أو أدوار']);
            // }

            // حذف الصورة
            if (!empty($user->image)) {
                $image = public_path($user->image);
                if (file_exists($image)) {
                    unlink($image);
                }
            }

            // الحذف النهائي
            $user->forceDelete();

            return redirect(route('users.trash'))->with(['success' => 'تم حذف المستخدم نهائيًا']);
        } catch (\Exception $ex) {
            return redirect(route('users.trash'))->with(['error' => 'تم حذف المستخدم نهائيًا']);
        }
    }

    /**
     * Remove user image. --- حذف صورة المستخدم فقط.
    */
    public function removeImage($user)
    {
        try {
            $user = User::find($user);
            if (!$user) {
                return redirect(route('users.index'))->with(['error' => 'المستخدم المطلوب غير موجود']);
            }

            // حذف ملف الصورة من public
            if (!empty($user->image)) {
                $imagePath = public_path($user->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // حذف مسار الصورة من Database
            $user->update(['image' => null]);

            return redirect(route('users.edit', $user->id))->with(['success' => 'تم حذف صورة المستخدم بنجاح']);
        } catch (\Exception $ex) {
            return redirect(route('users.edit', $user->id))->with(['error' => 'حدثت مشكلة أثناء حذف الصورة']);
        }
    }

    /**
     * تفعيل أو تعطيل التصنيف. = Change Category Status
     */
    public function updateStatus(User $user)
    {
        try {

            $user->update(['status' => $user->status == 1 ? 0 : 1,]);

            return redirect(route('users.index'))->with(['success' => $user->status == 1 ? 'تم تفعيل المستخدم بنجاح' : 'تم تعطيل المستخدم بنجاح']);
        } catch (\Exception $ex) {
            return redirect(route('users.index'))->with(['error' => 'حدثت مشكلة أثناء تغيير حالة المستخدم']);
        }
    }
}
