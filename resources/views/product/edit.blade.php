@extends('welcome')
@section('content')
    <div class="mx-40 my-5">

        <form class="max-w-sm mx-auto" action={{ route('product.update', $product->id) }} method="post">
            @csrf
            @method('PATCH')
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                <input type="text" name="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900  block w-full p-2.5 dark:bg-gray-300 dark:border-gray-600 rounded-xl"
                    value="{{ $product->name }}" />
            </div>
            <div class="mb-5">
                <label for="color" class="block mb-2 text-sm font-medium text-gray-900">Color</label>
                <input type="text" name="color"
                    class="bg-gray-50 border border-gray-300 text-gray-900  block w-full p-2.5 dark:bg-gray-300 dark:border-gray-600 rounded-xl"
                    value="{{ $product->color }}" />
            </div>
            <div class="mb-5">
                <label for="category" class="block mb-2 text-sm font-medium text-gray-900">Category</label>
                <input type="text" name="category"
                    class="bg-gray-50 border border-gray-300 text-gray-900  block w-full p-2.5 dark:bg-gray-300 dark:border-gray-600 rounded-xl"
                    value="{{ $product->category }}" />
            </div>
            <div class="mb-5">
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Price</label>
                <input type="number" name="price"
                    class="bg-gray-50 border border-gray-300 text-gray-900  block w-full p-2.5 dark:bg-gray-300 dark:border-gray-600 rounded-xl"
                    value="{{ $product->price }}" />
            </div>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
    </div>
@endsection
