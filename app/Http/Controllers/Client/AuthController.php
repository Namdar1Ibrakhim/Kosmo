<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Client;
use App\Models\ClientLogin;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return Client
     */


    public function sms_send(Request $request){
        $phone = $request->phone;
        $code = mt_rand(0, 9) .  mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9);

        if(ClientLogin::where('phone', $phone)->exists()) {
            $client = ClientLogin::where('phone', $phone)->first();;
            $client-> code = $code;
            $client->save();

        }else {
            $client = ClientLogin::create([
                'phone' => $phone,
                'code' => $code
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'The code has been sent',
        ], 200);
    }


    public function sms_auth(Request  $request){
        $formFields = $request->only(['phone', 'code']);

        if(ClientLogin::where('phone', $request->phone)->exists()) {
            $clientLogin = ClientLogin::where('phone', $request->phone)->first();

            if($clientLogin->code == $request->code){
                if(Client::where('phone', $request->phone)->exists()){
                    $user = Client::where('phone', $request->phone)->first();
                    return response()->json([
                        'status' => true,
                        'message' => 'Success login',
                        'token' => $user->createToken("API TOKEN")->plainTextToken
                    ], 200);
                }else{
                    return response()->json([
                        'status' => true,
                        'message' => 'Success login',
                        'token' => $clientLogin->createToken("API TOKEN")->plainTextToken
                    ], 200);
                }

            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'ERROR',
                ], 401);
            }
        }else{
            return response()->json([
                'status' => false,
                'message' => 'User dont exists',
            ], 401);
        }
    }

    public function register(Request $request){
        try{
            $validateUser = Validator::make($request->all(),
            [
                'phone' => Auth::user()->phone,
                'name' => 'required',
                'surname' => 'required',
                'age' => 'required',
                'gender' => 'required',
                'email' => 'required|email'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Client::where('phone', Auth::user()->phone)>exists()) {
                $user = Client::create([
                    'phone' => Auth::user()->phone,
                    'name' => $request->name,
                    'surname' => $request->surname,
                    'age' => $request->age,
                    'gender' => $request->gender,
                    'email' => $request->email,
                ]);

                return response()->json([
                    'status' => true,
                    'message' => 'Success registration',
                    'token' => $user->createToken("API TOKEN")->plainTextToken
                ], 200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'User is exists',
                ], 401);
            }

        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}

