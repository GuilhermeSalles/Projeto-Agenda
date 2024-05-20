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
    <div class="section">
        
        <a href="{{ route('professionals.create') }}" class="button nav__name">Criar Profissional - Novo</a>
            <ul>
                @foreach($professionals as $professional)
                    <li style="border: none; margin: 10px 0px; padding: 15px 10px; border-radius: 3px; display: flex; flex-direction: row; justify-content: space-between; align-items: center; box-shadow: #ccc 0px 0px 5px;">
                        <span style="margin-right: 20px; display: flex; flex-direction: row; justify-content: center; align-items: center; text-transform: capitalize;">{{ $professional->name }}</span>
                        
                        <div style="">
                        <a href="{{ route('professionals.show', $professional->id ) }}" class="button see-button">Ver</a>

                            <a href="{{ route('professionals.edit', $professional->id ) }}" class="button edit-button">Editar</a>
                            <form action="{{ route('professionals.destroy', $professional->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="button btn btn-danger">Excluir</button>
            </form>
                        </div>
                    </li>    
                @endforeach
            </ul>
       
    </div>
</div>

@endsection