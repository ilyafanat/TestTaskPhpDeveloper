@extends('layouts.master')
@section('title', 'Access Denied')
@section('content')
    <div class="w-full max-w-xl bg-white rounded-lg shadow-md p-8 text-center">
        <svg class="mx-auto h-12 w-12 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286zm0 13.036h.008v.008H12v-.008z" />
        </svg>
        <h2 class="text-3xl font-bold text-gray-800 mt-4 mb-2">Access Denied</h2>
        <p class="text-gray-600 text-lg">
            This link is either invalid or has expired.
        </p>
        <a href="{{ route('register.form') }}" class="mt-6 inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
            Register for a new link
        </a>
    </div>
@endsection
