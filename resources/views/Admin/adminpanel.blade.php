<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel</title>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Alpine.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
</head>

<body class="font-sans bg-gray-100">

    <!-- Header -->
    <header class="bg-blue-500 shadow-md p-2">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <!-- Logo and Site Name -->
                <div class="flex items-center">
                    <img src="/Golden Legion.png" alt="Logo" class="h-25 w-20">
                    <span class="text-md font-semibold ml-2">Admin Site</span>
                </div>
            </div>

            <!-- Logged-in User Profile -->
            <div class="flex items-center space-x-2 ml-auto">
                <div>
                    <p class="font-semibold text-white">John Doe</p>
                    <p class="text-gray-200 text-sm">Admin</p>
                    <form action="/adminlogout" method="POST">
                        @csrf
                        <button>Log Out</button>
                    </form>
                    
                </div>
                <img src="868815_a73a818.jpg" alt="User Avatar" class="h-8 w-8 rounded-full">
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <div class="flex">
        <!-- Sidebar -->
            
    
        <aside class="bg-gray-800 text-white w-64 min-h-screen">
            <div class="p-4 text-2xl font-semibold">Admin Panel</div>
            <nav class="text-white">
                <ul class="p-2">
                    <li class="mb-2"><a href="/applicants" class="block px-4 py-2 hover:bg-gray-700">Job Applications Page</a></li>
                    <li class="mb-2"><a href="/addjobs" class="block px-4 py-2 hover:bg-gray-700">Add New Jobs</a></li>
                    <li class="mb-2" x-data="{ isOpen: false }">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-700" @click="isOpen = !isOpen">Edit The Job Offers</a>
                        <ul x-show="isOpen" @click.away="isOpen = false" class="pl-4">
                            <li><a href="/editjobs" class="block px-4 py-2 hover:bg-gray-700">All Jobs ({{$all}})</a></li>
                            <li><a href="/show/Sale" class="block px-4 py-2 hover:bg-gray-700">Sales({{$sale}})</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">Marketing (0)</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">Advertising (0)</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">HR (0)</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">Finance (0)</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">Logistic (0)</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">IT (0)</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">Audit (0)</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">Public Relation (0)</a></li>
                            <li><a href="/show/pussy" class="block px-4 py-2 hover:bg-gray-700">Creative & Art</a></li>
                            <!-- Search box -->
                            <!-- Search box -->
                            <li class="flex flex-col items-center space-y-2">
                                <form action="/search" method="GET" class="flex flex-col items-center space-y-2">
                                    @csrf
                                    <div class="flex items-center space-x-2">
                                        <input type="text" name="query" placeholder="Search..." class="border rounded p-2 focus:outline-none flex-grow text-black">
                                    </div>
                                    <div>
                                        <button type="submit" class="bg-blue-500 text-white px-4 rounded hover:bg-blue-600 focus:outline-none">Search</button>
                                    </div>
                                </form>
                            </li>
                      
                        </ul>
                    </li >
                    <li class="mb-2"><a href="/deletejobs" class="block px-4 py-2 hover:bg-gray-700">Delete Jobs</a></li>
                    <!-- Add more navigation items as needed -->  
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-4">

            <!-- Add your main content here -->
            @yield('content')
    
        </main>
    </div>

</body>

</html>
