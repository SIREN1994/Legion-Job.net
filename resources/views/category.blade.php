@extends('layout')
@section('content')

<div class="text-center py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-4">Jobs Search By Category</h1>
</div>

<div class="flex flex-wrap justify-center">
    
    <!--This $jpbs data came from app service provider-->
    @foreach ($categories as $category)
    <div class="bg-white p-8 rounded shadow-md w-96 m-4">
        <img src="{{ asset($category->logo) }}" alt="{{ $category->title }} Logo" class="w-full h-32 object-cover mb-4">

        <h2 class="text-xl font-semibold mb-2">{{ $category->title }}</h2>
        <h2 class="text-xl font-semibold mb-2">Hiring Company : {{ $category->company }}</h2>
        <p class="text-gray-500 mb-2">{{ $category->tags }}</p>
        <h2 class="text-xl font-semibold mb-2">Location: {{ $category->location }}</h2>
        <!--Edit -->
        <form action="/detailjob" method="GET">
            @csrf
            <button type="submit" name="getID" value="{{$category->job_id}}" class="bg-blue-500 text-white p-2 rounded w-full hover:bg-blue-600 focus:outline-none">
                Apply Now
            </button> <br><br>       
        </form>
    </div>
    @endforeach

</div>
    
@endsection