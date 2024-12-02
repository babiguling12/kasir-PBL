<x-header>{{ $title }}</x-header>

<x-navbar></x-navbar>

<x-sidebar></x-sidebar>

    <main class="p-4 md:ml-64 h-auto pt-20">

    {{ $slot }}

    </main>

<x-footer></x-footer>
