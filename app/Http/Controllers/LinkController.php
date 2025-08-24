<?php

namespace App\Http\Controllers;

use App\Services\GameService;
use App\Services\TemporaryUserService;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function __construct(
        protected TemporaryUserService $userService,
        protected GameService $gameService
    ) {}

    public function accessPage($token)
    {
        $link = $this->userService->findActiveLinkByToken($token);

        if (!$link) {
            return view('link_expired');
        }

        $user = $link->temporaryUser;

        return view('protected_page', [
            'user' => $user,
            'link' => $link,
            'gameResult' => session('gameResult'),
        ]);
    }

    public function deactivateLink($token)
    {
        $this->userService->deactivateLink($token);
        return view('link_deactivated');
    }

    public function generateNewLink($token)
    {
        $link = $this->userService->findActiveLinkByToken($token);

        if (!$link) {
            return view('link_expired');
        }

        $user = $link->temporaryUser;

        $link = $this->userService->createLinkForUser($user);
        $accessLink = route('access.page', ['token' => $link->token]);

        return view('link_generated', ['link' => $accessLink]);
    }
}
