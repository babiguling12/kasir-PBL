<x-app-layout>
    <x-slot:title>Histori</x-slot:title>
    
<!-- Start block -->
<div class="relative p-4 w-full h-screen max-w-none">
    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5"> 
        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
            <h3 class="titleModal text-lg font-semibold text-gray-900 dark:text-white">Detail Transaksi</h3>
            <button type="button" aria-controls="drawer-update-product" class="tampilModalEdit py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4 mr-2 -ml-0.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                </svg>
                Print
            </button>
        </div>

    
        <div class=mb-4>
            <ul class="max-w-md space-y-4 text-gray-500 dark:text-gray-400">
                <li>
                    No Pesanan:
                </li>
                <li>
                    Tanggal Transaksi:
                </li>
                <li>
                    Metode Pembayaran:
                </li>
                <li>
                    Nama Kasir:
                </li>
            </ul>
        </div>


        <div>
            <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="p-4 ">Produk</th>
                        <th scope="col" class="p-4"></th>
                        <th scope="col" class="p-4"></th>
                        <th scope="col" class="p-4"></th>
                        <th scope="col" class="p-4 ">Price</th>
                        <th scope="col" class="p-4 ">Qty</th>
                        <th scope="col" class="p-4 ">Sub Total</th>
                    </tr>
                </thead>
                @forelse ($histori_detail as $dtl)
                @php
                $product = \App\Models\Produk::where('id', $dtl->barcode_id)->latest()->first();
                @endphp
                <tbody>
                    <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                       
                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $product ? $product->nama_produk : 'Product Not Found' }}
                        </td>
                       
                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"></td>
                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"> </td>
                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"> </td>
                        
                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                           Rp {{ $product ? number_format($product->harga, 0, ',', '.' ) : 'Product Not Found' }}
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$dtl->qty}}</td>
                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">Rp {{number_format($dtl->total_harga_barang, 0, ',', '.' )}}</td>
                            <div class="flex items-center space-x-4">
                                
                            </div>
                        </td>
                    </tr>
                </tbody>
                @empty
                    <p>Detail tidak ditemukan!</p>
                @endforelse
                
            </table>
            </div>
        </div>
    </div>
</div>

</x-app-layout>