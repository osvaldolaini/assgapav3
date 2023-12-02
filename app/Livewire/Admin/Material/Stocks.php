<?php

namespace App\Livewire\Admin\Material;

use App\Models\Admin\Material\Product;
use App\Models\Admin\Material\Stock;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Stocks extends Component
{
    public $modalIn  = false;
    public $modalOut = false;

    public $product_id;
    public $description;
    public $date;
    public $quantity;
    public $rules;
    public $inStock;
    public $productStatus;

    public function mount(Product $product)
    {
        $this->product_id = $product->id;
        $this->description = $product->title;
        $this->inStock = $product->inStock;
        $this->productStatus = $product->active;
    }
    public function render()
    {
        return view('livewire.admin.material.stocks');
    }
    public function resetAll()
    {
        $this->reset(
    'date',
    'quantity',
        );
    }

    public function increment()
    {
        $this->persist('entrada');
        $this->modalIn = false;
    }
    public function decrement()
    {
        if ($this->quantity > $this->inStock) {
            $this->openAlert('error', 'A qtd informada é maior que o estoque.');
        }else{
            $this->persist('saida');
        }
        $this->modalOut = false;
    }
     public function persist($status)
     {
        $this->rules = [
            'date'=>'required|date_format:d/m/Y',
            'quantity'=>'required',
        ];
        $this->validate();

        Stock::create([
            'date'          =>  $this->date,
            'quantity'      =>  $this->quantity,
            'product_id'    =>  $this->product_id,
            'status'        => $status,
            'created_by'    => Auth::user()->name,
        ]);

        $this->openAlert('success', 'Registro criado com sucesso.');

        $this->resetAll();
        $this->dispatch('uploadingStock');

     }

    //MESSAGE
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }

    public function showModalIn()
    {
        $this->modalIn = true;
    }

    public function showModalOut()
    {
        $this->modalOut = true;
    }
}
