@extends('layouts.app')
@section('content')
    <div class="mx-40 my-5">

        <form class="max-w-sm mx-auto" action={{ route('product.store') }} method="post">
            @csrf
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                <input type="text" name="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900  block w-full p-2.5 dark:bg-gray-300 dark:border-gray-600 rounded-xl"
                    placeholder="product name" />
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-5">
                <label for="color" class="block mb-2 text-sm font-medium text-gray-900">Color</label>
                <input type="text" name="color"
                    class="bg-gray-50 border border-gray-300 text-gray-900  block w-full p-2.5 dark:bg-gray-300 dark:border-gray-600 rounded-xl"
                    placeholder="color" />
                @error('color')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-5">
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Price</label>
                <input type="number" name="price"
                    class="bg-gray-50 border border-gray-300 text-gray-900  block w-full p-2.5 dark:bg-gray-300 dark:border-gray-600 rounded-xl"
                    placeholder="price" />
                @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <label for="category_ids" class="block mb-2 text-sm font-medium text-gray-900">category_id</label>
            <select id="categories" name="category_ids[]" multiple
                class="bg-gray-50 border border-gray-300 text-gray-900 block w-full p-2.5 dark:bg-gray-300 dark:border-gray-600 rounded-xl">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ in_array($category->id, old('category_ids', $selectedCategories ?? [])) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 mt-8 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
    </div>
@endsection
