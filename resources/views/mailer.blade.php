<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Successful</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-purple-500 to-blue-500 p-4">
    <div class="container mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-4xl font-bold text-center mb-8 text-yellow-500">
            🎉 Congratulations, <span class="text-purple-600">{{$user}}</span>! 🎉
        </h1>
        <h2 class="text-2xl font-semibold text-center text-blue-600 mb-4">Your Application is a Success!</h2>
        <p class="text-lg text-center text-gray-700 font-bold mb-8">We are thrilled to inform you that your application for the <span class="font-bold text-purple-600">{{$job_title}}</span> at <span class="font-bold text-purple-600">{{$job_company}} Company</span> has been successful!</p>
        <div class="thank-you flex flex-col items-center justify-center mt-8">
            <img src="https://www.luvzilla.com/wp-content/uploads/2021/05/Thank-You-Messages-For-Attending-Meeting.jpg" alt="Thank You" class="w-64 mb-4">
            <h2 class="text-2xl font-semibold text-center text-green-500 mb-4">Thank You for Choosing Legion Jobs.net</h2>
            <p class="text-lg text-center text-gray-800 font-bold mb-4">We received your resume and will contact you shortly for the initial interview.</p>
            <p class="text-lg text-center text-gray-800 font-bold mb-4">Have a fantastic day ahead!</p>
        </div>
    </div>
    <div class="text-center text-gray-600 font-bold mt-8">
        <p>Contact Us: contact@Legion_Jobs.com | Phone: +123 456 7890</p>
        <p>Website: www.legion_jobs.com</p>
    </div>
</body>
</html>
