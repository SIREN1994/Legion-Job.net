<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="/Legion Icon.png" type="image/x-icon">
    <title>Signup & Login</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">

    <div class="bg-white p-8 rounded shadow-md w-96" >
        @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
               <strong class="font-bold">Error!</strong>
               <span class="block sm:inline">{{ session('error') }}</span>
        </div>
        @endif
        <h2 class="text-2xl font-semibold mb-4">Ask For New Password</h2>
        <form action="/newpassword" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-600 text-sm font-semibold mb-2">Email</label>
                <input type="text" id="email" name="email" class="w-full border p-2 rounded focus:outline-none focus:border-blue-500">
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Request</button>
            <p class="mt-3 text-center"> A New Password Will Be Generated </p>
        </form>
    </div>




</body>
</html>