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
    <div class="max-w-sm mx-auto py-28">

        <a href={{ route('media.index') }} class="text-white bg-cyan-600 rounded-2xl px-5 py-2.5 text-center">show
            data</a>
        <form action="/media" class="max-w-sm mx-auto py-10" enctype="multipart/form-data" method="post">
            @csrf
            @method('post')

            <div class="mb-5">
                <label for="path" class="block mb-2 text-lg font-medium text-gray-900 ">file</label>
                <input type="file" id="path" name="file"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>
            <button type="submit"
                class="text-black bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
    </div>




</body>

</html>
