<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository){
        $this->userRepository = $userRepository;
    }

    public function users(){
        return response()->json($this->userRepository->users(),200);
    }

    public function register(Request $request){
       $newUser = $this->userRepository->signUp($request);
       if ($newUser)
           return $this->signUpResponse($newUser);
       else
           return response()->json(['error'=>'something got wrong,please try again'],400);
    }

    public function update(Request $request,$id){
         $this->userRepository->update($request,$id);
         return $this->updateResponse();
    }

    public function delete($id){
        $this->userRepository->delete($id);
        return $this->deleteResponse();
    }

    public function signUpResponse($newUser){
        return response()->json([
           'message'=>'user created successfully',
           'user'=>$newUser
        ]);
    }

    public function updateResponse(){
        return response()->json([
            'message'=>'user updated successfully',
        ]);
    }
    public function deleteResponse(){
        return response()->json([
            'message'=>'user deleted successfully',
        ]);
    }
}
