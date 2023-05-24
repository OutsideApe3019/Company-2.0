<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Role;
use Permission;
use User;
use News;
use Auth;

class PanelController extends Controller
{
    public function editUser(Request $request, User $user) {
        $validated = $request->validate([
            'name' => ['string', 'max:255'],
            'email' => ['string', 'max:255', 'email', 'unique:users'],
            'role' => ['string'],
        ]);

        if ($request->input('name') !== null) {
            $user->name = $request->input('name');
        }

        if ($request->input('email') !== null) {
            $user->email = $request->input('email');
        }

        if ($request->input('role') !== null) {
            $user->syncRoles($request->input('role'));
        }

        if ($request->input('banned') !== null) {
            $user->ban();
        } else {
            $user->unban();
        }

        $user->save();
        toastr()->success('User edited successfully.');
        return redirect()->route('panel.users.index');
    }

    public function createRole(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'unique:roles', 'max:255'],
            'color' => ['required', 'string', 'max:255'],
            'prefix' => ['required', 'string', 'max:255'],
        ]);

        $role = Role::create([
            'name' => $request->input('name'),
            'color' => $request->input('color'),
            'prefix' => $request->input('prefix'),
        ]);

        foreach (Permission::all() as $perm) {
            $role->revokePermissionTo($perm->name);
        }

        foreach (Permission::all() as $perm) {
            if ($request->input('perm-' . $perm->id) !== null) {
                $role->givePermissionTo($perm->name);
            }
        }

        toastr()->success('Role created successfully.');
        return redirect()->route('panel.roles.index');
    }

    public function editRole(Request $request, Role $role) {
        $validated = $request->validate([
            'name' => ['string', 'unique:roles', 'max:255'],
            'color' => ['string', 'max:255'],
            'prefix' => ['string', 'max:255'],
        ]);

        if ($request->input('name') !== null) {
            $role->name = $request->input('name');
        }

        if ($request->input('color') !== null) {
            $role->color = $request->input('color');
        }

        if ($request->input('prefix') !== null) {
            $role->prefix = $request->input('prefix');
        }

        foreach (Permission::all() as $perm) {
            $role->revokePermissionTo($perm->name);
        }

        foreach (Permission::all() as $perm) {
            if ($request->input('perm-' . $perm->id) !== null) {
                $role->givePermissionTo($perm->name);
            }
        }

        $role->save();
        toastr()->success('Role edited successfully.');
        return redirect()->route('panel.roles.index');
    }

    public function deleteRole(Role $role) {
        $role->delete();

        toastr()->success("Role deleted successfully.");
        return redirect()->route('panel.roles.index');
    }

    public function createPerm(Request $request) {
        Permission::create([
            'name' => $request->input('name'),
        ]);

        toastr()->success('Permission created successfully.');
        return redirect()->route('panel.perms.index');
    } 

    public function deletePerm(Permission $perm) {
        $perm->delete();

        toastr()->success('Permission deleted successfully.');
        return redirect()->route('panel.perms.index');
    }

    public function createNew(Request $request) {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'text' => ['required', 'string', 'max:10000'],
        ]);

        News::create([
            'title' => $request->input('title'),
            'text' => $request->input('text'),
            'user_id' => Auth::user()->id,
        ]);

        toastr()->success('New created successfully.');
        return redirect()->route('panel.news.index');
    } 

    public function deleteNew(News $new) {
        $new->delete();

        toastr()->success('New Deleted Successfully.');
        return redirect()->route('panel.news.index');
    }
}
