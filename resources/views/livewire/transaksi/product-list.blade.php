<div>
    <div class="grid gap-1 mb-4 sm:grid-cols-3">
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative sm:col-span-2">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="search" wire:model.live.rebounce.100ms="search" id="default-search"
                class="block w-full p-3 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Search Products..." autocomplete="off" />
        </div>

        <select id="countries" wire:model.change="kategori"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="0" selected>All Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
            @endforeach
        </select>
    </div>

    <div class="grid grid-cols-1 gap-3 md:grid-cols-5 mb-5">
        <div wire:loading.flex class="col-12 absolute justify-center items-center"
            style="top:0;right:0;left:0;bottom:0;background-color: rgba(255,255,255,0.5);z-index: 99;">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        @forelse ($products as $product)
            <div wire:click.prevent="pilihProduk({{ $product }})"
                class="relative max-w-64 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 cursor-pointer">
                @if ($product->stok == 0)
                    <div
                        class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full top-2 end-2 dark:border-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#ffffff">
                            <path d="M440-400v-360h80v360h-80Zm0 200v-80h80v80h-80Z" />
                        </svg></div>
                @endif
                <div>
                    <img class="rounded-t-lg aspect-square object-cover" src="{{ asset('storage/' . $product->foto) }}"
                        alt="{{ $product->nama_produk }}" />
                </div>
                <div class="p-3">
                    <div>
                        <h5 class="mb-1 font-semibold tracking-tight text-gray-900 dark:text-white capitalize">
                            {{ $product->nama_produk }}</h5>
                    </div>
                    <p class="mb-1 text-xs bg-green-100 text-green-600 p-1 rounded w-fit">{{ $product->barcode }}</p>
                    <div class="text-sm">
                        @currency($product->harga)
                    </div>
                </div>
            </div>
        @empty
            <div class="sm:col-span-5 text-center mt-10">
                Belum ada produk
            </div>
        @endforelse

    </div>

    {{ $products->links() }}

</div>
