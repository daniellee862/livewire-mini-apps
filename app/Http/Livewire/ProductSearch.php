<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductSearch extends Component
{
    use WithPagination;

    public $search = '';
    protected $queryString = ['search'];
    public function render()
    {
        $query = Product::query();
        if($this->search){
            $query->Where('title', 'like', "%{$this->search}%")
                ->orWhere('description', 'like', "%{$this->search}%");
        }

        return view('livewire.product-search',
        ['products' => $query->paginate(26)
        ]);
    }

    public function updated($property){
        if($property === 'search'){
            $this->resetPage();
        }

    }

}
