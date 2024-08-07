<?php

namespace App\Livewire\Cocktail;

use App\Models\Cocktail;
use App\Models\Coctel;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Profile extends Component
{
    public $user, $cocktails, $name, $description, $photo, $ingredients, $likedCocktails, $editing = false, $cocktailId;
    public $showModal = false;

    public function mount()
    {
        $this->user = auth()->user()->id;
        $this->cocktails = [];
        $this->likedCocktails = Coctel::where("user_id", $this->user)->get();
        $this->loadCocktails();
    }

    public function loadCocktails()
    {
        $cocktails = Cocktail::where('user_id', $this->user)->get();
        foreach ($cocktails as $cocktail) {
            $id_coctel = $cocktail->id_api;

            $response = Http::get("https://www.thecocktaildb.com/api/json/v1/1/lookup.php?i={$id_coctel}");

            if ($response->successful()) {
                $data = $response->json();
                $this->cocktails[] = $data['drinks'][0] ?? null;
            }
        }
    }

    public function addCocktail()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => '',
            'ingredients' => 'nullable|string',
        ]);
        $cocktail = new Coctel();
        $cocktail->name = $this->name;
        $cocktail->description = $this->description;
        $cocktail->photo = $this->photo;
        $cocktail->ingredients = $this->ingredients;
        $cocktail->user_id = auth()->user()->id; 
        $cocktail->save(); 
        $this->reset(['name', 'description', 'photo', 'ingredients']);
        $this->showModal = false;
        $this->loadCocktails();
    }

    public function editCocktail($id)
    {
        // Cargar los datos del cóctel para editar
        $cocktail = Coctel::find($id); 
        if ($cocktail) {
            $this->cocktailId = $cocktail->id;
            $this->name = $cocktail->name;
            $this->description = $cocktail->description;
            $this->photo = $cocktail->photo;
            $this->ingredients = $cocktail->ingredients;
            $this->editing = true;
            $this->showModal = true;
        }
    }

    public function updateCocktail()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|url',
            'ingredients' => 'nullable|string',
        ]);

        $cocktail = Coctel::find($this->cocktailId);
        $cocktail->name = $this->name;
        $cocktail->description = $this->description;
        $cocktail->photo = $this->photo;
        $cocktail->ingredients = $this->ingredients;
        $cocktail->save();

        $this->resetForm();
    }

    private function resetForm()
    {
        $this->name = '';
        $this->description = '';
        $this->photo = '';
        $this->ingredients = '';
        $this->showModal = false;
        $this->editing = false;
    }

    public function deleteReceta($id)
    {
        $cocktail = Coctel::find($id);
        if ($cocktail) {
            $cocktail->delete();
            $this->loadCocktails();
        }  
    }

    public function deleteCoctail($id){ 
        $cocktails = Cocktail::where('id_api', $id)->first();
        if ($cocktails) {
            $cocktails->delete(); 
            return redirect()->route('manage');
        }  
    }

    public function render()
    {
        return view('livewire.cocktail.profile');
    }
}
