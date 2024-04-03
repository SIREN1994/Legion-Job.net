@extends('layout')
@section('content')


<div class="flex flex-wrap justify-center">
    <!--This $jpbs data came from app service provider-->
    @foreach ($companies as $company)
    <div class="bg-white p-8 rounded shadow-md w-96 m-4">
        <img src="{{ asset($company->logo) }}" alt="{{ $company->title }} Logo" class="w-full h-32 object-cover mb-4">

        <h2 class="text-xl font-semibold mb-2">{{ $company->title }}</h2>
        <h2 class="text-xl font-semibold mb-2">Hiring Company : {{ $company->company }}</h2>
        <p class="text-gray-500 mb-2">{{ $company->tags }}</p>
        <h2 class="text-xl font-semibold mb-2">Location: {{ $company->location }}</h2>
        <!--Edit -->
        <form action="/detailjob" method="GET">
            @csrf
            <button type="submit" name="getID" value="{{$company->job_id}}" class="bg-blue-500 text-white p-2 rounded w-full hover:bg-blue-600 focus:outline-none">
                Apply Now
            </button> <br><br>       
        </form>
    </div>
    @endforeach

</div>
    
@endsection