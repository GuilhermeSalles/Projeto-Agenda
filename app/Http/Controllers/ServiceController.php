<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Listagem de todos os serviços
        $services = Service::all();
        //return view('admin.services', compact('services'));
        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Exibir o formulário de criação de serviço
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar os dados do formulário
        $request->validate([
            'name' => 'required|string',
            'duration' => 'nullable|numeric',
            'value' => 'nullable|numeric',
        ]);

        // Criar um novo serviço
        Service::create($request->all());

        // Redirecionar para a página de listagem de serviços
        return redirect()->route('services.all');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Buscar o serviço pelo ID
        $service = Service::findOrFail($id);
        
        // Exibir o formulário de edição do serviço
        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validar os dados do formulário
        $request->validate([
            'name' => 'required|string',
            'duration' => 'nullable|numeric',
            'value' => 'nullable|numeric',
        ]);

        // Buscar o serviço pelo ID
        $service = Service::findOrFail($id);

        // Atualizar os dados do serviço
        $service->update($request->all());

        // Redirecionar para a página de listagem de serviços
        return redirect()->route('services.all');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Buscar o serviço pelo ID
        $service = Service::findOrFail($id);

        // Excluir o serviço
        $service->delete();

        // Redirecionar para a página de listagem de serviços
        return redirect()->route('services.all');
    }

}
