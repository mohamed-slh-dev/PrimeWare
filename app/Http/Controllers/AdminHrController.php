<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Department;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\UserRole;
use App\Models\Leave;


class AdminHrController extends Controller
{
    public function departments()
    {
        $departments = Department::paginate(10);
      

        return view('admins.HR.departments',compact(['departments']));
     }

       public function add_department(Request $request)
       {
      
        $newdept = new Department();

        $newdept->name=$request->dept_name;
        
        $newdept->save();
       
            return redirect()->back()->with('success','Department Added Successfully');
       }

       public function delete_department($dept_id)
       {
       
        $user_dept = User::where('department_id',$dept_id)
        ->update([
            'department_id' => 0
        ]);

            $dept = Department::find($dept_id);
            $dept->delete();

            return redirect()->back()->with('success','deleted successfully');
    
       }

       public function roles()
       {
        $users = User::all();
        $users_roles = UserRole::all();
        $roles = Role::all();

        return view('admins.HR.roles',compact(['roles','users','users_roles']));

       }

       public function addrole(Request $request)
       {
        $role_name = array(); 
        $role_name['name']=$request->role_name;
        $insert_role = Role::insertGetId($role_name);
    
        $role_id = $insert_role;
        
        $modules_access = array();
            $modules = (['dashboard','partners','drivers','customers','operations','assets','HR','reports','settings']);
            for ($i=1; $i < 10 ; $i++) { 
                $modules_access[] = $request->$i;
            }

            for ($i=0; $i < 9 ; $i++) {
                $permission_insert = new Permission;

                $permission_insert->role_id =  $role_id;
                $permission_insert->modulename =  $modules[$i];
                $permission_insert->access=  $modules_access[$i];
               $permission_insert->save();
               }

               return redirect()->back()->with('success','New Role Added');

       }

       public function deleterole($role_id)
       {

             $check = UserRole::where('role_id', $role_id)->get();

             if ($check->count() > 0 ) {
                return redirect()->back()->with('warning','Make sure the role is not assigned to any employee!');
             }else{
                $permissions = Permission::where('role_id', $role_id);
                $permissions->delete();
   
               $role = Role::find($role_id);
               $role->delete();

               return redirect()->back()->with('success','Role Deleted');
             }

           

       }

       public function adduserrole(Request $request)
       {

        $find =  UserRole::where('user_id', $request->user_id)->first();
        if ($find) {
            UserRole::where('user_id',$request->user_id)
            ->update([
            'role_id' => $request->role_id
      ]);
        }else{
            $user_role = new UserRole;
            $user_role->user_id = $request->user_id;
            $user_role->role_id = $request->role_id;
            $user_role->save();
        }

      return redirect()->back()->with('success','User Role Updated Successfully');


       }

       public function employees(){
           $roles = Role::all();
           $departments = Department::all();

           $users = User::all();

           return view('admins.HR.employees',compact(['roles','users','departments']));

       }

       public function addemployee(Request $request )
       {
            $user = array();

           $user['name']= $request->name;
           $user['phone'] = $request->phone;
           $user['email'] = $request->email;
           $user['department_id']  = $request->dept_id;
           $user['password'] = Hash::make($request->password);

           $user_id = User::insertGetId($user);

           $user_role = new UserRole();
           $user_role->Role_id = $request->role_id;
           $user_role->user_id = $user_id;
           $user_role->save();

           return redirect()->back()->with('success','New Employee Added ');

       }

       public function updatepassword(Request $request)
       {
           $new_pass = Hash::make($request->new_pass);

           User::where('id',$request->user_id)
           ->update([
            'password' => $new_pass
         ]);

         return redirect()->back()->with('success','Password Reset Successfully');


       }

       public function leave(Request $request)
       {
        $leave = Leave::all();
        $users = User::all();


        return view('admins.HR.leave',compact(['leave','users']));

       }

       public function addleave(Request $request)
       {
           $leave  = new leave();

           $leave->status = $request->status;
           $leave->user_id = $request->user_id;
           $leave->datefrom = $request->from;
           $leave->dateto = $request->to;
           $leave->subject = $request->subject;

           $leave->save();

           return redirect()->back()->with('success','Leave Added Successfully');

       }

       public function deleteleave($leave_id)
       {
        $delete_leave = Leave::find($leave_id);
        $delete_leave->delete();

        return redirect()->back()->with('success','Leave Deleted Successfully');

       }
}
