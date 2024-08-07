<div class="h-screen bg-white flex flex-col items-center justify-center px-4 py-8 relative"> 
    <!-- Contenedor de la imagen -->
    <div class="mt-28 flex justify-center items-center">
        <img src="{{ asset('image/Logo.png') }}" class="w-80 h-80 object-contain">
    </div>

    <div class="container mx-auto px-4 py-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-4">
            @foreach ($currentPageCocktails as $cocktail)
                <div class="card">
                    <div class="first-content">
                        <img src="{{ $cocktail['strDrinkThumb'] }}" alt="{{ $cocktail['strDrink'] }}"
                            class="cocktail-img">
                        <h2 class="cocktail-name">{{ $cocktail['strDrink'] }}</h2>
                    </div>
                    <div class="second-content">
                        <h3 class="cocktail-name">{{ $cocktail['strDrink'] }}</h3>
                        <p class="cocktail-description">
                            {{ $cocktail['strInstructions'] }}
                        </p>
                        <div class="button-container">
                            <button class="like-button" wire:click="save('{{ $cocktail['idDrink'] }}', 'like')">
                                <img src="{{ asset('icons/like.png') }}" class="w-8 h-8">
                            </button>
                            <button class="dislike-button" wire:click="save('{{ $cocktail['idDrink'] }}', 'dont')">
                                <img src="{{ asset('icons/dislike.png') }}" class="w-8 h-8"></button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pagination flex justify-between mt-4">
            <button wire:click="prevPage"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-l-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                Anterior
            </button>
            <button wire:click="nextPage"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-r-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                Siguiente
            </button>
        </div>
    </div>


    <style>
        .card {
            width: 300px;
            height: 350px;
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid #ff9100;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
            font-family: 'Roboto', sans-serif;
            transition: transform 0.4s, box-shadow 0.4s;
            margin: 1rem;
            display: flex;
            flex-direction: column;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0px 12px 24px rgba(0, 0, 0, 0.2);
        }

        .first-content,
        .second-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: absolute;
            width: 100%;
            height: 100%;
            transition: opacity 0.4s;
            overflow: hidden;
            text-align: center;
            padding: 1rem;
        }

        .first-content {
            background: linear-gradient(to top, rgba(139, 87, 66, 0.8), rgba(255, 255, 255, 0.5));
            color: #fff;
            opacity: 1;
        }

        .second-content {
            background: linear-gradient(to top, rgba(243, 113, 62, 0.863), rgba(139, 87, 66, 0.685));
            color: #333;
            opacity: 0;
            padding: 1.5rem;
            text-align: left;
            overflow: auto;
            /* Permite el desplazamiento si el contenido es demasiado largo */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            /* Asegura que el título y la descripción estén separados correctamente */
        }

        .card:hover .first-content {
            opacity: 0;
        }

        .card:hover .second-content {
            opacity: 1;
        }

        .cocktail-img {
            width: 95%;
            height: auto;
            /* Ajusta la altura automáticamente para mantener las proporciones */
            object-fit: cover;
            border-bottom: 1px solid #e0e0e0;
        }

        .cocktail-name {
            margin: 0.5rem 0;
            font-size: 1.2rem;
            font-weight: 600;
            font-family: 'Playfair Display', serif;
            color: #fff;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.466);
            letter-spacing: 0.05em;
            line-height: 1.3;
            text-transform: uppercase;
            text-align: center;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal;
            word-wrap: break-word;
        }

        .cocktail-description {
            margin-top: 0.5rem;
            font-size: 0.9rem;
            /* Ajusta el tamaño del texto si es necesario */
            font-family: 'Roboto', sans-serif;
            color: #333;
            line-height: 1.6;
            text-align: justify;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            background-color: #f9f9f9;
            overflow: auto;
            /* Permite el desplazamiento si el contenido es demasiado largo */
            flex-grow: 1;
            /* Permite que la descripción ocupe el espacio restante */
        }

        .save-button {
            background: #007bff;
            color: #fff;
            padding: 0.5rem 1.5rem;
            border: none;
            border-radius: 30px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s;
            margin-top: 1rem;
        }

        .save-button:hover {
            background: #0056b3;
            transform: scale(1.05);
        }

        .button-container {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            margin-top: 1rem;
        }

        .like-button,
        .dislike-button {
            background: #007bff;
            color: #fff;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 20px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s;
            margin: 0 0.5rem;
        }

        .like-button:hover,
        .dislike-button:hover {
            background: #0056b3;
            transform: scale(1.05);
        }

        .dislike-button {
            background: #dc3545;
        }

        .dislike-button:hover {
            background: #c82333;
        }
    </style>
</div>
