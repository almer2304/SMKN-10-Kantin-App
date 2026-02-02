<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Cart;

class QuickOrderForm extends Component
{
    public $search = '';
    public $selectedProducts = [];
    public $quantities = [];
    public $total = 0;

    protected $rules = [
        'quantities.*' => 'required|numeric|min:1'
    ];

    public function mount()
    {
        $this->quantities = [];
    }

    public function render()
    {
        $products = Product::active()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->get();

        return view('livewire.quick-order-form', [
            'products' => $products,
        ]);
    }

    public function addProduct($productId)
    {
        if (!in_array($productId, $this->selectedProducts)) {
            $this->selectedProducts[] = $productId;
            $this->quantities[$productId] = 1;
            $this->calculateTotal();
        }
    }

    public function removeProduct($productId)
    {
        $key = array_search($productId, $this->selectedProducts);
        if ($key !== false) {
            unset($this->selectedProducts[$key]);
            unset($this->quantities[$productId]);
            $this->selectedProducts = array_values($this->selectedProducts);
            $this->calculateTotal();
        }
    }

    public function updatedQuantities()
    {
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total = 0;
        foreach ($this->selectedProducts as $productId) {
            $product = Product::find($productId);
            $quantity = $this->quantities[$productId] ?? 1;
            $this->total += $product->price * $quantity;
        }
    }

    public function processOrder()
    {
        $this->validate();

        if (empty($this->selectedProducts)) {
            session()->flash('error', 'Pilih produk terlebih dahulu');
            return;
        }

        // Simpan ke cart atau langsung buat order
        foreach ($this->selectedProducts as $productId) {
            $quantity = $this->quantities[$productId];
            
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $productId,
                'quantity' => $quantity
            ]);
        }

        $this->reset();
        $this->emit('cartUpdated');
        session()->flash('success', 'Produk berhasil ditambahkan ke keranjang');
    }
}