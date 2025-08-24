<?php

namespace App\Services;

use Illuminate\Support\Facades\Redis;

class GameService
{
    private const HISTORY_KEY_PREFIX = 'game_history:';

    public function play(int $userId, string $token): array
    {
        $number = rand(1, 1000);
        $result = $this->calculateResult($number);

        $this->storeResult($userId, $token, $result);

        return $result;
    }

    public function getHistory(int $userId, $token): array
    {
        $historyKey = self::HISTORY_KEY_PREFIX . $userId.':'. $token;
        $history = Redis::lrange($historyKey, 0, 2);

        return array_map('json_decode', $history);
    }

    private function calculateResult(int $number): array
    {
        $isWin = $number % 2 === 0;
        $winAmount = 0;

        if ($isWin) {
            if ($number > 900) {
                $winAmount = round($number * 0.70);
            } elseif ($number > 600) {
                $winAmount = round($number * 0.50);
            } elseif ($number > 300) {
                $winAmount = round($number * 0.30);
            } else {
                $winAmount = round($number * 0.10);
            }
        }

        return [
            'number' => $number,
            'outcome' => $isWin ? 'Win' : 'Lose',
            'win_amount' => $winAmount,
            'timestamp' => now()->toDateTimeString(),
        ];
    }

   
    private function storeResult(int $userId, string $token, array $result): void
    {
        $historyKey = self::HISTORY_KEY_PREFIX . $userId.':'. $token;
        Redis::lpush($historyKey, json_encode($result));
        Redis::ltrim($historyKey, 0, 2);
    }
}
