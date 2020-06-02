<?php

namespace App\Http\Controllers\api;

use App\Mail\ResetPasswordEmail;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function sendEmail(Request $request){
        $request->validate([
            'email' => 'required|email',
        ]);
        if (!$this->validateEmail($request->email)){
            $this->failedResponse();
        }
        $this->send($request->email);
        return $this->successResponse();
    }

    public function send($email){
        $token = $this->createToken($email);
        Mail::to($email)->send(new ResetPasswordEmail($token));

    }

    public function createToken($email){
        $oldToken = DB::table('password_resets')->where('email',$email)->first();
        if ($oldToken){
            return $oldToken->token;
        }
        $token = Str::random(60);
        $this->saveToken($token,$email);
        return $token;
    }

    public function saveToken($token,$email){
        DB::table('password_resets')->insert([
            'email'=>$email,
            'token'=>$token,
            'created_at'=>Carbon::now()
        ]);
    }

    public function validateEmail($email){
        return !!User::where('email',$email)->first();
    }

    public function failedResponse(){
        return response()->json(['error'=>'email does not exist'],404);
    }

    public function successResponse(){
        return response()->json(['message'=>'email send successfully'],200);
    }
}
