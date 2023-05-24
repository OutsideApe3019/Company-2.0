<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use User;
use Role;
use News;
use Permission;
use Carbon;
use Auth;

class PanelPagesController extends Controller
{
    public function index()
    {
        return view('panel.index');
    }

    public function users()
    {
        $users = User::paginate(15);
        $totalUsers = User::count();
        $totalLastUsers = User::where('created_at', '>=', Carbon::now()->subDays(7))->count();

        return view('panel.users.index', [
            'users' => $users,
            'totalUsers' => $totalUsers,
            'totalLastUsers' => $totalLastUsers,
        ]);
    }

    public function editUser(User $user)
    {
        return view('panel.users.edit', [
            'user' => $user,
        ]);
    }

    public function roles()
    {
        $roles = Role::paginate(15);

        return view('panel.roles.index', [
            'roles' => $roles,
        ]);
    }

    public function createRole()
    {
        $prm = Permission::all();
        $permissions = [];
        $result = [];
        
        foreach ($prm as $pp) {
            $permissions[] = $pp->name;
        }
        
        foreach ($permissions as $permission) {
            $parts = explode('.', $permission);
            $temp = &$result;
            foreach ($parts as $part) {
                if (!isset($temp[$part])) {
                    $temp[$part] = [];
                }
                $temp = &$temp[$part];
            }
        }
        
        function generateNestedList($array, $parent = '')
        {
            $html = '<ul>';
        
            foreach ($array as $key => $value) {
                $fullKey = $parent ? $parent . '.' . $key : $key;
                $permission = Permission::where('name', $fullKey)->first();
        
                $html .= '<li>';
        
                if ($permission) {
                    $html .= '<div class="mb-3 form-check"> <input class="form-check-input ' . ($permission->name !== '*' ? 'otherPerm' : '') . '"';
        
                    if ($permission->name == '*') {
                        $html .= ' id="allPerm"';
                    }
        
                    $html .= ' type="checkbox" name="perm-' . $permission->id . '" id="perm-' . $permission->id . '"';

                    $html .= '> <label class="form-check-label" for="perm-' . $permission->id . '">' . $permission->name . '</label> </div>';
                } else {
                    $html .= $key ? $key : '';
        
                    if (!empty($value)) {
                        $html .= generateNestedList($value, $fullKey);
                    }
                }
        
                $html .= '</li>';
            }
        
            $html .= '</ul>';
        
            return $html;
        }

        $permsUl = generateNestedList($result);

        return view('panel.roles.create', [
            'permsUl' => $permsUl,
        ]);
    }

    public function editRole(Role $role)
    {
        $prm = Permission::all();
        $permissions = [];
        $result = [];
        
        foreach ($prm as $pp) {
            $permissions[] = $pp->name;
        }
        
        foreach ($permissions as $permission) {
            $parts = explode('.', $permission);
            $temp = &$result;
            foreach ($parts as $part) {
                if (!isset($temp[$part])) {
                    $temp[$part] = [];
                }
                $temp = &$temp[$part];
            }
        }
        
        function generateNestedList($array, $parent = '', $role = null)
        {
            $html = '<ul>';
        
            foreach ($array as $key => $value) {
                $fullKey = $parent ? $parent . '.' . $key : $key;
                $permission = Permission::where('name', $fullKey)->first();
        
                $html .= '<li>';
        
                if ($permission) {
                    $html .= '<div class="form-check"> <input class="form-check-input ' . ($permission->name !== '*' ? 'otherPerm' : '') . '"';
        
                    if ($permission->name == '*') {
                        $html .= ' id="allPerm"';
                    }
        
                    $html .= ' type="checkbox" name="perm-' . $permission->id . '" id="perm-' . $permission->id . '"';
        
                    if ($role && $role->hasPermissionTo($permission->name)) {
                        $html .= ' checked';
                    }
        
                    $html .= '> <label class="form-check-label" for="perm-' . $permission->id . '">' . $permission->name . '</label> </div>';
                } else {
                    $html .= $key ? $key : '';
        
                    if (!empty($value)) {
                        $html .= generateNestedList($value, $fullKey, $role);
                    }
                }
        
                $html .= '</li>';
            }
        
            $html .= '</ul>';
        
            return $html;
        }

        $permsUl = generateNestedList($result, '', $role);

        return view('panel.roles.edit', [
            'role' => $role,
            'permsUl' => $permsUl,
        ]);
    }

    public function perms()
    {
        $prm = Permission::all();
        $permissions = [];
        $result = [];

        foreach ($prm as $pp) {
            $permissions[] = $pp->name;
        }

        foreach ($permissions as $permission) {
            $parts = explode('.', $permission);
            $temp = &$result;
            foreach ($parts as $part) {
                if (!isset($temp[$part])) {
                    $temp[$part] = [];
                }
                $temp = &$temp[$part];
            }
        }

        function generateUl($array, $parent = '')
        {
            $html = '<ul>';

            foreach ($array as $key => $value) {
                $fullKey = $parent ? $parent . '.' . $key : $key;
                $permission = Permission::where('name', $fullKey)->first();

                $html .= '<li>';

                if ($permission) {
                    if(Auth::user()->hasPermissionTo('panel.perms.delete')) {
                        $html .= '<form action="' . route('panel.perms.delete', ['perm' => $permission->id]) . '" method="POST">' . csrf_field() . '<button type="submit" class="p-0 btn btn-link text-danger">';
                    }
                    
                    $html .= $permission->name;

                    if(Auth::user()->hasPermissionTo('panel.perms.delete')) {
                        $html .= '</button></form>';
                    }
                } else {
                    $html .= $key ? $key : '';

                    if (!empty($value)) {
                        $html .= generateUl($value, $fullKey);
                    }
                }

                $html .= '</li>';
            }

            $html .= '</ul>';

            return $html;
        }

        $permsUl = generateUl($result);

        return view('panel.perms.index', [
            'perms' => $result,
            'permsUl' => $permsUl,
        ]);
    }

    public function createPerm()
    {
        $prm = Permission::all();
        $permissions = [];
        $result = [];

        foreach ($prm as $pp) {
            $permissions[] = $pp->name;
        }

        foreach ($permissions as $permission) {
            $parts = explode('.', $permission);
            $temp = &$result;
            foreach ($parts as $part) {
                if (!isset($temp[$part])) {
                    $temp[$part] = [];
                }
                $temp = &$temp[$part];
            }
        }

        function generateUl($array, $parent = '')
        {
            $html = '<ul>';

            foreach ($array as $key => $value) {
                $fullKey = $parent ? $parent . '.' . $key : $key;
                $permission = Permission::where('name', $fullKey)->first();

                $html .= '<li>';

                if ($permission) {
                    $html .= $permission->name;
                } else {
                    $html .= $key ? $key : '';

                    if (!empty($value)) {
                        $html .= generateUl($value, $fullKey);
                    }
                }

                $html .= '</li>';
            }

            $html .= '</ul>';

            return $html;
        }

        $permsUl = generateUl($result);

        return view('panel.perms.create', [
            'permsUl' => $permsUl,
        ]);
    }

    public function news() {
        $news = News::paginate(15);

        return view('panel.news.index', [
            'news' => $news,
        ]);
    }

    public function createNew() {
        return view('panel.news.create');
    }
}
