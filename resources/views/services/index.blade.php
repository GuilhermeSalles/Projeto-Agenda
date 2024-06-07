<!-- resources/views/services/index.blade.php -->

@extends('admin.master')
@extends('admin.get-status-form')

@section('title', 'Services')

@section('content')

    <br>
    <div class="container">
        <div class="section">
            <div class="content">
                <h2>SERVIÇOS</h2>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="section" style="padding: 20px; border-radius: 10px; background-color: #f8f9fa;">
            <div class="bcontainer">
                <a href="{{ route('services.create') }}" class="button nav__name" style="border-radius: .5rem;">Adicionar Novo Serviço</a>
            </div>
            <ul style="margin-top: 20px;">
                @foreach ($services as $service)
                    <li
                        style="border: none; margin: 10px 0px; padding: 15px 10px; border-radius: 10px; display: flex; flex-direction: row; justify-content: space-between; align-items: center; box-shadow: #ccc 0px 0px 5px;">
                        <span
                            style="margin-right: 20px; display: flex; flex-direction: row; justify-content: center; align-items: center; text-transform: capitalize;">{{ $service->name }}</span>

                        <div class="dropdown">
                            <button class="button dropdown-toggle" onclick="toggleDropdown(event)">Ações</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('services.edit', $service->id) }}">Editar</a>
                                <form action="{{ route('services.destroy', $service->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item"
                                        onclick="return confirm('Tem certeza que deseja excluir este Serviço?')">Excluir</button>
                                </form>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-toggle {
            background-color: #d4823a;
            /* Cor de fundo do site */
            color: #fff;
            /* Cor do texto */
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: .5rem;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            /* Sombra envolta */
            z-index: 1;
            max-width: 100%;
            /* Largura máxima igual à largura da tela */
        }

        .dropdown-item {
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-item:hover {
            background-color: #f1f1f1;
        }

        .dropdown-menu.show {
            display: block;
        }
    </style>

    <script>
        function toggleDropdown(event) {
            var dropdownMenu = event.currentTarget.nextElementSibling;
            dropdownMenu.classList.toggle('show');
        }

        window.onclick = function(event) {
            if (!event.target.matches('.dropdown-toggle')) {
                var dropdownMenus = document.getElementsByClassName("dropdown-menu");
                for (var i = 0; i < dropdownMenus.length; i++) {
                    var openDropdown = dropdownMenus[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>

@endsection
