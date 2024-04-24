<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(Request $request){
        return view('auth.login');
    }

    public function login(Request $request)
    {

        //echo "|teste";
        //exit;

        // Validação dos dados do formulário
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        // Tentativa de login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Autenticação bem-sucedida
            return redirect()->intended('/');
        } else {
            // Autenticação falhou
            return back()->with('error', 'Credenciais inválidas. Por favor, tente novamente.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Faz logout do usuário autenticado

        $request->session()->invalidate(); // Invalida a sessão

        $request->session()->regenerateToken(); // Regenera o token da sessão

        return redirect('/'); // Redireciona para a página inicial ou outra página após o logout
    }
    
    function hash($pass)
    {
        // Usando o método Hash::make() para hashizar a senha
        $hashedPassword = bcrypt($pass);
        
        return $hashedPassword;
    }

    

}
