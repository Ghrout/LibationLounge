<?php

namespace App\Livewire\Cocktail;

use App\Models\Cocktail;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Index extends Component
{
    public $cocktails = [];
    public $page = 1;
    public $perPage = 8;

    public function mount()
    {
        $this->loadCocktails();
    }

    public function loadCocktails()
    {
        $numRandomCocktails = 27; 
        $this->cocktails = [];
        for ($i = 0; $i < $numRandomCocktails; $i++) {
            $response = Http::get('https://www.thecocktaildb.com/api/json/v1/1/random.php');
            if ($response->successful()) {
                $cocktail = $response->json()['drinks'][0] ?? null;
                if ($cocktail) {
                    $this->cocktails[] = $cocktail;
                }
            }
        }
    }

    public function nextPage()
    {
        $totalPages = ceil(count($this->cocktails) / $this->perPage);

        if ($this->page < $totalPages) {
            $this->page++;
        } else {
            $this->loadCocktails();
            $this->page = 1;
        }
    }

    public function prevPage()
    {
        if ($this->page > 1) {
            $this->page--;
        }
    }

    public function save($cocktailId, $action)
    {
        $cocktail = collect($this->cocktails)->firstWhere('idDrink', $cocktailId);
        
        if ($cocktail) {
            $data = [
                'id_api' => $cocktail['idDrink'],
                'user_id' => auth()->id(),
                'like' => false,
                'dont' => false,
            ]; 
            
            if ($action === 'like') {
                $data['like'] = true;
            } elseif ($action === 'dont') {
                $data['dont'] = true;
            }
            
            Cocktail::updateOrCreate(
                ['id_api' => $cocktail['idDrink'], 'user_id' => auth()->id()],
                $data
            ); 

            $this->loadCocktails();
        }
    }

    public function render()
    {
        $currentPageCocktails = array_slice($this->cocktails, ($this->page - 1) * $this->perPage, $this->perPage);
        return view('livewire.cocktail.index', ['currentPageCocktails' => $currentPageCocktails]);
    }
}
