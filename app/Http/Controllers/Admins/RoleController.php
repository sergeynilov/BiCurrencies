<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Auth;
use DB;

class RoleController extends Controller  //    http://127.0.0.1:8000/admin/roles
{
    public function __construct()
    {
//        $this->middleware(['role:super-admin|admin|moderator']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($filter_name = '')
    {

        //     Route::get('roles/filter/{filter_name}', [RoleController::class, 'index'])->name('RolesFilter');
        \Log::info(  varDump($filter_name, ' -1 RoleController $filter_name::') );

        $roles= Role
            ::getByName($filter_name)
            ->with('permissions')
            ->paginate(5);
        \Log::info(  varDump($filter_name, ' -1 RoleController $filter_name::') );
        return Inertia::render('Admins/Roles/Index', [
            'roles'       => $roles,
            'permissions' => Permission::getPermissionsSelectionArray(),
        ]);
    }

    //    Route::post('roles/filter', [RoleController::class, 'filter'])->name('RolesFilter');

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        \Log::info(varDump(-1, ' -1 create $role_id::'));

        return Inertia::render('Admins/Roles/Edit', [
            'role'        => new Role,
            'permissionSelectionArray' => Permission::getPermissionsSelectionArray(),
            'is_insert'   => true,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Log::info('-1 store $request->all()::' . print_r($request->all(), true));
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            \Log::info('-99 store ::');

            return redirect(route('admin.dashboard.index'))->withErrors(['message', 'You have no access to store role']);
        }
        $this->validate($request, [
            'name'            => ['required', 'min:5', 'max:255'],
            'rolePermissions' => 'required'
        ]);

        $role= null;
        try {
            DB::beginTransaction();
            $role = Role::create([
                'name'       => $request->name,
                'guard_name' => 'web',
            ]);

            if ($request->has('rolePermissions')) {
                \Log::info(varDump(-11, ' -11 \rolePermissions\'::'));
                $role->givePermissionTo(collect($request->rolePermissions));
//                $role->givePermissionTo(collect($request->permissions)->pluck('id')->toArray());
            }
//            $role->syncPermissions(collect($request->rolePermissions));

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            \Log::info('-1 UsersCrudController store $e->getMessage() ::' . print_r($e->getMessage(), true));

            return back()->withErrors(['message' => $e->getMessage()]);
        }

//        return redirect(route('admin.roles.edit', $role->id));

        return back ()->with('data', [
            'role' => $role,
        ]);;
//        return back();


    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Role $role
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(int $role_id)
    {
        \Log::info(varDump($role_id, ' -1 edit $role_id::'));
//        $rolePermissions= Role
//            ::where('id', $role_id)->with('permissions')->first()->permissions->pluck('id')->toArray();

        $role = Role
            ::getById($role_id)
            ->first();

        $rolePermissions = $role->permissions()->pluck('id')->toArray();


        if (empty($role)) {
            return redirect(route('admin.roles.index'));
        }
        \Log::info(varDump($role, ' -12 edit $role::'));
        \Log::info(varDump($rolePermissions, ' -13 edit $rolePermissions::'));

        return Inertia::render('Admins/Roles/Edit', [
            'role'                     => $role,
            'rolePermissions'          => $rolePermissions,
            'permissionSelectionArray' => Permission::getPermissionsSelectionArray(),
            'is_insert'                => false,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Role $role
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $role_id)
    {
        \Log::info('-1 update $request->all()::' . print_r($request->all(), true));
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            \Log::info('-99 update ::');

            return redirect(route('admin.dashboard.index'))->withErrors(['message', 'You have no access to update role']);
        }
        $this->validate($request, [
            'name'            => ['required', 'min:5', 'max:255'],
            'rolePermissions' => 'required'
        ]);
        $role = Role
            ::getById($role_id)
            ->first();


        try {
            DB::beginTransaction();

            if ($request->has('rolePermissions')) {
                \Log::info(varDump(-11, ' -11 \rolePermissions\'::'));
                $role->givePermissionTo(collect($request->rolePermissions));
//                $role->givePermissionTo(collect($request->permissions)->pluck('id')->toArray());
            }
//            $role->syncPermissions(collect($request->rolePermissions));
            $role->name       = $request->name;
            $role->updated_at = Carbon::now(config('app.timezone'));
            $role->save();

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            \Log::info('-1 UsersCrudController store $e->getMessage() ::' . print_r($e->getMessage(), true));

            return back()->withErrors(['message'=> $e->getMessage()]);
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Role $role
     *
     * @return \Illuminate\Http\Response
     */
    public
    function destroy(
        Role $role
    ) {
        if (auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            $role->delete();

            return back();
        }

        return back();
    }
}
