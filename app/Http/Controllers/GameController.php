<?php

namespace App\Http\Controllers;

use App\Services\GameService;
use App\Services\TemporaryUserService;

class GameController extends Controller
{
    public function __construct(
        protected TemporaryUserService $userService,
        protected GameService $gameService
    ) {}

    public function playLuckyGame($token)
    {
        $link = $this->userService->findActiveLinkByToken($token);

        if (!$link) {
            return view('link_expired');
        }

        $result = $this->gameService->play($link->temporaryUser->id, $token);

        return redirect()->route('access.page', ['token' => $token])
                         ->with('gameResult', $result);
    }
}
