<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    //populate Users Datatable

    public function getUsers() {
        $users = User::select('id','name','email')->with('roles')->get()->toarray();

        foreach ($users as $user) {
            $user['roles']= $user['roles'][0]['name'];
            $userData[] = $user;
        }

        return $userData;
    }

    //get Roles to populate select input with roles data

    public function getRoles() {
        $roles = Role::pluck('name');

        return $roles;
    }



    public function getUser($user_id) {
        $user = User::with('roles')->where('id',$user_id)->get()->first()->toArray();
        $user['roles'] = $user['roles'][0]['name']; 
        return $user;
    }

    //Update user with new data from UserEditForm

    public function update(Request $request,$user_id) {
        $user = User::find($user_id);
        $user->update($request->all());
        $user->syncRoles($request->input('role'));
    }
}
