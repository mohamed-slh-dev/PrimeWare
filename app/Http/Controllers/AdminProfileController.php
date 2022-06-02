<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    

    public function profile() {

        $user = User::find(session()->get('user_id'));

        $departments = Department::all();

        $roles = Role::all();

        return view('admins.profiles.index', compact('user', 'departments', 'roles'));
    }






    public function updateprofile(Request $request) {

        $user = User::find(session()->get('user_id'));

        // update basic info
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        // password update
        if(!empty($request->password)) {
            
            $user->password = Hash::make($request->password);

        }




        // A - profile pic (not required)
        if (!empty($request->file('avatar'))) {

            $logoname = time() . '-' . $request->file('avatar')->getClientOriginalName();

            $request->file('avatar')->move(public_path('assets/img/admins/profiles'), $logoname);

            $user->avatar = $logoname;

            // change session logo
            session(['user_avatar' => $logoname]);

        } //end of avatar



        // $user->department_id = $request->departmentid;


        // // update role by relation or delete it
        // // 1- delete it
        // if (empty($request->roleid)) {

        //     $deleteuserrole = UserRole::where('user_id', $user->id)->delete();

        // } 

        // // 2- update it 
        // else {

        //     // check if it exists
        //     $userrole = UserRole::where('user_id', $user->id)->count();

        //     // update
        //     if ($userrole > 0) {
        //         $updateuserrole = UserRole::where('user_id', $user->id)->update([
        //             'role_id' => $request->roleid
        //         ]);
        //     }
            
        //     // add new
        //     else {

        //         $newrole = new UserRole();

        //         $newrole->user_id = $user->id;
        //         $newrole->role_id = $request->roleid;

        //         $newrole->save();

        //     }


        // }


        $user->save();


        return redirect()->route('admin.profile');
    }
}
