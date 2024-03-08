<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Services;
use App\Models\Workers;
use App\Models\Scheduling;



class SchedulingController extends Controller
{
    public function index(Request $request){
        
        $workers = Workers::all();
        $services = Services::all();
        $schedulings = Scheduling::all();

        return view('scheduling.index', compact('workers', 'services', 'schedulings'));
    }


    public function create(){
        return view('scheduling.create');
    }


    public function store(Request $request)
    {

         
        // Valide os dados recebidos do formulário
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'pro' => 'required|integer',
            'service' => 'required|integer',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

            // Verificar se há erros de validação
            if ($validatedData instanceof \Illuminate\Contracts\Validation\Validator && $validatedData->fails()) {
                // Dados inválidos, notifique o usuário do erro
                return redirect()->back()->withErrors($validatedData)->withInput();
            } else {
                // Dados válidos, continue com o processamento
                // Por exemplo, salve os dados no banco de dados
            }

        // Crie um novo agendamento com os dados validados
        $scheduling = new Scheduling();
        $scheduling->name = $validatedData['name'];
        $scheduling->phone = $validatedData['phone'];
        $scheduling->pro = $validatedData['pro'];
        $scheduling->service_id = $validatedData['service'];
        $scheduling->date = $validatedData['date'];
        $scheduling->time = $validatedData['time'];
        
        // Salve o agendamento no banco de dados
        $scheduling->save();

        // Redirecione de volta para a página de origem com uma mensagem de sucesso
        return redirect()->back()->with('success', 'Agendamento criado com sucesso!');
        //return view('scheduling.create');

    }
}
