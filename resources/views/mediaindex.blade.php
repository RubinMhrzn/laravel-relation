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

            <a href={{ route('media') }} class="text-white bg-cyan-600 rounded-2xl px-5 py-2.5    text-center">add
                data</a>
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
                            {{ $media->path }}
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
