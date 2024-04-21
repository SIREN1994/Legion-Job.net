@extends('layout')

@section('content')
    <div class="flex justify-center items-center h-screen bg-gray-100">
        <div class="bg-white shadow-md rounded px-8 py-6">
            <h2 class="text-3xl font-bold text-red-600 mb-4">Oops! Something went wrong...</h2>
            <p class="text-gray-600 mb-4">We're sorry, but an error occurred while processing your request. Please try again later.</p>
            <a href="/" class="text-blue-600 hover:underline">Back to Home</a>
        </div>
    </div>
    
@endsection
