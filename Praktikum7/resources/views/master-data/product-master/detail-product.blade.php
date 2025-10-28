<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Product Detail') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        {{-- Back Button --}}
        <div class="mb-6">
            <a href="{{ route('product-index') }}" 
               class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                ← Back
            </a>
        </div>

        {{-- Product Detail Card --}}
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="mb-6 text-3xl font-bold text-gray-800">{{ $product->product_name }}</h3>

            <div class="space-y-4">
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">ID:</label>
                    <p class="text-lg text-gray-600">{{ $product->id }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Unit:</label>
                    <p class="text-lg text-gray-600">{{ $product->unit }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Type:</label>
                    <p class="text-lg text-gray-600">{{ $product->type }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Information:</label>
                    <p class="text-lg text-gray-600">{{ $product->information }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Quantity:</label>
                    <p class="text-lg text-gray-600">{{ $product->qty }} unit</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Producer:</label>
                    <p class="text-lg text-gray-600">{{ $product->producer }}</p>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="mt-6 flex gap-2">
                <a href="{{ route('product-index') }}" 
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Kembali ke Daftar Produk
                </a>
                <a href="{{ route('product-edit', $product->id) }}" 
                   class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Edit Produk
                </a>
            </div>
        </div>
    </div>
</x-app-layout>