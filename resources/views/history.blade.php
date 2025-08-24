@extends('layouts.master')
@section('title', 'Game History')
@section('content')
    <div class="container mx-auto p-4 md:p-8 max-w-4xl">
        <div class="bg-white rounded-lg shadow-md p-8">
            <div class="flex justify-between items-center mb-6 border-b pb-4">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Game History</h2>
                    <p class="text-gray-600">Showing all plays for {{ $user->username }}</p>
                </div>
                <a href="{{ route('access.page', ['token' => $link->token]) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md transition duration-150">
                    &larr; Back to Game
                </a>
            </div>

             @if (count($history) > 0)
                <div class="space-y-4">
                    @foreach($history as $item)
                        <div class="p-4 rounded-lg @if($item->outcome === 'Win') bg-green-50 @else bg-red-50 @endif border @if($item->outcome === 'Win') border-green-200 @else border-red-200 @endif flex justify-between items-center">
                            <div>
                                <p class="font-semibold">
                                    <span class="text-gray-800">Number:</span> <span class="text-blue-600">{{ $item->number }}</span> |
                                    <span class="text-gray-800">Outcome:</span> <span class="font-bold @if($item->outcome === 'Win') text-green-600 @else text-red-600 @endif">{{ $item->outcome }}</span>
                                    @if ($item->win_amount > 0)
                                        | <span class="text-gray-800">Win Sum:</span> <span class="text-green-700 font-bold">{{ $item->win_amount }}</span>
                                    @endif
                                </p>
                            </div>
                            <div class="text-sm text-gray-500 text-right">
                                {{ \Carbon\Carbon::parse($item->timestamp)->format('M d, Y - h:i A') }}
                                <span class="block text-xs">({{ \Carbon\Carbon::parse($item->timestamp)->diffForHumans() }})</span>
                            </div>
                        </div>
                    @endforeach
                </div>
             @else
                <p class="text-center text-gray-500 py-8">No games played yet. Go back and play!</p>
             @endif
        </div>
    </div>
@endsection
