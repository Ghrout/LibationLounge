<?php

namespace App\Livewire\Cocktail;

use Livewire\Component;

class DashViews extends Component
{

    public $modules = [
        1 => [
            "name" => "Carta",
            "ruta" => "cocktail.index",
            "icono" => "menu.jpg",
            "color" => "#b0a08f"
        ],
        2 => [
            "name" => "Mis gustos",
            "ruta" => "manage",
            "icono" => "gusto.jpg",
            "color" => "#b0a08f"
        ]
    ];
    public function render()
    {
        return view('livewire.cocktail.dash-views');
    }
}
