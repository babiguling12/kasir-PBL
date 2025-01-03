<x-header>Print Struk</x-header>

<div class="printable-area">
    <h1 class="text-center font-bold text-lg">EdiPos</h1>
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
                <th class="text-right">Harga</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($histori_detail as $detail)
                @if ($detail->harga_barang > 0)
                    <tr>
                        <td>{{ $detail->produk->nama_produk ?? '---' }}</td>
                        <td class="text-center">{{ $detail->qty ?? 0 }}</td>
                        <td class="text-right whitespace-nowrap">@currency($detail->harga_barang)</td>
                        <td class="text-right whitespace-nowrap">@currency($detail->qty * $detail->harga_barang)</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    <hr class="my-2" />
    <div class="flex justify-between text-sm">
        <span><strong>Total Bayar:</strong></span>
        <span class="font-bold">@currency($histori->total_bayar ?? 0)</span>
    </div>
    <hr class="my-2" />
    <p class="text-center text-xs mt-4">Password Wifi : belanjaduluyuk</p>
    <p class="text-center text-xs">Username Wifi : TokoStore</p>
    <p class="text-center text-xs mt-3">Terima Kasih atas Kunjungan Anda!</p>
</div>

<script>
    window.onload = function() {
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
