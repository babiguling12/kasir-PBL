<div>
    
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <div class=" ">
            {{-- Card --}}
            <div class="grid grid-cols-1 md:grid-cols-3 h-48 gap-4 mt-4 mb-4">

                <div class=" text-white rounded-lg flex justify-between items-center p-4 shadow-md"
                    style="background-color: #0FADEC;">
                    <div>
                        <h2 class="text-3xl font-bold">{{$transaksi->count()}}</h2>
                        <p class="text-sm">Transaksi Hari Ini</p>
                    </div>
                    <div>
                        <svg class="w-32 h-32 text-blue-300 opacity-50 mt-2 mx-auto" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                        </svg>
                    </div>
                </div>

                <div class=" text-white rounded-lg flex justify-between items-center p-4 shadow-md"
                    style="background-color: #E4BF27;">
                    <div>
                        <h2 class="text-3xl font-bold">Rp {{ number_format($transaksi->sum('total_bayar'), 0, ',', '.') }}</h2>
                        <p class="text-sm">Uang Masuk Hari Ini</p>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-32 h-32 text-yellow-300 mt-2 mx-auto">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                        </svg>
                    </div>
                </div>

                <div class=" text-white rounded-lg flex justify-between items-center p-4 shadow-md"
                    style="background-color: #E81810;">
                    <div>
                        <h2 class="text-3xl font-bold">{{ $stokMasuk->sum('total_stokmasuk') }}</h2>
                        <p class="text-sm">Stok Masuk Hari Ini</p>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-32 h-32 text-red-300 opacity-50 mt-2 mx-auto">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                        </svg>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Diagram --}}
            
            <script>
              window.MonthSales = @json([
                'thisYear' => $thisYearSales,
                'lastYear' => $lastYearSales
                ]);
            </script>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4 mb-4">
                <!-- Diagram Lingkaran: Penjualan Barang -->
                <div class="bg-white md:col-span-1 p-4 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-4">Barang Terlaris</h2>
                    <div class="flex items-center lg:order-2">
                        <button type="button"
                            class="flex text-smtext-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                            id="filter" aria-expanded="false" data-dropdown-toggle="dropdown-filter">
                            <span class="flex-1 ml-3 text-left whitespace-nowrap">{{$filter}}</span>
                            <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div class="hidden my-4 w-56 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 rounded-xl"
                            style="z-index: 9" id="dropdown-filter">
                            <ul class="py-1 text-gray-700 dark:text-gray-300" aria-labelledby="dropdown-filter">
                                <li>
                                    <a class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                    wire:click="filterMonth">Bulan Ini</a>
                                </li>
                                <li>
                                    <a class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                    wire:click="filterYear">Tahun Ini</a>
                                </li>
                                <li>
                                    <a class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                    wire:click="filterAll">All Time</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="w-full h-full">
                        <canvas id="BarangLarisChart"></canvas>
                       
                    </div>
                </div>

                <!-- Diagram Garis: Total Penjualan per Bulan -->
                <div class="bg-white md:col-span-2 p-4 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-4">Total Revenue per Bulan</h2>
                    <div class="w-full h-full">
                        <canvas id="penjualanBulanChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>


