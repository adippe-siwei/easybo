<?php

namespace App\Http\Controllers\Admin;

use App\Custom\Tools;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserCreate;
use App\Http\Requests\User\UserUpdate;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    public function edit(User $user)
    {
        $roles = DB::table('roles')->pluck('name');
        $permissionsGroups = DB::table('permissions')->select('group')->groupBy('group')->pluck('group');

        return view('admin.users.form', [
            'user' => $user,
            'roles' => $roles,
            'permissionsGroups' => $permissionsGroups,
            'action' => 'edit'
        ]);
    }

    public function update(UserUpdate $request, User $user)
    {
        $user->update($request->validated());
        $user->syncRoles($request->get('roles'));

        return redirect()->back()->with('message', trans('siwei.messageUserUpdated'));
    }

    public function createFrm()
    {
        $roles = DB::table('roles')->pluck('name');
        return view('admin.users.form', [
            'roles' => $roles,
            'action' => 'create'
        ]);
    }

    public function create(UserCreate $request, User $user)
    {
        $user = User::create(array_merge(
            $request->validated(),
            ['password' => bcrypt(Tools::generateRandomString())]
        ));
        $user->syncRoles($request->get('roles'));

        return redirect()->route('admin.users.edit', ['user' => $user->id])->with('message', trans('siwei.messageUserCreated'));
    }

    public function password(HttpRequest $request, User $user)
    {
        if ($request->get('password') != '') {
            $user->password = bcrypt($request->get('password'));
            $user->update();

            return redirect()->route('admin.users.edit', ['user' => $user->id])->with('message', trans('siwei.messageUserPassword'));
        }

        return redirect()->route('admin.users.edit', ['user' => $user->id]);
    }

    public function delete(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('message', trans('siwei.messageUserDeleted'));
    }
}
