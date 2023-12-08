<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Hello extends Component
{

    public $count = 0;

    public $nome;

    function incr(){
        $this->count++;
    }
    function decr(){
        $this->count--;
    }

    function javascr(){
        $this->js('alert("oii")');
    }
    function updated($property,$value){
        $this->$property = strtoupper($value);
        #dd($property,$value);
    }

    function updatedTodo($value){
        $this->todo = strtoupper($value);
        #dd($property,$value);
    }

    #[Layout('layouts.base')]
    public function render()
    {
        return view('livewire.hello');
    }
}
