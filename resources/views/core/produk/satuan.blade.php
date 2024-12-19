<x-app-layout>
    <x-slot:title>Satuan</x-slot:title>

    <!-- Start block -->
<section class="bg-gray-50 dark:bg-gray-900 antialiased">
    <div class="mx-auto max-w-screen-4xl">
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">

            @livewire('satuan-table')
        
        </div>
    </div>
</section>
<!-- End block -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
</x-app-layout>