<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\RoleCreate;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = DB::table('roles')->get();
        foreach ($roles as $idx => $role) {
            $permissionsCount = DB::table('role_has_permissions')->where('role_id', $role->id)->count();
            $roles[$idx]->permissionsCount = $permissionsCount;
        }


        return view('admin.roles.index', [
            'roles' => $roles
        ]);
    }

    public function edit($roleId)
    {
        $permissionsGroups = DB::table('permissions')->select('group')->groupBy('group')->pluck('group');
        $role = DB::table('roles')->where('id', $roleId)->first();
        $roleSpartie = Role::findByName($role->name);
        $usersId = DB::table('model_has_roles')
            ->where('model_type', 'App\Models\User')
            ->where('role_id', $roleId)
            ->groupBy('model_id')
            ->pluck('model_id');
        $users = User::whereIn('id', $usersId)->get();

        return view('admin.roles.form', [
            'role' => $role,
            'roleSpartie' => $roleSpartie,
            'permissionsGroups' => $permissionsGroups,
            'users' => $users
        ]);
    }

    public function delete(Role $role)
    {
        $users = User::with('roles')->get();
        foreach ($users as $user) {
            $user->removeRole($role);
        }

        $role->delete();

        return redirect()->route('admin.roles.index')->with('message', trans('siwei.messageRoleDeleted'));
    }

    public function update(Request $request, Role $role)
    {
        $permissions = [];
        foreach ($request->all() as $field => $val) {
            if (substr($field, 0, 5) == 'perm_') {
                $permissions[] = str_replace('_', '.', substr($field, 5));
            }
        }

        $role->syncPermissions($permissions);

        return redirect()->route('admin.roles.edit', ['role' => $role])->with('message', trans('siwei.messageRoleUpdated'));
    }

    public function create(RoleCreate $request)
    {
        $role = Role::create(['name' => $request->get('name')]);

        return redirect()->route('admin.roles.edit', ['role' => $role])->with('message', trans('siwei.messageRoleCreated'));
    }
}
