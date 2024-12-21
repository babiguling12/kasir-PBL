<div>
    {{-- Laporan Produk --}}
    <div class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t dark:border-gray-700">
        <div class="w-full md:w-1/2">
            <form class="flex items-center">
                <label for="search-produk" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                            viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" />
                        </svg>
                    </div>
                    <input wire:model.live.rebounce.100ms="search" type="text" id="search-produk"
                        name="search-produk" placeholder="Search for Produk"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-80 pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                </div>
            </form>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input id="checkbox-all" type="checkbox" class="w-4 h-4 text-primary-600 bg-gray-100 rounded border-gray-300 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-all" class="sr-only">checkbox</label>
                        </div>
                    </th>
                    <th scope="col" class="p-4">Produk</th>
                    <th scope="col" class="p-4">Barcode</th>
                    <th scope="col" class="p-4">Satuan</th>
                    <th scope="col" class="p-4">Kategori</th>
                    <th scope="col" class="p-4">Stok Masuk</th>
                    <th scope="col" class="p-4">Stok Keluar</th>
                    <th scope="col" class="p-4">Terjual</th>
                    <th scope="col" class="p-4">Revenue</th>
                    <th scope="col" class="p-4"></th>
                </tr>
            </thead>
            @forelse ($products as $produk)
                <tbody>
                    <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <td class="p-4 w-4">
                            <div class="flex items-center">
                                <input id="checkbox-table-search-1" type="checkbox" onclick="event.stopPropagation()" class="w-4 h-4 text-primary-600 bg-gray-100 rounded border-gray-300 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="flex items-center mr-3">
                                <img src="{{ $produk->foto }}" alt="{{ $produk->nama_produk }}" class="h-8 w-auto mr-3">
                                {{ $produk->nama_produk }}
                            </div>
                        </th>
                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $produk->barcode }}</td>
                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $produk->satuan->nama_satuan }}</td>
                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $produk->kategori->nama_kategori }}</td>
                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $stokmasuk->where('barcode_id',$produk->id)->sum('total_stokmasuk')}}
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $stokkeluar->where('barcode_id',$produk->id)->sum('jumlah')}}
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $produk_terjual->where('barcode_id', $produk->id)->sum('qty')}}</td>
                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            @php
                                $terjual=$produk_terjual->where('barcode_id', $produk->id)->sum('qty');
                            @endphp
                            Rp {{ number_format($produk->harga * $terjual, 0, ',', '.') }}</td>
                        <td class="px-4 py-3"></td>
                        <td class="px-4 py-3 font-medium place-items-end text-gray-900 whitespace-nowrap dark:text-white">
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-4 pt-5 font-medium text-center text-xl text-gray-400 whitespace-nowrap dark:text-white"
                            colspan="9" rowspan="10">
                            Data Produk Belum Ada
                        </td>
                    </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="p-5">
        {{ $products ->links() }}
    </div>

    
    
</div>






