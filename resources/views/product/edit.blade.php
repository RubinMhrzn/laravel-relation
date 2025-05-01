@extends('layouts.app')
@section('content')
    <div class="-mx-36 my-5">

        <form class="max-w-sm mx-auto" action={{ route('admin.product.update', $product->slug) }} method="post">
            @csrf
            @method('put')
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                <input type="text" name="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900  block w-full p-2.5 dark:bg-gray-300 dark:border-gray-600 rounded-xl"
                    value="{{ old('name', $product->name) }}" />
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-5">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                <input type="text" name="description"
                    class="bg-gray-50 border border-gray-300 text-gray-900  block w-full p-2.5 dark:bg-gray-300 dark:border-gray-600 rounded-xl"
                    value="{{ old('description', $product->description) }}" />
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-5">
                <label for="specification" class="block mb-2 text-sm font-medium text-gray-900">Specification</label>
                <input type="text" name="specification"
                    class="bg-gray-50 border border-gray-300 text-gray-900  block w-full p-2.5 dark:bg-gray-300 dark:border-gray-600 rounded-xl"
                    value="{{ old('specification', $product->specification) }}" />
                @error('specification')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-5">
                <label for="features" class="block mb-2 text-sm font-medium text-gray-900">Features</label>
                <input type="text" name="features"
                    class="bg-gray-50 border border-gray-300 text-gray-900  block w-full p-2.5 dark:bg-gray-300 dark:border-gray-600 rounded-xl"
                    value="{{ old('features', $product->features) }}" />
                @error('features')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-5">
                <label for="brand" class="block mb-2 text-sm font-medium text-gray-900">Brand</label>
                <input type="text" name="brand"
                    class="bg-gray-50 border border-gray-300 text-gray-900  block w-full p-2.5 dark:bg-gray-300 dark:border-gray-600 rounded-xl"
                    value="{{ old('brand', $product->brand) }}" />
                @error('brand')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-5">
                <label for="summary" class="block mb-2 text-sm font-medium text-gray-900">Summary</label>
                <input type="text" name="summary"
                    class="bg-gray-50 border border-gray-300 text-gray-900  block w-full p-2.5 dark:bg-gray-300 dark:border-gray-600 rounded-xl"
                    value="{{ old('summary', $product->summary) }}" />
                @error('summary')
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

            <h3 class="text-lg font-semibold my-4">Product Variants</h3>
            <div id="variant-wrapper">
                @foreach ($product->variants as $index => $variant)
                    <div class="variant-group mb-4 p-4 border rounded-lg">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="variants[{{ $index }}][color_id]"
                                    class="block text-sm font-medium text-gray-700">Color</label>
                                <select name="variants[{{ $index }}][color_id]"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 block w-full p-2.5 rounded-xl">
                                    <option value="">Select Color</option>
                                    @foreach ($colors as $color)
                                        <option value="{{ $color->id }}"
                                            {{ $variant->color_id == $color->id ? 'selected' : '' }}>
                                            {{ $color->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="variants[{{ $index }}][size_id]"
                                    class="block text-sm font-medium text-gray-700">Size</label>
                                <select name="variants[{{ $index }}][size_id]"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 block w-full p-2.5 rounded-xl">
                                    <option value="">Select Size</option>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->id }}"
                                            {{ $variant->size_id == $size->id ? 'selected' : '' }}>
                                            {{ $size->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="variants[{{ $index }}][is_parent]"
                                    class="block text-sm font-medium text-gray-700">Is Parent</label>
                                <select name="variants[{{ $index }}][is_parent]"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 block w-full p-2.5 rounded-xl">
                                    <option value="0" {{ !$variant->is_parent ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ $variant->is_parent ? 'selected' : '' }}>Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-4 mt-4">
                            <div>
                                <label for="variants[{{ $index }}][price]"
                                    class="block text-sm font-medium text-gray-700">Price</label>
                                <input type="number" step="0.01" name="variants[{{ $index }}][price]"
                                    value="{{ $variant->price }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 block w-full p-2.5 rounded-xl" />
                            </div>
                            <div>
                                <label for="variants[{{ $index }}][base_price]"
                                    class="block text-sm font-medium text-gray-700">Base Price</label>
                                <input type="number" step="0.01" name="variants[{{ $index }}][base_price]"
                                    value="{{ $variant->base_price }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 block w-full p-2.5 rounded-xl" />
                            </div>
                            <div>
                                <label for="variants[{{ $index }}][stock]"
                                    class="block text-sm font-medium text-gray-700">Stock</label>
                                <input type="number" name="variants[{{ $index }}][stock]"
                                    value="{{ $variant->stock }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 block w-full p-2.5 rounded-xl" />
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="button" id="add-variant"
                class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded mb-4">Add Another Variant</button>

            <script>
                let variantIndex = {{ count($product->variants) }};
                document.getElementById('add-variant').addEventListener('click', function() {
                    const wrapper = document.getElementById('variant-wrapper');
                    const newGroup = document.querySelector('.variant-group').cloneNode(true);

                    newGroup.querySelectorAll('select, input').forEach(input => {
                        const name = input.getAttribute('name');
                        if (name) {
                            input.setAttribute('name', name.replace(/\[\d+\]/, `[${variantIndex}]`));
                            input.value = '';
                        }
                    });

                    wrapper.appendChild(newGroup);
                    variantIndex++;
                });
            </script>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 mt-8 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
    </div>
@endsection
