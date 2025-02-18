<div>

        <!-- Start block -->
        <div class="flex justify-between items-center py-4 px-4 mb-4 rounded-t border sm:mb-5 bg-gray-50 dark:bg-gray-900 antialiased relative shadow-md sm:rounded-lg overflow-hidden h-28">
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <label for="start-date" class="sr-only">Select start date</label>
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 2a2 2 0 00-2 2v2H3a2 2 0 00-2 2v8a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H6zm0 2h8v2H6V4z"></path>
                        </svg>
                    </div>
                    <input
                        type="date" id="start-date"
                        wire:model.live.rebounce.100ms="startDate"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Select start date"
                        
                    />
                </div>
                <span class="text-gray-500 dark:text-gray-400">to</span>
                <div class="relative">
                    <label for="end-date" class="sr-only">Select end date</label>
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 2a2 2 0 00-2 2v2H3a2 2 0 00-2 2v8a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H6zm0 2h8v2H6V4z"></path>
                        </svg>
                    </div>
                    <input
                        type="date" id="end-date"
                        wire:model.live.rebounce.100ms="endDate" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Select end date"
                        
                    />
                </div>       
            </div>       
            
            <button wire:click="export" class="py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-green-600 rounded-lg hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4 mr-2 -ml-0.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                </svg>
                Export to Excel
            </button>
        </div>


        {{-- Card --}}
        <div class="grid grid-cols-4 h-48 gap-4 mt-4 mb-4">

            <div class=" text-white rounded-lg flex justify-between items-center p-4 shadow-md"
                style="background-color: #0FADEC;">
                <div>
                    <h2 class="text-3xl font-bold">{{$transaksi->count()}}</h2>
                    <p class="text-sm">Total Transaksi</p>
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
                    <h2 class="text-3xl font-bold">@currency($transaksi->sum('total_bayar'))</h2>
                    <p class="text-sm">Total Uang Masuk</p>
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
                    <h2 class="text-3xl font-bold">{{$stok->sum('total_stokmasuk')}}</h2>
                    <p class="text-sm">Total Stok Masuk</p>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-32 h-32 text-red-300 opacity-50 mt-2 mx-auto">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                    </svg>
                </div>
            </div>

            <div class=" text-white rounded-lg flex justify-between items-center p-4 shadow-md"
                style="background-color: #E810CB;">
                <div>
                    <h2 class="text-3xl font-bold">{{$produk_terjual}}</h2>
                    <p class="text-sm">Total Produk Terjual</p>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 w-32 h-32 text-white opacity-50 mt-2 mx-auto" fill="currentColor" viewBox="0 -960 960 960" stroke-width="1.5" stroke="currentColor" >
                        <path
                            d="M440-91v-366L120-642v321q0 22 10.5 40t29.5 29L440-91Zm80 0 280-161q19-11 29.5-29t10.5-40v-321L520-457v366Zm159-550 118-69-277-159q-19-11-40-11t-40 11l-79 45 318 183ZM480-526l119-68-317-184-120 69 318 183Z" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Laporan produk --}}
        <section class="bg-gray-50 dark:bg-gray-900 antialiased">
            <div class="mx-auto max-w-screen-4xl">
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    
                    @livewire('tables.laporan-produk-table')
            
                </div>
            </div>
        </section>



        {{-- Laporan Kasir --}}
        <section class="bg-gray-50 dark:bg-gray-900 antialiased mt-4 mb-4">
            <div class="mx-auto max-w-screen-4xl">
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    
                    @livewire('tables.laporan-kasir-table')

                </div>
            </div>
        </section>

</div>