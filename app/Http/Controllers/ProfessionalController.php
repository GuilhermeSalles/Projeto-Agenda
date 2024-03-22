<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professional;

class ProfessionalController extends Controller
{
    /**
     * Exibe uma lista de profissionais.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professionals = Professional::all();
        return view('professionals.index', compact('professionals'));
    }

    /**
     * Exibe o formulário para criar um novo profissional.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('professionals.create');
    }

    /**
     * Armazena um novo profissional no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Professional::create($request->all());

        return redirect()->route('professionals.all')->with('success', 'Profissional criado com sucesso!');
    }

    /**
     * Exibe os detalhes de um profissional específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $professional = Professional::findOrFail($id);
        return view('professionals.show', compact('professional'));
    }

    /**
     * Exibe o formulário para editar um profissional específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $professional = Professional::findOrFail($id);
        return view('professionals.edit', compact('professional'));
    }

    /**
     * Atualiza os detalhes de um profissional específico no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $professional = Professional::findOrFail($id);
        $professional->update($request->all());

        return redirect()->route('professionals.show', $professional->id)->with('success', 'Detalhes do profissional atualizados com sucesso!');
    }

    /**
     * Remove um profissional específico do banco de dados.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $professional = Professional::findOrFail($id);
    
        // Excluir todas as schedulings relacionadas a este profissional
        $professional->workingHours()->delete();
    
        // Em seguida, exclua o profissional
        $professional->delete();
    
        return redirect()->route('professionals.index')->with('success', 'Profissional excluído com sucesso!');
    }

}
