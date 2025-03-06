@extends('layouts.app')
@section('content')
    <div class="mx-52 pt-5"><a href="category/create"
            class="bg-gray-600 text-gray-200 mx-2 my-4 px-3 py-2 hover:bg-slate-500 rounded-xl">Add
            category</a>
    </div>
    <div class="relative overflow-x-auto mx-[13rem] my-5">

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 text-center">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        category name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($categories as $category)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 text-center">
                        <td class="px-6 py-4">
                            {{ $category->name }}
                        </td>

                        <td class="flex flex-row gap-1 justify-center py-3">
                            <a href={{ Route('category.edit', $category->id) }}>edit</a>
                            <a href="">show</a>
                            <div>|</div>
                            <form class="" action="category/{category}" method="post">@csrf
                                @method('delete')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach




            </tbody>
        </table>
    </div>
@endsection
