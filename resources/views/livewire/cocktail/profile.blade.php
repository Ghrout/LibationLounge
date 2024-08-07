<div>
    <div class="w-full bg-white flex flex-col items-center justify-center px-4 py-4">
        <div class="flex flex-col items-center">
            <!-- Foto de perfil -->
            <img src="URL_DE_TU_IMAGEN_DE_PERFIL" alt="Foto de perfil"
                class="w-32 h-32 rounded-full border-4 border-gray-200 mb-6">

            <!-- Nombre del Usuario (obtenido dinámicamente) -->
            <h1 class="text-3xl font-bold text-gray-800 mb-4">¡Hola, {{ Auth::user()->name }}!</h1>

            <!-- Mensaje de bienvenida -->
            <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200 max-w-lg mx-auto mt-6">
                <div class="text-center">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">¡Bienvenido a tu menú de Libation Lounge!</h2>
                    <p class="text-lg text-gray-700 mb-4">Aquí podrás ver los cócteles a los cuales diste "Me gusta" y
                        los que no.</p>
                    <p class="text-sm text-gray-600">Puedes seleccionarlos y también podrás añadir más cócteles a tu
                        lista.</p>
                </div>
            </div>

        </div>

        <!-- Botón para abrir el modal -->
        <div class="text-center mt-6">
            <button wire:click="$set('showModal', true)"
                class="bg-blue-300 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                Añadir Cóctel
            </button>
        </div>

        <div class="h-screen bg-white flex flex-col px-4 py-8">
            <!-- Contenedor de pestañas -->
            <div class="w-full">
                <div class="flex border-b border-gray-200">
                    <button id="likes-tab" class="tab-button active-tab">Mis Recetas</button>
                    <button id="recipes-tab" class="tab-button">Tus Me Gusta</button>
                </div>

                <!-- Contenido de las pestañas -->
                <div id="likes-content" class="tab-content mt-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-4">
                        @foreach ($likedCocktails as $cocktail)
                            <div class="card">
                                <div class="first-content">
                                    <img src="{{ $cocktail['photo'] }}" alt="{{ $cocktail['name'] }}"
                                        class="cocktail-img">
                                    <h2 class="cocktail-name">{{ $cocktail['name'] }}</h2>
                                </div>
                                <div class="second-content">
                                    <h3 class="cocktail-name">{{ $cocktail['name'] }}</h3>
                                    <p class="cocktail-description">{{ $cocktail['description'] }}</p>
                                    <div class="button-container flex space-x-4">
                                        <!-- Botón Editar -->
                                        <button wire:click="editCocktail('{{ $cocktail['id'] }}')"
                                            class="edit-button bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                                            Editar
                                        </button>
                                        <!-- Botón Eliminar -->
                                        <button
                                            class="delete-button bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded"
                                            wire:click="deleteReceta('{{ $cocktail['id'] }}')">
                                            Eliminar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div id="recipes-content" class="tab-content mt-4 hidden">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-8">
                        @foreach ($cocktails as $cocktail)
                            <div class="card">
                                <div class="first-content">
                                    <img src="{{ $cocktail['strDrinkThumb'] }}" alt="{{ $cocktail['strDrink'] }}"
                                        class="cocktail-img">
                                    <h2 class="cocktail-name">{{ $cocktail['strDrink'] }}</h2>
                                </div>
                                <div class="second-content">
                                    <h3 class="cocktail-name">{{ $cocktail['strDrink'] }}</h3>
                                    <p class="cocktail-description">{{ $cocktail['strInstructions'] }}</p>
                                    <div class="button-container">
                                        <button class="dislike-button" wire:click="deleteCoctail('{{ $cocktail['idDrink'] }}', 'dont')">
                                            Eliminar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
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

        <!-- Modal para crear/editar cócteles -->
        @if ($showModal)
            <div class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">
                        {{ $editing ? 'Editar Cóctel' : 'Crear Nuevo Cóctel' }}
                    </h2>

                    <form wire:submit.prevent="{{ $editing ? 'updateCocktail' : 'addCocktail' }}">
                        <!-- Campo oculto para el ID del cóctel si estamos editando -->
                        @if ($editing)
                            <input type="hidden" wire:model="cocktailId">
                        @endif

                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Nombre</label>
                            <input type="text" id="name" wire:model.defer="name"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700">Descripción</label>
                            <textarea id="description" wire:model.defer="description" rows="4"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="photo" class="block text-gray-700">Foto (URL)</label>
                            <input type="text" id="photo" wire:model.defer="photo"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div class="mb-4">
                            <label for="ingredients" class="block text-gray-700">Ingredientes</label>
                            <textarea id="ingredients" wire:model.defer="ingredients" rows="4"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        </div>
                        <div class="flex justify-between">
                            <button type="button" wire:click="$set('showModal', false)"
                                class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg">
                                Cancelar
                            </button>
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg">
                                {{ $editing ? 'Actualizar Cóctel' : 'Crear Cóctel' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
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
            margin: 0.5rem;
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

        .tab-button {
            padding: 10px 20px;
            border: 1px solid transparent;
            background: none;
            cursor: pointer;
            font-weight: bold;
        }

        .active-tab {
            border-bottom: 2px solid blue;
            color: blue;
        }

        .tab-content {
            transition: opacity 0.3s ease;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.tab-button');
            const contents = document.querySelectorAll('.tab-content');

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const targetContentId = tab.id.replace('-tab', '-content');
                    contents.forEach(content => {
                        content.classList.add('hidden');
                    });
                    document.getElementById(targetContentId).classList.remove('hidden');

                    tabs.forEach(tab => {
                        tab.classList.remove('active-tab');
                    });
                    tab.classList.add('active-tab');
                });
            });
        });

        Livewire.on('cocktailDeleted', message => {
            alert(message); // Puedes personalizar el mensaje o usar una notificación más estilizada
        });

        Livewire.on('cocktailDeleted', message => {
            // Crea un nuevo elemento de mensaje
            const messageElement = document.createElement('div');
            messageElement.className = 'bg-green-500 text-white font-semibold py-2 px-4 rounded mb-2';
            messageElement.textContent = message;

            // Agrega el mensaje al contenedor
            const messageContainer = document.getElementById('message-container');
            messageContainer.appendChild(messageElement);

            // Oculta el mensaje después de unos segundos
            setTimeout(() => {
                messageElement.remove();
            }, 5000);
        });
    </script>

    <div id="message-container" class="fixed bottom-4 right-4">
        <!-- Los mensajes se insertarán aquí -->
    </div>
</div>
