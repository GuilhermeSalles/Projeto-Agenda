<!-- resources/views/services/index.blade.php -->

@extends('admin.master')
@extends('admin.get-status-form')

@section('title', 'Services')

@section('content')

<br>
<div class="container">
    <div class="section">
        <div class="content">
            <h2>SERVICES</h2>
        </div>
    </div>
</div>


<div class="container">
    <div class="section">
        
            <a href="{{ route('services.create') }}">Novo Serviço</a>

            <ul>
                @foreach ($services as $service)
                    <li>{{ $service->name }} - <a href="{{ route('services.edit', $service->id) }}">Editar</a> | 
                        <form action="{{ route('services.destroy', $service->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Excluir</button>
                        </form>
                    </li>
                @endforeach
            </ul>
   
     
    </div>
</div>

@endsection
