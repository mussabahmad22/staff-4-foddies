<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function users(){

        $users =  User::all();
        return view('users',compact('users'));
    }


    public function index(){

        $url = url('add_users');
        $title = 'Add New User';
        $text = 'Save';
        return view('add_users',['url'=>$url ,'title'=>$title ,'text'=>$text]);
    }

    public function add_users(Request $request){

        $users = new User();
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = $request->password;
        $users->save();
        return redirect(route('users',compact('users')))->with('success', 'User Added successfully');

    }

    public function delete_user($id){

        $users = User::findOrFail($id);
        $users->delete();
        return redirect(route('users'))->with('error', 'User Deleted successfully');

    }

    public function edit_user($id){

        $record = User::find($id);
        $url = url('update_user') ."/". $id;
        $title = 'EDIT USER';
        $text = 'Update';
        return view('add_users',['record'=> $record , 'url'=>$url ,'title'=>$title ,'text'=>$text]);

    }
    public function update_user($id, Request $request){

        $users = User::findOrFail($id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = $request->password;
        $users->save();
        return redirect(route('users'))->with('success', 'User Update successfully');

    }

}
