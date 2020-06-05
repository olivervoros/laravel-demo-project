<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Passenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:passengers',
            'password' => 'required|confirmed'
        ]);

        $validatedData['password'] = bcrypt($request->password);

        $user = Passenger::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([ 'user' => $user, 'access_token' => $accessToken]);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Invalid Credentials']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['user' => auth()->user(), 'access_token' => $accessToken]);

    }

    public function logout()
    {
        if(empty(auth()->user())) {
            return response()->json(['message' => 'No User Found...'], 404);
        }

        $accessToken = auth()->user()->token();
        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);

        $accessToken->revoke();
        return response()->json(null, 204);
    }

    public function getLoggedInPassenger()
    {
        if(empty(auth()->user())) {
            return response()->json(['message' => 'No User Found...'], 404);
        }

        $accessToken = auth()->user()->token();
        $loggedInPassenger = DB::table('oauth_access_tokens')
            ->select('passengers.name', 'passengers.email', 'oauth_access_tokens.id as access_token')
            ->join('passengers', 'oauth_access_tokens.user_id', '=', 'passengers.id')
            ->where('oauth_access_tokens.id', $accessToken->id)->get();

        return response()->json($loggedInPassenger, 200);
    }
}
