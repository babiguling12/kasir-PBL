<div class="printable-area">
    <h1 class="text-center font-bold text-xl">Struk Transaksi</h1>
    <hr class="my-2"/>
    <ul class="text-sm">
        <li>No Pesanan: <strong>{{ $histori->nota }}</strong></li>
        <li>Tanggal Transaksi: <strong>{{ $histori->tanggal }}</strong></li>
        <li>Metode Pembayaran: <strong>{{ $histori->metode_pembayaran }}</strong></li>
        <li>Nama Kasir: <strong>{{ $histori->kasir->nama }}</strong></li>
    </ul>
    <hr class="my-2"/>
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
            @foreach($histori_detail as $detail)
                <tr>
                    <td>{{ $detail->produk->nama }}</td>
                    <td class="text-center">{{ $detail->qty }}</td>
                    <td class="text-right">@currency($detail->harga_barang)</td>
                    <td class="text-right">@currency($detail->qty * $detail->harga_barang)</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr class="my-2"/>
    <div class="flex justify-between text-sm">
        <span><strong>Total Bayar:</strong></span>
        <span class="font-bold">@currency($histori->total_bayar)</span>
    </div>
    <hr class="my-2"/>
    <p class="text-center text-xs mt-4">Terima Kasih atas Kunjungan Anda!</p>
</div>

<style>
@media print {
    .printable-area {
        width: 80mm; /* Set width for thermal printer */
        margin: 0;
        padding: 5mm;
        font-family: 'Courier New', Courier, monospace;
    }
    hr {
        border: none;
        border-top: 1px dashed #000;
    }
    @currency {
        /* Define your currency formatting here */
    }
}
</style>

