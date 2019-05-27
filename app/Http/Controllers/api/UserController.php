<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\Token;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Image;

class UserController extends Controller
{
    public $tokenService;

    public function __construct(Token $tokenService)
    {

        $this->tokenService = $tokenService;
    }

    public function index()
    {
        return response()->json(User::all());
    }

    public function getProfile(Request $request)
    {
        $user = $request->user();
        if ($user) {
            return response()->json($request->user());

        }else{
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    public function updateProfile(ProfileUpdateRequest $request)
    {
        $data = $this->getProfileData($request);

        if ($request->profile_picture != '') {

        $image = $request->get('profile_picture');
        $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        \Image::make($request->get('profile_picture'))->save(public_path('images/').$name);

            $data['profile_picture'] = $name;
        }
        $user = User::where('id', $request->id)->update($data);
        if ($user) {
            return response()->json($user);

        }else{
            return response()->json(['message'=>"Couldn't update profile"]);
        }
    }

    public function getProfileData($request)
    {
        return [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'profession' => $request->profession,
            'phone' => $request->phone,
        ];
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create($request->all());
        if ($user) {
            $token = $this->tokenService->createToken();
            $user->api_token = $token;
            $user->save();
            return response()->json(['message' => 'User registered successfully']);
        }else{
            return response()->json(['message' => "User couldn't register"]);
        }
    }
    public function login(Request $request)
    {
        $user = User::where(['email' => $request->email, 'password' => $request->password])->first();
        if ($user) {
            return response()->json($user);
        }else{
            return response()->json(['message'=>'Login failed'],401);
        }
    }
}
