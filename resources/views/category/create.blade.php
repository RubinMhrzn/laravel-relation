@extends('layouts.app')
@section('content')
    <div class=" mx-[20rem] my-5 bg-gray-500 flex justify-center py-10">
        <form action="/category" method="post">
            @csrf
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Category Name</label>
                <input type="text" name="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900  block w-48 p-2.5 dark:bg-gray-300 dark:border-gray-600 rounded-xl"
                    placeholder="category name" />
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- <label for="product_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">product_id</label>
            <select id="countries" name="product_id"
                class="bg-gray-50 border border-gray-300 text-gray-900  block w-48 p-2.5 dark:bg-gray-300 dark:border-gray-600 rounded-xl">
                <option value="" disabled selected>Select a product</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select> --}}
            <button type="submit" class="bg-blue-500 rounded-xl mt-4 px-2 py-1">submit</button>

        </form>
    </div>
@endsection
