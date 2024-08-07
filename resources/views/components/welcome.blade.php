<div class="bg-white">
    <div class="welcome-container">
        <h1 class="text-3xl font-bold mb-4">¡Bienvenido a Libation Lounge!</h1>
        <div class="max-w-4xl mx-auto">
            @livewire('cocktail.dash-views')
        </div>
        <div class="bordered-paragraph">
            <p class="text-lg text-black mb-2">Explora nuestros deliciosos cócteles y empieza a mezclar la diversión.</p>
            <p class="text-sm text-black">Recuerda que el acceso a algunas recetas exclusivas puede depender de tus permisos. 
                Si deseas experimentar con cócteles especiales y no tienes acceso, contacta con el administrador para recibir 
                ayuda. ¡Salud y disfruta de la experiencia!</p>
        </div>
    </div>    

    <style>
        .welcome-container {
            max-width: 55%;
            height: auto;
            margin: 4% auto;
            background-color: #FFFFFF;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1),
                inset 0 0 0 10px #1d2c4d85;
            padding: 20px;
        }

        .welcome-container h1 {
            font-size: 42px;
            color: #000000;
            font-weight: bold;
            text-transform: none;
            letter-spacing: 1px;
            padding: 10px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .welcome-container .modules-container {
            margin-top: 20px;
        }

        .welcome-container p.description {
            font-size: 18px;
            color: #000000;
            margin-bottom: 10px;
            line-height: 1.6;
        }

        .welcome-container .smaller-text {
            font-size: 14px;
            color: #000000;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .modules-container {
            margin-top: 20px;
        }

        a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #0056b3;
        }

        .bordered-paragraph {
            border: 2px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin: 10px 0;
        }
    </style>
</div>
