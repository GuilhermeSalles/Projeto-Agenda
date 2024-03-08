@extends('layouts.master')

@section('title', 'Página Inicial')

@section('content')

<style>
.scheduling-form{

}


.scheduling-form hr{
    display: block;
    margin: 20px 0px;
}

.scheduling-form, .scheduling-form input, .scheduling-form select{
    font-size: 2vw;
}

.scheduling-form .button{
    margin-top: 40px;
}
</style>


<!--==================== WHO ====================-->
<section class="who section" id="who">
<span class="section__subtitle">Agendar</span>
<h2 class="section__title"> Agora preencha os dados para marcar seu horario!!</h2>


<div class="container">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


    <form class="scheduling-form" method="POST" action="{{ route('scheduling.store') }}">
        @csrf
        <label class="popular__name" for="name">Seu nome: </label>
        <input type="text" name="name" id="name" value="Natã Coimbra">
        <br> 
        <label class="popular__name" for="phone">Telefone: </label>
        <input type="text" name="phone" id="phone" value="(19) 98175-5678">

        <hr>

        <label class="popular__name" for="pro">Profissional: </label>
        <select id="pro" name="pro">
            <option value="0">Marcos</option>
            <option value="1" selected="true">Carlos</option>
        </select>

        <hr>

        <label class="popular__name" for="service">Serviço: </label>
        <select id="service" name="service">
            <option value="0" selected="true">Barba</option>
            <option value="1">Cabelo</option>
            <option value="2">Sobrancelhas</option>
            <option value="3">Pezinho</option>
            <option value="4">Luzes</option>
            <option value="5">Pintura</option>
        </select>

        <hr>

        <label class="popular__name" for="date">Profissional: </label>
        <input type="date" name="date" id="date" value="2024-04-01">


        <label class="popular__name" for="time">Horário: </label>
        <input type="time" name="time" id="time" value="13:00">

        <br>

        <input class="button" type="submit" value="Agendar">
    </form>
</div>


</section>

@endsection