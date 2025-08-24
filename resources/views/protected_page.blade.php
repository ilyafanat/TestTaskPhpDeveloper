@extends('layouts.master')
@section('title', 'Welcome')
@section('content')
    <div class="container mx-auto p-4 md:p-8 max-w-4xl">
        <div class="bg-white rounded-lg shadow-md p-8 mb-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-2 text-center">Access Granted!</h2>
            <p class="text-gray-600 text-lg text-center">
                Welcome, <span class="font-semibold text-blue-600">{{ $user->username }}</span>!
            </p>
            <p class="text-gray-500 mt-2 text-center text-sm">
                Your access is valid until:
                <span class="font-medium">{{ $link->expires_at->format('F j, Y, g:i a') }}</span>
            </p>

            <div class="mt-8 flex flex-col sm:flex-row justify-center items-center gap-4 border-t pt-6">
                <a href="{{ route('link.generate', ['token' => $link->token]) }}" class="w-full sm:w-auto text-center bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md transition duration-150">
                    Generate New Link
                </a>
                <form action="{{ route('link.deactivate', ['token' => $link->token]) }}" method="POST" class="w-full sm:w-auto">
                    @csrf
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md transition duration-150">
                        Deactivate Current Link
                    </button>
                </form>

                <a href="{{ route('game.history', ['token' => $link->token]) }}" class="w-full sm:w-auto text-center bg-yellow-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md transition duration-150">
                    History
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-8 mb-8">
            <div class="text-center">
                <form action="{{ route('game.play', ['token' => $link->token]) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-6 rounded-lg text-lg transition duration-150">
                        Imfeelinglucky
                    </button>
                </form>
            </div>

            @if ($gameResult)
                <div class="mt-6 text-center p-4 rounded-lg
                    @if ($gameResult['outcome'] === 'Win') bg-green-100 border-green-400 @else bg-red-100 border-red-400 @endif">
                    <p class="font-semibold text-xl">Your number: <span class="text-blue-600">{{ $gameResult['number'] }}</span></p>
                    <p class="text-2xl font-bold
                        @if ($gameResult['outcome'] === 'Win') text-green-700 @else text-red-700 @endif">
                        You {{ $gameResult['outcome'] }}!
                    </p>
                    @if ($gameResult['outcome'] === 'Win' && $gameResult['win_amount'] > 0)
                        <p class="text-lg text-green-800">Win Sum: {{ $gameResult['win_amount'] }}</p>
                    @endif
                </div>
            @endif
        </div>
@endsection
