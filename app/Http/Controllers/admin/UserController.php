<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\JobType;
use App\Models\Job;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function index(){
        $users = User::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.users.list',[
            'users'=> $users
        ]);
    }
    public function edit($id){
        $user = User::findOrFail($id); 
        return view('admin.users.edit',[
            'user'=>$user
        ]);
        

    }
    public function update($id, Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:20',
            'email' => 'required|email|unique:users,email,' . $id . ',id',
        ]);
    
        if ($validator->passes()) {
            $user = User::find($id); 
            $user->name = $request->name;
            $user->email = $request->email;
            $user->desgination = $request->desgination; 
            $user->mobile = $request->mobile;
            $user->save();
    
            session()->flash('success', 'User Information Update Successful.');
    
            return response()->json([
                'status' => true,
                'errors' => []
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
    public function destroy(Request $request){
        $id = $request->id;

        $user = User::find($id);

        if ($user == null){
            session()->flash('error', 'User Not found.');
            return response()->json([
                'status'=>false
            ]);
        }
        $user->delete();
        session()->flash('message', 'User Deleted Successfull.');
            return response()->json([
                'status'=>true
            ]);
    }
}







