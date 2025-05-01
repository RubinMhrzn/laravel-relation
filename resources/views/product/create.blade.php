@extends('layouts.app')
@section('content')
    <div class="-mx-36 my-5">

        <form class="max-w-sm mx-auto" action={{ route('admin.product.store') }} method="post">
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
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                <input type="text" name="description"
                    class="bg-gray-50 border border-gray-300 text-gray-900  block w-full p-2.5 dark:bg-gray-300 dark:border-gray-600 rounded-xl"
                    placeholder="description" />
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-5">
                <label for="specification" class="block mb-2 text-sm font-medium text-gray-900">Specification</label>
                <input type="text" name="specification"
                    class="bg-gray-50 border border-gray-300 text-gray-900  block w-full p-2.5 dark:bg-gray-300 dark:border-gray-600 rounded-xl"
                    placeholder="specification" />
                @error('specification')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-5">
                <label for="features" class="block mb-2 text-sm font-medium text-gray-900">Features</label>
                <input type="text" name="features"
                    class="bg-gray-50 border border-gray-300 text-gray-900  block w-full p-2.5 dark:bg-gray-300 dark:border-gray-600 rounded-xl"
                    placeholder="features" />
                @error('features')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-5">
                <label for="brand" class="block mb-2 text-sm font-medium text-gray-900">Brand</label>
                <input type="text" name="brand"
                    class="bg-gray-50 border border-gray-300 text-gray-900  block w-full p-2.5 dark:bg-gray-300 dark:border-gray-600 rounded-xl"
                    placeholder="brand" />
                @error('brand')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-5">
                <label for="summary" class="block mb-2 text-sm font-medium text-gray-900">Summary</label>
                <input type="text" name="summary"
                    class="bg-gray-50 border border-gray-300 text-gray-900  block w-full p-2.5 dark:bg-gray-300 dark:border-gray-600 rounded-xl"
                    placeholder="summary" />
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
                <div class="variant-group mb-4 p-4 border rounded-lg">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="variants[0][color_id]" class="block text-sm font-medium text-gray-700">Color</label>
                            <select name="variants[0][color_id]"
                                class="bg-gray-50 border border-gray-300 text-gray-900  block w-full p-2.5 dark:bg-gray-300 dark:border-gray-600 rounded-xl">
                                <option value="">Select Color</option>
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="variants[0][size_id]" class="block text-sm font-medium text-gray-700">Size</label>
                            <select name="variants[0][size_id]"
                                class="bg-gray-50 border border-gray-300 text-gray-900  block w-full p-2.5 dark:bg-gray-300 dark:border-gray-600 rounded-xl">
                                <option value="">Select Size</option>
                                @foreach ($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="variants[0][is_parent]" class="block text-sm font-medium text-gray-700">Is
                                Parent</label>
                            <select name="variants[0][is_parent]"
                                class="bg-gray-50 border border-gray-300 text-gray-900  block w-full p-2.5 dark:bg-gray-300 dark:border-gray-600 rounded-xl">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 mt-4">
                        <div>
                            <label for="variants[0][price]" class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="number" step="0.01" name="variants[0][price]"
                                class="bg-gray-50 border border-gray-300 text-gray-900  block w-full p-2.5 dark:bg-gray-300 dark:border-gray-600 rounded-xl" />
                        </div>
                        <div>
                            <label for="variants[0][base_price]" class="block text-sm font-medium text-gray-700">Base
                                Price</label>
                            <input type="number" step="0.01" name="variants[0][base_price]"
                                class="bg-gray-50 border border-gray-300 text-gray-900  block w-full p-2.5 dark:bg-gray-300 dark:border-gray-600 rounded-xl" />
                        </div>
                        <div>
                            <label for="variants[0][stock]" class="block text-sm font-medium text-gray-700">Stock</label>
                            <input type="number" name="variants[0][stock]"
                                class="bg-gray-50 border border-gray-300 text-gray-900  block w-full p-2.5 dark:bg-gray-300 dark:border-gray-600 rounded-xl" />
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" id="add-variant"
                class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded mb-4">Add Another Variant</button>

            <script>
                let variantIndex = 1;
                document.getElementById('add-variant').addEventListener('click', function() {
                    const wrapper = document.getElementById('variant-wrapper');
                    const newGroup = document.querySelector('.variant-group').cloneNode(true);

                    // Update the names
                    newGroup.querySelectorAll('select, input').forEach(input => {
                        const name = input.getAttribute('name');
                        if (name) {
                            input.setAttribute('name', name.replace(/\[\d+\]/, `[${variantIndex}]`));
                            input.value = ''; // Clear value
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
