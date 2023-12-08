<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

class Prods extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    #[Validate('required|min:3')]
    public $name;

    #[Validate('required')]
    public $price;

    #[Validate('required')]
    public $category_id;

    public $categories = [];

    public $img;

    #public ?Product $prod;

    public $perPage = 10;
    public $search = '';
    public $sortDir = 'ASC';
    public $sortCol = 'name';

    function doSort($col){
        if($this->sortCol == $col){
            $this->sortDir = $this->sortDir == 'ASC'? 'DESC':'ASC';
            return;
        }
        $this->sortCol = $col;
        $sortDir = 'ASC';
    }

    function updatedSearch(){
        $this->resetPage();
    }

    #[Computed()]
    function getAll(){
        return Product::orderBy($this->sortCol,$this->sortDir)
        ->when($this->search != '',function($q){
            $q->where('name','like',"%".$this->search ."%");
        })
        ->paginate($this->perPage);
    }

    function mount(){
        $this->prod = null;
        $this->categories = Category::all();
    }

    function del(Product $prod){
        $prod->delete();
    }

    function sel(Product $prod){
        $this->prod = $prod;
    }

    function add(){
        $validated = $this->validate();

        #$validated['category_id'] = $this->category_id;
        $validated['slug'] = Str::slug($this->name);
        #dd($validated);
        $product = Product::create($validated);
        #dump($product);
        $this->getAll();
        $this->reset('name','price','category_id');
    }

    #[Layout('layouts.base')]
    public function render()
    #return view('livewire.prods');
    {
        return <<<'HTML'
        <div>
            <div>


                <hr>
                Adicionar
                <form wire:submit="add">
                    <input class="form-control" wire:model="name" />
                    @error('name') {{ $message }} @enderror
                    <input class="form-control" wire:model="price" />
                    @error('price') {{ $message }} @enderror

                    <select class="form-control" wire:model.live="category_id">
                    @foreach($this->categories as $categ)
                        <option value="{{$categ->id}}">{{$categ->name}}</option>
                    @endforeach
                    </select>
                    @error('category_id') {{ $message }} @enderror
                    <button class="btn btn-sm btn-outline-primary">add</button>
                </form>
                <hr>
                <select class="form-control" wire:model.live="perPage">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                </select>
                {{ $this->getAll()->links() }}
                <hr>
                Produtos  <input wire:model.live="search">
                <table class="table table-striped table-hover">
                    <tr>
                        <th><a href="#" wire:click="doSort('id')">id</a></th>
                        <th>-</th>
                        <th><a href="#" wire:click="doSort('name')">name</a></th>
                        <th><a href="#" wire:click="doSort('price')">price</a></th>
                        <th>-</th>
                        <th>-</th>
                    </tr>

                @foreach($this->getAll() as $prod)
                    <tr wire:key="{{ $prod->id }}">
                        <td>{{ $prod->id }}</td>
                        <td>
                        <form wire:submit="submit({{ $prod->id }})" enctype="multipart/form-data">
                            <input type="file" class="form-control" wire:model="img" />
                            <button class="btn btn-sm btn-outline-info">upl</button>
                        </form>
                        </td>
                        <td>{{ $prod->name }}</td>
                        <td>R$ {{ $prod->price }}</td>
                        <td><a href="#" wire:click="del({{ $prod->id }})" wire:confirm="vc tem certeza del #{{$prod->id}} ?" class="btn btn-sm btn-outline-danger">del</a></td>
                        <td><a href="#" wire:click="sel({{ $prod->id }})" class="btn btn-sm btn-outline-success">sel</a></td>
                    </tr>
                @endforeach
                </table>
            </div>



        </div>
        HTML;
    }
}
