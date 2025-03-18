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

    <div class="relative overflow-x-auto px-48 pt-20">
        <div class="py-8">

            <div class="max-w-sm mx-auto py-28">

                <a href={{ route('media.index') }}
                    class="text-white bg-cyan-600 rounded-2xl px-5 py-2.5 text-center">show
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

        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        mime
                    </th>
                    <th scope="col" class="px-6 py-3">
                        path
                    </th>
                    <th scope="col" class="px-6 py-3">
                        extension
                    </th>
                    <th scope="col" class="px-6 py-3">
                        action
                    </th>
                </tr>
            </thead>

            @foreach ($medias as $media)
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">


                        <td class="px-6 py-4">{{ $media->name }}</td>

                        <td class="px-6 py-4">
                            {{ $media->mimetype }}
                        </td>
                        <td class="px-6 py-4">
                            <img src={{ asset($media->path) }} />
                        </td>
                        <td class="px-6 py-4">
                            {{ $media->extension }}
                        </td>
                        <td class="px-6 py-4">
                            <form action="/media/{{ $media->id }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit"
                                    class="text-white bg-cyan-600 rounded-2xl px-5 py-2.5 text-center">Delete</button>
                            </form>
                        </td>
                    </tr>

                </tbody>
            @endforeach
        </table>
    </div>
</body>

</html>
