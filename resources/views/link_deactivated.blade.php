@extends('layouts.master')
@section('title', 'Link Deactivated')
@section('content')
    <div class="w-full max-w-xl bg-white rounded-lg shadow-md p-8 text-center">
        <svg class="mx-auto h-12 w-12 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
        </svg>

        <h2 class="text-3xl font-bold text-gray-800 mt-4 mb-2">Link Successfully Deactivated</h2>
        <p class="text-gray-600 text-lg">
            Your access link has been disabled.
        </p>
    </div>
@endsection
