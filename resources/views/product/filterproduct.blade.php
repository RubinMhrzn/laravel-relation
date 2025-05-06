<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Filter</title>
    @vite('resources/css/app.css')
</head>

<body>
    <form action="{{ route('products.filter') }}" method='post'>
        @method('post')
        @csrf

        <div class="flex flex-col gap-5">
            <!-- Badge Selection -->

            <div class="flex py-4 px-14 bg-gray-200 justify-end w-full">
                <label for="badge" class="text-lg px-1">Sort By : </label>
                <select name="filters[sort]" id="badge" class="border-2 border-black px-2 py-1 rounded-lg">
                    <option value="name"
                        {{ old('filters.sort', request()->input('filters.sort')) == 'name' ? 'selected' : '' }}>By name
                    </option>
                    <option value="lowest"
                        {{ old('filters.sort', request()->input('filters.sort')) == 'lowest' ? 'selected' : '' }}>Low to
                        high</option>
                    <option value="highest"
                        {{ old('filters.sort', request()->input('filters.sort')) == 'highest' ? 'selected' : '' }}>High
                        to low</option>
                    <option value="recent"
                        {{ old('filters.sort', request()->input('filters.sort')) == 'recent' ? 'selected' : '' }}>
                        Recently Added</option>
                </select>
            </div>


            <div class="flex flex-row gap-5 ">

                <div class="flex flex-col gap-5 w-[25rem]">

                    <div class="flex flex-col bg-gray-200 p-4">
                        <div class="text-center font-bold">Categories</div>
                        <div class="px-8 py-3">
                            @foreach ($categories as $category)
                                <div class="flex items-center gap-3 pb-3">
                                    <input type="checkbox" name="filters[category][]" id="category_{{ $category->id }}"
                                        value="{{ $category->slug }}"
                                        {{ in_array($category->slug, old('filters.category', request()->input('filters.category', []))) ? 'checked' : '' }}>

                                    <label for="category_{{ $category->id }}"
                                        class="bg-blue-200 px-3 py-1 rounded-2xl text-center w-20 cursor-pointer">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @endforeach
                            <button type="submit" class="bg-pink-200 px-4 py-1 rounded-2xl text-center">apply</button>
                        </div>
                    </div>


                    <div class="flex flex-col bg-gray-200 p-4">
                        <div class="text-center font-bold">Tags</div>
                        <div class="flex flex-wrap gap-6 px-8 py-3">
                            <a class="bg-blue-200 px-3 py-1 rounded-2xl text-center" href="?tag=electronic">
                                Electronic
                            </a>
                            <a class="bg-blue-200 px-3 py-1 rounded-2xl text-center" href="?tag=education">
                                Education
                            </a>
                            <a class="bg-blue-200 px-3 py-1 rounded-2xl text-center" href="?tag=clothing">
                                Clothing
                            </a>
                        </div>
                    </div>
                </div>
                <div class="w-full flex flex-col gap-6 px-14">
                    <input type="text" name="filters[search]" id="" placeholder="Search Product"
                        class="w-60 border p-3 rounded-lg shadow-md ">

                    <div class="grid grid-cols-3 gap-5 ">
                        @foreach ($products as $product)
                            <div class="border p-4 rounded-lg shadow-md bg-white">
                                <h2 class="text-lg font-bold">{{ $product->name }}</h2>
                                <p class="text-gray-700">${{ $product->price }}</p>
                                <p class="text-sm text-gray-500">
                                    Categories:
                                    @foreach ($product->categories as $category)
                                        <span
                                            class="text-blue-500">{{ $category->name }}</span>{{ !$loop->last ? ', ' : '' }}
                                    @endforeach
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>
