<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'registration']]);
    }

    public function login(Request $request): JsonResponse
    {
        $request->validate(
            [
                'email'    => 'required|email|max:255',
                'password' => 'required',
            ]
        );

        $credentials = $request->only(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function registration(Request $request): JsonResponse
    {
        $request->validate(
            [
                'name'     => 'required|max:255',
                'email'    => 'required|email|unique:users|max:255',
                'password' => 'required|max:255',
            ]
        );

        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        User::create(
            [
                'name'     => $name,
                'email'    => $email,
                'password' => Hash::make($password),
            ]
        );


        return response()->json(['message' => 'Successfully registration!']);
    }

    public function me(): JsonResponse
    {
        return response()->json(auth()->user());
    }

    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken(string $token): JsonResponse
    {
        return response()->json(
            [
                'access_token' => $token,
                'token_type'   => 'bearer',
                'expires_in'   => 60 * 60,
            ]
        );
    }
}
