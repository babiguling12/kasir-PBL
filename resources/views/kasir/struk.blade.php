<x-header>Print Struk</x-header>

<div class="printable-area">
    <h1 class="text-center font-black text-lg">EDIPOS</h1>
    <p class="text-center text-xs mt-1">
        <span class="px-1">WA: 0852-1234-5678</span>
        <span class="px-2">IG: @EdiPOS</span>
    </p>
    <hr class="my-2" />
    <ul class="text-sm">
        <li>No Pesanan: <strong>{{ $histori->nota ?? '---' }}</strong></li>
        <li>Tanggal: <strong>{{ $histori->tanggal ?? '---' }}</strong></li>
        <li>Metode Pembayaran: <strong>{{ $histori->metode_pembayaran ?? '---' }}</strong></li>
        <li>Nama Kasir: <strong>{{ $histori->kasir->nama ?? '---' }}</strong></li>
    </ul>
    <hr class="my-2" />
    <table class="w-full text-sm">
        <thead>
            <tr>
                <th class="text-left">Produk</th>
                <th class="text-center">Qty</th>
                <th class="text-right px-4">Harga</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($histori_detail as $detail)
                @if ($detail->harga_barang > 0)
                    <tr>
                        <td class="py-2">{{ $detail->produk->nama_produk ?? '---' }}</td>
                        <td class="text-center py-2">{{ $detail->qty ?? 0 }}</td>
                        <td class="text-right py-2 px-4">{{ number_format($detail->harga_barang, 0, ',', '.') }}</td>
                        <td class="text-right py-2">
                            {{ number_format($detail->qty * $detail->harga_barang, 0, ',', '.') }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    <hr class="my-2" />
    @if ($histori->diskon > 0)
        <div class="flex justify-between text-sm mb-1">
            <span class="text-right w-2/3"><strong>Sub Total :</strong></span>
            <span class="font-bold">@currency(($histori->total_bayar ?? 0) + ($histori->diskon ?? 0))</span>
        </div>
        <div class="flex justify-between text-sm mb-1">
            <span class="text-right w-2/3"><strong>Diskon :</strong></span>
            <span class="font-bold">@currency($histori->diskon ?? 0)</span>
        </div>
    @endif
    <div class="flex justify-between text-sm mb-1">
        <span class="text-right w-2/3"><strong>Grand Total :</strong></span>
        <span class="font-bold">@currency($histori->total_bayar ?? 0)</span>
    </div>
    @if ($histori->metode_pembayaran == 'cash')
        <div class="flex justify-between text-sm mb-1">
            <span class="text-right w-2/3"><strong>Tunai :</strong></span>
            <span class="font-bold">@currency($histori->jumlah_uang)</span>
        </div>
        <div class="flex justify-between text-sm mb-2">
            <span class="text-right w-2/3"><strong>Total Bayar :</strong></span>
            <span class="font-bold">@currency($histori->jumlah_uang - $histori->total_bayar)</span>
        </div>
    @endif
    <hr class="my-2" />
    <p class="text-center text-xs mt-4">Password Wifi : belanjaduluyuk</p>
    <p class="text-center text-xs">Username Wifi : TokoStore</p>
    <p class="text-center text-xs mt-2">Terima Kasih atas Kunjungan Anda!</p>
</div>

<script>
    window.onload = function print() {
        window.print();

        setTimeout(() => {
            window.history.back();
        }, 1000);

    };
</script>

<style>
    @media print {

        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .printable-area {
            width: 80mm;
            /* Lebar printer thermal */
            margin: 0;
            padding: 5mm;
            font-family: 'Courier New', Courier, monospace;
        }

        h1 {
            font-size: 16px;
            margin: 0;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0 0 5px 0;
        }

        li {
            line-height: 1.5;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 3px 0;
        }

        th {
            font-weight: bold;
            border-bottom: 1px dashed #000;
        }

        td {
            font-size: 12px;
        }

        hr {
            border: none;
            border-top: 1px dashed #000;
        }

        .flex {
            display: flex;
            justify-content: space-between;
        }

        .text-sm {
            font-size: 12px;
        }

        .text-xs {
            font-size: 10px;
        }
    }
</style>

<x-footer></x-footer>
