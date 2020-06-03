<?php
/**
 * Created by PhpStorm.
 * User: saeed
 * Date: 6/2/2020
 * Time: 5:31 PM
 */

namespace App\Repositories;



use App\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{

    public function users(){
        return User::all();
    }

    public function signUp($request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        return $user;
    }
    public function update( $request , $id){
        $user = User::find($id);
        if (! $user){
            return response()->json(['error'=>'user not found'],404);
        }
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
         $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
    }

    public function delete($id){
        $user = User::find($id);
        if (! $user){
            return response()->json(['error'=>'user not found'],404);
        }
        $user->delete();
    }

}