<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;

class CartCounter extends Component
{
    public $count = 0;
    protected $listeners = ['cartUpdated' => 'updateCount'];

    public function mount()
    {
        $this->updateCount();
    }

    public function updateCount()
    {
        if(auth()->check()){
            $this->count = Cart::where('user_id', auth()->id())->sum('quantity');
        }
    }

    public function render()
    {
        return view('livewire.cart-counter');
    }
}
