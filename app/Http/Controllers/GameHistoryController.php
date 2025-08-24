<?php

namespace App\Http\Controllers;

use App\Services\GameService;
use App\Services\TemporaryUserService;

class GameHistoryController extends Controller
{
    public function __construct(
        protected TemporaryUserService $userService,
        protected GameService $gameService
    ) {}

    public function showHistory($token)
    {
        $link = $this->userService->findActiveLinkByToken($token);

        if (!$link) {
            return view('link_expired');
        }

        $user = $link->temporaryUser;
        $history = $this->gameService->getHistory($user->id, $token, 100);

        return view('history', [
            'user' => $user,
            'link' => $link,
            'history' => $history
        ]);
    }
}
