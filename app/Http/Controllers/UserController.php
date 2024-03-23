<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Exibe uma lista de usuários.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Exibe o formulário para criar um novo usuário.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Armazena um novo usuário no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Valide os dados recebidos do formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Crie um novo usuário
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Redirecione o usuário para a página de lista de usuários
        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');
    }

    /**
     * Exibe os detalhes de um usuário específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Exibe o formulário para editar um usuário específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Atualiza os detalhes de um usuário específico no banco de dados.
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
            'email' => 'required|email|max:255',
        ]);

        // Encontre o usuário no banco de dados e atualize seus detalhes
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Redirecione o usuário para a página de detalhes do usuário atualizado
        return redirect()->route('users.show', $user->id)->with('success', 'Detalhes do usuário atualizados com sucesso!');
    }

    /**
     * Remove um usuário específico do banco de dados.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Encontre o usuário no banco de dados e exclua-o
        $user = User::findOrFail($id);
        $user->delete();

        // Redirecione o usuário de volta para a página de lista de usuários
        return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso!');
    }
}
