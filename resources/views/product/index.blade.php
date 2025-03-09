@extends('layouts.app')
@section('content')
    <div class="mx-48 pt-5"><a href={{ route('product.create') }}
            class="bg-gray-600 text-gray-200 mx-2 my-4 px-3 py-2 hover:bg-slate-500 rounded-xl">Add
            product</a>
    </div>
    <div class="relative overflow-x-auto mx-40 my-5">

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Product name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Color
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($products as $product)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <td class="px-6 py-4">
                            {{ $product->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $product->color }}
                        </td>
                        <td class="px-6 py-4">

                            <p>{{ $product->categories->pluck('name')->implode(', ') }}</p>
                        </td>
                        <td class="px-6 py-4">
                            {{ $product->price }}
                        </td>
                        <td class="flex flex-row gap-1 justify-start py-3">
                            <a href={{ route('product.edit', $product->slug) }}>edit</a>
                            <a href="/product/{{ $product->slug }}">show</a>
                            <div>|</div>
                            <form class="" action="/product/{{ $product->slug }}" method="post">@csrf
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
