    <div>
        <ul class="flex w-full p-2 items-center justify-center flex-wrap">
            @foreach ($modules as $module)
                <a href="{{ route($module['ruta']) }}" class="w-5/12 m-2 sm:w-40">
                    <li class="group p-2 flex flex-col border border-gray-700 rounded-md cursor-pointer"
                        style="transition: background-color 0.3s ease-in-out; border-color: transparent;"
                        onmouseover="this.style.backgroundColor='{{ $module['color'] }}'; this.style.borderColor='black'"
                        onmouseout="this.style.backgroundColor='transparent'; this.style.borderColor='transparent'">
                        <img src="{{ asset('image/' . $module['icono']) }}" alt="{{ $module['name'] }}"
                            style="width: 10rem; height: 10rem; object-fit: cover;">
                        <span
                            class="inline-block mt-2 w-full px-4 py-3 text-center text-white text-lg font-semibold tracking-wide bg-gradient-to-r from-green-500 to-teal-600 rounded-full shadow-md hover:shadow-lg border-2 border-black hover:border-white overflow-hidden whitespace-nowrap overflow-ellipsis"
                            style="border-width: 2px; max-width: 100%;">
                            {{ $module['name'] }}
                        </span>
                    </li>
                </a>
            @endforeach
        </ul>
    </div>
