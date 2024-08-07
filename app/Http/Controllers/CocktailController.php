<?php

namespace App\Http\Controllers; 

class CocktailController extends Controller
{
    // Mostrar la lista de cócteles desde la API
    public function index()
    {
        return view('livewire.public.index');
    } 

    // Mostrar la lista de cócteles guardados en la base de datos
    public function manage() {
        return view('livewire.public.profile');
    }  
}
