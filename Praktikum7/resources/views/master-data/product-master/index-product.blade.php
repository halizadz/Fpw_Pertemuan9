<x-app-layout>
    <x-slot name="header">
         <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product') }}
        </h2>
    </x-slot>

    <div class="container p-4 mx-auto">
        {{-- Alert Notifikasi Success --}}
        @if(session('success'))
            <div id="alert-success" class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg flex justify-between items-center shadow-md">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-semibold">{{ session('success') }}</span>
                </div>
                <button onclick="document.getElementById('alert-success').style.display='none'" class="text-green-700 hover:text-green-900 font-bold text-xl">×</button>
            </div>
        @endif

        {{-- Alert Notifikasi Error --}}
        @if(session('error'))
            <div id="alert-error" class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-lg flex justify-between items-center shadow-md">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-semibold">{{ session('error') }}</span>
                </div>
                <button onclick="document.getElementById('alert-error').style.display='none'" class="text-red-700 hover:text-red-900 font-bold text-xl">×</button>
            </div>
        @endif

        <div class="overflow-x-auto">
            {{-- Tombol Add Product --}}
            <a href="{{ route('product-create')}}">
                <button class="px-6 py-4 text-white bg-green-500 border-green-500 rounded-lg shadow-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200">
                    + Add Product Data
                </button>
            </a>

            {{-- Form Search --}}
            <form method="GET" action="{{ route('product-index') }}" class="mb-4 flex items-center mt-4">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Cari produk..." 
                       class="w-1/4 rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                
                {{-- Hidden inputs untuk mempertahankan sort parameters --}}
                <input type="hidden" name="sort" value="{{ request('sort') }}">
                <input type="hidden" name="direction" value="{{ request('direction') }}">
                
                <button type="submit" 
                        class="ml-2 rounded-lg bg-green-500 px-4 py-2 text-white shadow-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200">
                    🔍 Cari
                </button>
                
                {{-- Tombol Reset --}}
                @if(request('search'))
                <a href="{{ route('product-index') }}" 
                   class="ml-2 rounded-lg bg-gray-500 px-4 py-2 text-white shadow-lg hover:bg-gray-600 transition duration-200">
                    Reset
                </a>
                @endif
            </form>

            {{-- Table Product dengan Sorting --}}
            <table class="min-w-full border border-collapse border-gray-200 bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gradient-to-r from-green-500 to-green-600 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left">No</th>
                        
                        {{-- Product Name - Sortable --}}
                        <th class="px-4 py-3 text-left">
                            <a href="{{ route('product-index', [
                                'sort' => 'product_name', 
                                'direction' => request('sort') === 'product_name' && request('direction') === 'asc' ? 'desc' : 'asc',
                                'search' => request('search')
                            ]) }}" 
                               class="flex items-center hover:text-green-200 transition duration-200">
                                Product Name
                                @if(request('sort') === 'product_name')
                                    <span class="ml-2 font-bold">{{ request('direction') === 'asc' ? '↑' : '↓' }}</span>
                                @else
                                    <span class="ml-2 text-green-200 opacity-50">⇅</span>
                                @endif
                            </a>
                        </th>
                        
                        {{-- Unit - Sortable --}}
                        <th class="px-4 py-3 text-left">
                            <a href="{{ route('product-index', [
                                'sort' => 'unit', 
                                'direction' => request('sort') === 'unit' && request('direction') === 'asc' ? 'desc' : 'asc',
                                'search' => request('search')
                            ]) }}" 
                               class="flex items-center hover:text-green-200 transition duration-200">
                                Unit
                                @if(request('sort') === 'unit')
                                    <span class="ml-2 font-bold">{{ request('direction') === 'asc' ? '↑' : '↓' }}</span>
                                @else
                                    <span class="ml-2 text-green-200 opacity-50">⇅</span>
                                @endif
                            </a>
                        </th>
                        
                        {{-- Type - Sortable --}}
                        <th class="px-4 py-3 text-left">
                            <a href="{{ route('product-index', [
                                'sort' => 'type', 
                                'direction' => request('sort') === 'type' && request('direction') === 'asc' ? 'desc' : 'asc',
                                'search' => request('search')
                            ]) }}" 
                               class="flex items-center hover:text-green-200 transition duration-200">
                                Type
                                @if(request('sort') === 'type')
                                    <span class="ml-2 font-bold">{{ request('direction') === 'asc' ? '↑' : '↓' }}</span>
                                @else
                                    <span class="ml-2 text-green-200 opacity-50">⇅</span>
                                @endif
                            </a>
                        </th>
                        
                        {{-- Information - Sortable --}}
                        <th class="px-4 py-3 text-left">
                            <a href="{{ route('product-index', [
                                'sort' => 'information', 
                                'direction' => request('sort') === 'information' && request('direction') === 'asc' ? 'desc' : 'asc',
                                'search' => request('search')
                            ]) }}" 
                               class="flex items-center hover:text-green-200 transition duration-200">
                                Information
                                @if(request('sort') === 'information')
                                    <span class="ml-2 font-bold">{{ request('direction') === 'asc' ? '↑' : '↓' }}</span>
                                @else
                                    <span class="ml-2 text-green-200 opacity-50">⇅</span>
                                @endif
                            </a>
                        </th>
                        
                        {{-- Qty - Sortable --}}
                        <th class="px-4 py-3 text-left">
                            <a href="{{ route('product-index', [
                                'sort' => 'qty', 
                                'direction' => request('sort') === 'qty' && request('direction') === 'asc' ? 'desc' : 'asc',
                                'search' => request('search')
                            ]) }}" 
                               class="flex items-center hover:text-green-200 transition duration-200">
                                Qty
                                @if(request('sort') === 'qty')
                                    <span class="ml-2 font-bold">{{ request('direction') === 'asc' ? '↑' : '↓' }}</span>
                                @else
                                    <span class="ml-2 text-green-200 opacity-50">⇅</span>
                                @endif
                            </a>
                        </th>
                        
                        {{-- Producer - Sortable --}}
                        <th class="px-4 py-3 text-left">
                            <a href="{{ route('product-index', [
                                'sort' => 'producer', 
                                'direction' => request('sort') === 'producer' && request('direction') === 'asc' ? 'desc' : 'asc',
                                'search' => request('search')
                            ]) }}" 
                               class="flex items-center hover:text-green-200 transition duration-200">
                                Producer
                                @if(request('sort') === 'producer')
                                    <span class="ml-2 font-bold">{{ request('direction') === 'asc' ? '↑' : '↓' }}</span>
                                @else
                                    <span class="ml-2 text-green-200 opacity-50">⇅</span>
                                @endif
                            </a>
                        </th>
                        
                        <th class="px-4 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $index => $product)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-4 py-3 border border-gray-200">{{ $products->firstItem() + $index }}</td>
                        <td class="px-4 py-3 border border-gray-200 hover:text-blue-500 hover:underline">
                            <a href="{{ route('product-detail', $product->id) }}">
                                {{ $product->product_name }}
                            </a>
                        </td>
                        <td class="px-4 py-3 border border-gray-200">
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                                {{ $product->unit }}
                            </span>
                        </td>
                        <td class="px-4 py-3 border border-gray-200">{{ $product->type }}</td>
                        <td class="px-4 py-3 border border-gray-200">{{ Str::limit($product->information, 50) }}</td>
                        <td class="px-4 py-3 border border-gray-200 font-semibold">{{ $product->qty }}</td>
                        <td class="px-4 py-3 border border-gray-200">{{ $product->producer }}</td>
                        <td class="px-4 py-3 border border-gray-200">
                            <div class="flex gap-2">
                                <a href="{{ route('product-edit', $product->id) }}"
                                    class="px-3 py-1 text-white bg-blue-500 rounded hover:bg-blue-600 transition duration-200">
                                    Edit
                                </a>
                                <button class="px-3 py-1 text-white bg-red-500 rounded hover:bg-red-600 transition duration-200" 
                                        onclick="confirmDelete({{ $product->id }}, '{{ route('product-delete', $product->id) }}')">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-4 py-8 border text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <svg class="w-16 h-16 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                </svg>
                                <p class="font-semibold">Tidak ada produk yang ditemukan.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination dengan sort parameters --}}
            <div class="mt-4">
                {{ $products->appends([
                    'search' => request('search'),
                    'sort' => request('sort'),
                    'direction' => request('direction')
                ])->links() }}
            </div>
        </div>
    </div>

    <script>
        // Auto hide alert after 5 seconds
        setTimeout(function() {
            const successAlert = document.getElementById('alert-success');
            const errorAlert = document.getElementById('alert-error');
            if(successAlert) {
                successAlert.style.opacity = '0';
                successAlert.style.transition = 'opacity 0.5s';
                setTimeout(() => successAlert.style.display = 'none', 500);
            }
            if(errorAlert) {
                errorAlert.style.opacity = '0';
                errorAlert.style.transition = 'opacity 0.5s';
                setTimeout(() => errorAlert.style.display = 'none', 500);
            }
        }, 5000);

        function confirmDelete(id, deleteUrl) {
            if (confirm('⚠️ Apakah Anda yakin ingin menghapus data ini?\n\nData yang dihapus tidak dapat dikembalikan!')) {
                let form = document.createElement('form');
                form.method = 'POST'; 
                form.action = deleteUrl;

                let csrfInput = document.createElement('input'); 
                csrfInput.type = 'hidden'; 
                csrfInput.name = '_token'; 
                csrfInput.value = '{{ csrf_token() }}'; 
                form.appendChild(csrfInput);
                
                let methodInput = document.createElement('input'); 
                methodInput.type = 'hidden'; 
                methodInput.name = '_method'; 
                methodInput.value = 'DELETE'; 
                form.appendChild(methodInput);

                document.body.appendChild(form); 
                form.submit();
            }
        }
    </script>
</x-app-layout>