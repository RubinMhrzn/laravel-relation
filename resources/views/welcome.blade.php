<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="flex justify-center py-5 bg-gray-200 gap-5">
        <a class="text-lg text-blue-400" href="/category">category</a>
        <a class="text-lg text-blue-400" href="/product">products</a>
    </div>
    @yield('content')

</body>

</html>
