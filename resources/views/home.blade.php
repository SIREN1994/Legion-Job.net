@extends('layout')

@section('content')




<br>
<section class="bg-blue-500 text-white py-16">
    
    <div class="container mx-auto text-center">
        <h1 class="text-4xl font-extrabold mb-4">Find Your Dream Job</h1>
        <p class="text-lg mb-8">Explore thousands of job opportunities and take the next step in your career.</p>
        <div class="flex justify-center">
            
            <form action="/query1" method="GET" class="flex space-x-2">
                @csrf
                <!-- Search Box for Position/Level -->
                <div>
                    <input type="text" name="position_level" placeholder="Position/Level" class="w-32 p-3 rounded-full text-black focus:outline-none focus:shadow-outline-blue">
                </div>   
                
                <!-- Radio Choice Drop-down for Classification -->
                <div class="relative">
                    <select class="appearance-none w-32 p-3 rounded-full text-black focus:outline-none focus:shadow-outline-blue" name="classification">
                        <option value="" >Any Classification</option>
                        <option value="Sale">Sales</option>
                        <option value="Marketing">Marketing</option>
                        <option value="Advertising">Advertising</option>
                        <option value="HR">HR</option>
                        <option value="Finance">Finance</option>
                        <option value="Logistic">Logistic</option>
                        <option value="IT">IT</option>
                        <option value="Audit">Audit</option>
                        <option value="Public Relation">Public Relation</option>
                        
                    </select>
                </div>

                <!-- Radio Choice Drop-down for Location -->
                <div class="relative">
                    <select class="appearance-none w-32 p-3 rounded-full text-black focus:outline-none focus:shadow-outline-blue" name="location">
                        <option value="" >Any City</option>
                        <option value="Japan">Japan</option>
                        <option value="Thailand">Thailand</option>
                        <option value="USA">USA</option>
                        <option value="Singapore">Singapore</option>
                    </select>
                </div>

                <!-- Seek Button (Rectangular) -->
                <button class="bg-black text-white p-3 rounded-lg font-bold hover:bg-yellow-600 hover:text-white focus:outline-none">
                    Seek
                </button>
            </form>
        </div>
    </div>
</section>






<div class="bg-white text-blue-500 font-bold font-sans text-3xl p-4 border-2 border-blue-500 mx-auto mt-8 flex items-center justify-center">
    <h1>Amazing Job Offers</h1>
</div>


<!-- Job Advertising Section -->
<div class="flex flex-wrap justify-center">
    <!--This $jpbs data came from app service provider-->
    @foreach ($jobs as $job)
    <div class="bg-white p-8 rounded shadow-md w-96 m-4">
        <img src="{{ asset($job->logo) }}" alt="{{ $job->title }} Logo" class="w-full h-32 object-cover mb-4">

        <h2 class="text-xl font-semibold mb-2">{{ $job->title }}</h2>
        <h2 class="text-xl font-semibold mb-2">Hiring Company : {{ $job->company }}</h2>
        <p class="text-gray-500 mb-2">{{ $job->tags }}</p>
        <h2 class="text-xl font-semibold mb-2">Location: {{ $job->location }}</h2>
        <!--Edit -->
        <form action="/detailjob" method="GET">
            @csrf
            <button type="submit" name="getID" value="{{$job->job_id}}" class="bg-blue-500 text-white p-2 rounded w-full hover:bg-blue-600 focus:outline-none">
                Apply Now
            </button> <br><br>       
        </form>
    </div>
    @endforeach

</div>
<!-- Display pagination links -->
{{ $jobs->links() }}

@endsection
