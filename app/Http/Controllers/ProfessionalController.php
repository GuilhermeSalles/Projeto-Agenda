<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professional;

use App\Models\Service;


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
        $services = $professional->specializations;
        $services = Service::whereIn('id', $services)->get();
        $professional->services = $services;
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
        // Obtenha os IDs dos serviços especializados do profissional
$serviceIds = $professional->specializations;

// Agora você pode buscar os serviços correspondentes aos IDs
$proServices = Service::whereIn('id', $serviceIds)->get();

        $services = Service::all();
        return view('professionals.edit', compact('professional', 'services', 'proServices'));
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
        // Valide os dados recebidos do formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'services' => 'nullable|array', // Permitir que o campo seja um array
        ]);
    
        // Busque o profissional pelo ID
        $professional = Professional::findOrFail($id);
    
        // Atualize o nome do profissional
        $professional->name = $request->input('name');
    
        // Verifique se o campo "services" está presente no request
        if ($request->has('services')) {
            // Se sim, atualize a coluna "specializations" com os serviços selecionados
            $professional->specializations = json_encode($request->input('services'));
        } else {
            // Se não, defina a coluna "specializations" como nula
            $professional->specializations = null;
        }
    
        // Salve as alterações no banco de dados
        $professional->save();
    
        // Redirecione para a página de detalhes do profissional com uma mensagem de sucesso
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
