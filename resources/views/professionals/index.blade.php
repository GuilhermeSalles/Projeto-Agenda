@extends('admin.master')
@extends('admin.get-status-form')

@section('title', 'Profissionais')

@section('content')

    <br>
    <div class="container">
        <div class="section">
            <div class="content">
                <h2>PROFISSIONAIS</h2>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="section" style="padding: 20px; border-radius: 10px; background-color: #f8f9fa;">
            <div class="bcontainer">
                <a href="{{ route('professionals.create') }}" class="button nav__name" style="border-radius: .5rem;">Adicionar Novo Profissional</a>
            </div>
            <ul style="margin-top: 20px;">
                @foreach ($professionals as $professional)
                    <li
                        style="border: none; margin: 10px 0px; padding: 15px 10px; border-radius: 10px; display: flex; flex-direction: row; justify-content: space-between; align-items: center; box-shadow: #ccc 0px 0px 5px;">
                        <span
                            style="margin-right: 20px; display: flex; flex-direction: row; justify-content: center; align-items: center; text-transform: capitalize;">{{ $professional->name }}</span>

                        <div class="dropdown">
                            <button class=" dropdown-toggle" onclick="toggleDropdown(event)">Ações</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('professionals.show', $professional->id) }}">Ver</a>
                                <a class="dropdown-item"
                                    href="{{ route('professionals.edit', $professional->id) }}">Editar</a>
                                <form action="{{ route('professionals.destroy', $professional->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item"
                                        onclick="return confirm('Tem certeza que deseja excluir este profissional?')">Excluir</button>
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
            border-radius: .5rem;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            /* Sombra envolta */
            z-index: 1;
            max-width: 100%;
            /* Largura máxima igual à largura da tela */
        }

        .dropdown-item {
            border-radius: 5px;
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-item:hover {
            background-color: #d4823a;
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
