<?php

namespace App\Services;

use App\Models\TemporaryUser;
use App\Models\Link;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TemporaryUserService
{

    public function createUserAndLink(array $data): Link
    {
        $user = TemporaryUser::firstOrCreate(
            ['username' => $data['username']],
            ['phone_number' => $data['phone_number']]
        );

        return $this->createLinkForUser($user);
    }

    public function createLinkForUser(TemporaryUser $user): Link
    {
        return $user->links()->create([
            'token' => Str::random(40),
            'expires_at' => Carbon::now()->addDays(7),
            'is_active' => true,
        ]);
    }

    public function findActiveLinkByToken(string $token): ?Link
    {
        return Link::with('temporaryUser')
            ->where('token', $token)
            ->where('is_active', true)
            ->where('expires_at', '>', now())
            ->first();
    }

    public function deactivateLink(string $token): bool
    {
        $link = Link::where('token', $token)->first();

        if ($link) {
            $link->is_active = false;
            $link->save();
            return true;
        }

        return false;
    }
}