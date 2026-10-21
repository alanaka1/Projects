<?php

namespace App\Http\Controllers\Projects\Auth;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Projects\Auth\RoleRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource. --- اعرض قائمة بمورد أدوار.
     */
    public function index()
    {
        $roles = Role::orderBy('id', 'DESC')->get();
        // $roles = Role::orderBy('id', 'DESC')->paginate(10);
        return view('Projects.Auth.Role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Projects.Auth.Role.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        try{

            // $data = [
            //     'name'           => $request->name,
            //     'slug'           => $request->slug,
            //     'module'         => $request->module,
            //     'action'         => $request->action,
            //     'description'    => $request->description,
            //     'status'         => $request->status ?? 1,
            // ];

            // $data = $request->validated();
            // $data['status'] = $data['status'] ?? 1;

            Role::create($request->validated());
            
                return redirect(route('roles.index'))->with(['success' => __('Auth/roles.created_successfully')]);
            }catch(\Exception $ex){
                return redirect(route('roles.index'))->with(['error' => __('Auth/roles.create_error')]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($role)
    {
        $role = Role::find($role);

        if (!$role) {
            return redirect(route('roles.index'))->with(['error' => __('Auth/roles.not_found')]);
        }

        return view('Projects.Auth.Role.show',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($role)
    {
        $role = Role::find($role);

        if (!$role) {
            return redirect(route('roles.index'))->with(['error' => __('Auth/roles.not_found')]);
        }

        return view('Projects.Auth.Role.form',compact('role'));
    }

    /**
     * Update the specified resource in storage. 
     */
    public function update(RoleRequest $request, $role)
    {
        try{
            $role = Role::find($role);
            if(!$role){
                return redirect(route('roles.index'))->with(['error' => __('Auth/roles.not_found')]);
            }
            // $data = $request->validated();
            // $data = $request->only([''name', 'slug', 'module', 'action', 'description', 'status',]);

            $role->update($request->validated());
    
            return redirect(route('roles.index'))->with(['success' => __('Auth/roles.updated_successfully')]);
        }catch(\Exception $ex){
            return redirect(route('roles.index'))->with(['error' => __('Auth/roles.update_error')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($role)
    {
        try {

            $role = Role::find($role);
            if (!$role) {
                return redirect(route('roles.index'))->with(['error' => __('Auth/roles.not_found')]);
            }
            
            $role->delete();
            return redirect(route('roles.index'))->with(['success' => __('Auth/roles.deleted_successfully')]);
        } catch (\Exception $ex) {
            return redirect(route('roles.index'))->with(['error' => __('Auth/roles.delete_error')]);
        }
    }

    /**
     * Display deleted roles. --- عرض أدوار المحذوفين مبدئيًا.
    */
    public function trash()
    {
        $roles = Role::onlyTrashed()->orderBy('deleted_at', 'DESC')->get();
        return view('Projects.Auth.Role.trash', compact('roles'));
    }

    /**
     * DRestore role. --- استرجاع أدوار من سلة المحذوفات.
    */
    
    public function restore($role)
    {
        try {

            $role = Role::onlyTrashed()->find($role);

            if (!$role) {
                return redirect(route('roles.trash'))->with(['error' => __('Auth/roles.not_found_trash')]);
            }

            $role->restore();

            return redirect(route('roles.trash'))->with(['success' => __('Auth/roles.restored_successfully')]);
        } catch (\Exception $ex) {
            return redirect(route('roles.trash'))->with(['error' => __('Auth/roles.restore_error')]);
        }
    }

    /**
     * Force delete role. --- حذف أدوار نهائيًا من سلة المحذوفات.
    */

    public function forceDestroy($role)
    {
        try {

            $role = Role::onlyTrashed()->find($role);

            if (!$role) {
                return redirect(route('roles.trash'))->with(['error' => __('Auth/roles.not_found_trash')]);
            }

            // التحقق من ارتباط أدوار بأي Role
            // if ($role->roles()->exists() || $role->accounts()->exists() || $role->transactions()->exists() || $role->currencyTransfers()->exists()) {
            //     return redirect(route('roles.trash'))->with(['error' => 'لا يمكن حذف أدوار نهائيًا لأنه مرتبط بصلاحيات أو أدوار']);
            // }

            // الحذف النهائي
            $role->forceDelete();

            return redirect(route('roles.trash'))->with(['success' => __('Auth/roles.force_deleted_successfully')]);
        } catch (\Exception $ex) {
            return redirect(route('roles.trash'))->with(['error' => __('Auth/roles.force_delete_error')]);
        }
    }

    /**
     * تفعيل أو تعطيل التصنيف. = Change Category Status
     */
    public function updateStatus(Role $role)
    {
        try {

            $role->update(['status' => $role->status == 1 ? 0 : 1,]);

            return redirect(route('roles.index'))->with(['success' => $role->status == 1 ? __('Auth/roles.enable_successfully') : __('Auth/roles.disable_successfully'),]);
        } catch (\Exception $ex) {
            return redirect(route('roles.index'))->with(['error' => __('Auth/roles.change_status_error')]);
        }
    }
}
