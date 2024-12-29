<div>
    <div class="text-right mb-3">No. {{ $nota }}</div>

    <div class="relative overflow-x-auto mb-5 max-h-80">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="ps-6 py-3">
                        Barcode
                    </th>
                    <th scope="col" class="ps-6 py-3">
                        Produk
                    </th>
                    <th scope="col" class="ps-6 py-3">
                        Harga
                    </th>
                    <th scope="col" class="px-3 text-center py-3">
                        Qty
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cart_items as $cart_item)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="ps-6 py-4">
                            <p class="mb-1 text-xs bg-green-100 text-green-600 p-1 rounded w-fit">
                                {{ $cart_item->options->code }}
                            </p>
                        </td>
                        <td class="ps-6 py-4 font-medium text-gray-900 dark:text-white">
                            {{ $cart_item->name }}
                        </td>
                        <td class="ps-6 py-4 text-nowrap">
                            Rp {{ number_format($cart_item->price, 0, ',', '.') }}
                        </td>
                        <td class="px-3 py-4">

                            <div class="relative flex items-center">
                                <input type="number" wire:model="quantity.{{ $cart_item->id }}" class="flex-shrink-0 text-gray-900 dark:text-white border-0 bg-transparent text-sm font-normal pe-0 text-right focus:outline-none focus:ring-0 max-w-[4rem] text-center" placeholder="" value="{{ $cart_item->qty }}" required />

                                <button type="button" wire:click="updateQuantity('{{ $cart_item->rowId }}', {{ $cart_item->id }})" class="flex-shrink-0 bg-blue-600 hover:bg-blue-700 inline-flex items-center justify-center border border-gray-300 rounded-md h-5 w-5 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                    <svg class="w-2.5 h-2.5 text-gray-900 dark:text-white" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ffffff" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                        <path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z"/>
                                    </svg>
                                </button>
                            </div>

                        </td>
                        <td class="pe-6 py-4">

                            <div class="relative flex items-center">
                                <button type="button" wire:click.prevent="removeItem('{{ $cart_item->rowId }}')"
                                    class="flex-shrink-0 bg-rose-600 hover:bg-rose-700 inline-flex items-center justify-center border border-rose-900 rounded-md h-5 w-5 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                        width="24px" fill="#ffffff">
                                        <path
                                            d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                                    </svg>
                                </button>
                            </div>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">
                            <span class="text-red-600">
                                Silahkan tambah produk!
                            </span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="relative overflow-x-auto mb-5">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <tbody>
                <tr class="bg-white border-y dark:bg-gray-800 dark:border-gray-700">
                    <th class="px-6 py-4">
                        Diskon ({{ $diskon }}%)
                    </th>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        (-) Rp {{ (Cart::instance($cart)->discount()) }}
                    </td>
                </tr>
                <tr class="bg-white border-y text-blue-600 dark:bg-gray-800 dark:border-gray-700">
                    <th class="px-6 py-4">
                        Total Bayar
                    </th>
                    <td class="px-6 py-4 font-medium whitespace-nowrap dark:text-white">
                        (=) Rp {{ (Cart::instance($cart)->total()) }}
                    </td>
                </tr>
                <tr class="bg-white border-y dark:bg-gray-800 dark:border-gray-700">
                    <th class="px-6 py-4">
                        Kembalian (Cash)
                    </th>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        (=) Rp {{ number_format($kembalian, 0, ',', '.') }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="grid gap-1 mb-5 sm:grid-cols-3">
        <div class="relative sm:col-span-2">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none font-bold text-gray-500">
                Rp
            </div>
            <input type="number" id="jumlah-uang" wire:model.blur="jumlah_uang"
                class="block w-full p-3 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Jumlah Uang..." autocomplete="off" value="{{ $jumlah_uang }}" />
        </div>

        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none font-bold text-gray-500">
                %
            </div>
            <input type="number" id="diskon" wire:model.blur="diskon"
                class="block w-full p-3 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Diskon" min="0" max="100" value="{{ $diskon }}" />
        </div>
    </div>

    <div class="flex justify-end ">
        <button type="button" wire:click="resetCart"
            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="w-6 h-6 me-2" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                width="24px" fill="#ffffff">
                <path
                    d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z" />
            </svg>
            Reset
        </button>
        <button type="button"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="w-6 h-6 me-2" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                width="24px" fill="#ffffff">
                <path
                    d="M880-720v480q0 33-23.5 56.5T800-160H160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720Zm-720 80h640v-80H160v80Zm0 160v240h640v-240H160Zm0 240v-480 480Z" />
            </svg>
            Payment Gateway
        </button>
        <button type="button" {{ ($kembalian < 0) ? 'disabled' : '' }} wire:click="cash"
            class="{{ ($kembalian < 0) ? 'bg-blue-400 cursor-not-allowed' : 'bg-blue-700 hover:bg-blue-800' }} text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="w-6 h-6 me-2" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                width="24px" fill="#ffffff">
                <path
                    d="M560-440q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35ZM280-320q-33 0-56.5-23.5T200-400v-320q0-33 23.5-56.5T280-800h560q33 0 56.5 23.5T920-720v320q0 33-23.5 56.5T840-320H280Zm80-80h400q0-33 23.5-56.5T840-480v-160q-33 0-56.5-23.5T760-720H360q0 33-23.5 56.5T280-640v160q33 0 56.5 23.5T360-400Zm440 240H120q-33 0-56.5-23.5T40-240v-440h80v440h680v80ZM280-400v-320 320Z" />
            </svg>
            Cash
        </button>
    </div>
</div>
