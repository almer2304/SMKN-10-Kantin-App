<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductSearch extends Component
{
    public $search = '';
    public $category = '';
    public $perPage = 12;
    public $sortBy = 'name';
    public $sortDirection = 'asc';

    public function render()
    {
        $products = Product::active()->when($this->search, function($query){
            $query->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'like', '%' . $this->search);})
            ->when($this->category, function($query){$query->where('category_id', $this->category);})
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);
        return view('livewire.product-search');
    }

    public function sortBy($field){
        if($this->sortBy === $field){
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        }else{
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function loadMore()
    {
        $this->perPage += 12;
    }
}
