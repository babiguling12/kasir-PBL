<?php

namespace App\Livewire\Transaksi;

use Livewire\Component;
use App\Models\Transaksi;
use Livewire\Attributes\On;
use Illuminate\Support\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;

class Checkout extends Component
{

    protected $listeners = ['tambahProduk'];

    public $cart;
    public $diskon;
    public $quantity;
    public $stok;
    public $total;
    public $totalbayar;
    public $jumlah_uang;
    public $kembalian;
    public $nota;
    public $metode_pembayaran;
    public $snap_token;

    public function mount()
    {
        $this->cart = 'sale';
        $this->diskon = 0;
        $this->quantity = [];
        $this->stok = [];
        $this->total = 0;
        $this->totalbayar = 0;
        $this->jumlah_uang = 0;
        $this->kembalian = 0;
        $this->snap_token = 0;

        $this->nota = Carbon::parse(now())->format('Ymd') . str_pad(count(Transaksi::whereDate('created_at', Carbon::today())->get()) + 1, 4, 0, STR_PAD_LEFT) . '-' . rand(1,9);
    }

    public function resetCart()
    {
        Cart::instance($this->cart)->destroy();
        $this->mount();
    }

    public function tambahProduk($produk)
    {
        $cart = Cart::instance($this->cart);

        $exists = $cart->search(function ($cartItem, $rowId) use ($produk) {
            return $cartItem->id == $produk['id'];
        });

        if ($exists->isNotEmpty()) {
            flash()->warning('Produk sudah ada di keranjang!');

            return;
        }

        $cart->add([
            'id'      => $produk['id'],
            'name'    => $produk['nama_produk'],
            'qty'     => 1,
            'price'   => $produk['harga'],
            'weight'   => 1,
            'options' => [
                'sub_total'              => $produk['harga'],
                'code'                  => $produk['barcode'],
                'stock'                 => $produk['stok'],
            ]
        ]);

        $this->stok[$produk['id']] = $produk['stok'];
        $this->quantity[$produk['id']] = 1;
        $this->totalbayar = $this->hitungTotal();
    }

    public function updateQuantity($row_id, $product_id)
    {
        if ($this->stok[$product_id] < $this->quantity[$product_id]) {
            flash()->warning('Stok tidak cukup.');

            return;
        }

        Cart::instance($this->cart)->update($row_id, $this->quantity[$product_id]);

        $cart_item = Cart::instance($this->cart)->get($row_id);

        Cart::instance($this->cart)->update($row_id, [
            'options' => [
                'sub_total'             => $cart_item->price * $cart_item->qty,
                'code'                  => $cart_item->options->code,
                'stock'                 => $cart_item->options->stock,
            ]
        ]);
    }

    public function updatedJumlahUang()
    {
        if (!$this->jumlah_uang || $this->jumlah_uang < 0) $this->jumlah_uang = 0;
        $this->kembalian = (int)($this->jumlah_uang - Cart::instance($this->cart)->totalFloat());
    }

    public function hitungTotal()
    {
        return Cart::instance($this->cart)->total();
    }

    public function removeItem($row_id)
    {
        Cart::instance($this->cart)->remove($row_id);
    }

    public function updatedDiskon()
    {
        if (!$this->diskon || $this->diskon < 0) $this->diskon = 0;
        if ($this->diskon > 100) $this->diskon = 100;
        Cart::instance($this->cart)->setGlobalDiscount((int)$this->diskon);
    }

    public function render()
    {
        $this->updatedDiskon();
        $this->updatedJumlahUang();

        $cart_items = Cart::instance($this->cart)->content();

        return view('livewire.transaksi.product-cart', [
            'cart_items' => $cart_items
        ]);
    }

    public function cash()
    {
        if ($this->kembalian < 0) {
            flash()->error('Uang tidak mencukupi!');
        } elseif (Cart::instance($this->cart)->countItems() == 0) {
            flash()->error('Silahkan tambah produk!');
        } else {
            $this->dispatch('openModal', component: 'transaksi.konfirmasi-transaksi', arguments: ["print" => false]);
            $this->metode_pembayaran = 'cash';
        }
    }

    public function paymentGateway()
    {
        if (Cart::instance($this->cart)->countItems() == 0) {
            flash()->error('Silahkan tambah produk!');
        } else {
            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = config('midtrans.is_production');
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = config('midtrans.is_3ds');



            $params = array(
                'transaction_details' => array(
                    'order_id' => $this->nota,
                    'gross_amount' => (int)Cart::instance($this->cart)->totalFloat(),
                ),
            );

            $snapToken = \Midtrans\Snap::getSnapToken($params);
            $this->snap_token = $snapToken;
            $this->metode_pembayaran = 'transfer';

            $this->dispatch('openPaymentGateway', snapToken: $snapToken);
        }
    }


    #[On('transaksiDikonfirmasi')]
    public function store()
    {
        Transaksi::simpanTransaksi([
            'tanggal' => Carbon::parse(now())->format('Ymd'),
            'total_bayar' => Cart::instance($this->cart)->totalFloat(),
            'jumlah_uang' => $this->jumlah_uang,
            'diskon' => Cart::instance($this->cart)->discountFloat(),
            'nota' => $this->nota,
            'metode_pembayaran' => $this->metode_pembayaran,
            'snap_token' => $this->snap_token,

            'transaksi_details' => Cart::instance($this->cart)->content()
        ]);

        sleep(1);

        $this->dispatch('openModal', component: 'transaksi.konfirmasi-transaksi', arguments: ["print" => true]);
        // $this->dispatch('openModal', component: 'transaksi.print-transaksi');
    }
}
