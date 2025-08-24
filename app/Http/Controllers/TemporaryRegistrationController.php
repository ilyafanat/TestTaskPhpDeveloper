<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GameService;
use App\Services\TemporaryUserService;
use Illuminate\Support\Facades\Validator;

class TemporaryRegistrationController extends Controller
{
    public function __construct(
        protected TemporaryUserService $userService,
        protected GameService $gameService
    ) {}

    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|min:5|max:255|unique:temporary_users,username',
            'phone_number' => 'required|phone:INTERNATIONAL,mobile',
        ]);

        if ($validator->fails()) {
            return redirect()->route('register.form')
                        ->withErrors($validator)
                        ->withInput();
        }

        $link = $this->userService->createUserAndLink($validator->validated());
        $accessLink = route('access.page', ['token' => $link->token]);

        return view('link_generated', ['link' => $accessLink]);
    }
}
