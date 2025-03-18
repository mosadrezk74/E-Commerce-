<?php

namespace App\Livewire;

use App\Models\Admin\Product;
use Livewire\Component;

class PriceFilter extends Component
{

    public $minPrice;
    public $maxPrice;
    public $filteredProducts;

    public function filterProducts()
    {
         $this->validate([
            'minPrice' => 'numeric',
            'maxPrice' => 'numeric',
        ]);

         $query = Product::query();

        if ($this->minPrice !== null) {
            $query->where('price', '>=', $this->minPrice);
        }

        if ($this->maxPrice !== null) {
            $query->where('price', '<=', $this->maxPrice);
        }

          $this->filteredProducts = $query->get();

    }

    public function render()
    {
        return view('livewire.price-filter');
    }

}
