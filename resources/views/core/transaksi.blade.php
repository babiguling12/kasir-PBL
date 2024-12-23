<x-app-layout>
    <x-slot:title>Transaksi</x-slot:title>

    <section class="antialiased">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div
                class="bg-white dark:bg-gray-800 relative drop-shadow-md sm:rounded-lg overflow-hidden md:col-span-3 p-4">

                @livewire('transaksi.product-list')


            </div>

            <div class="md:col-span-2">
                <div class="bg-white dark:bg-gray-800 relative drop-shadow-md sm:rounded-lg overflow-hidden p-4">

                    @livewire('transaksi.checkout')

                </div>
            </div>
        </div>
    </section>


</x-app-layout>
