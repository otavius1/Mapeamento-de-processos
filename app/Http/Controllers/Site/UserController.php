<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Mostra a lista de usuários do sistema
     */
    public function index()
    {
        $users = User::take(20)->get();
        return view ('site.usuarios.index', compact ('users'));
    }

    /**
     * Retorna a view de registro
     */
    public function create()
    {
        return view('/register');
    }

    /**
     * Faz buscas no BD de acordo com os parâmetros passados na caixa de pesquisa
     */
    public function search(Request $request)
    {
        $parameter = $request->input('parameter');
        $users = User::where('name', 'like', "%$parameter%")
            ->orWhere('email', 'like', "%$parameter%")
            ->get();

        return view('site.usuarios.index', compact('users'));
    }

    public function resetpass ()
    {
        return view('auth/forgot-password');
    }



    /**
     * Busca o formulário de cadastro do usuário com os dados cadastrados
     */
    public function edit($id)
    {
        $users = User::findOrFail($id);
    
        if (!$users) {
            toastr()->error('Usuário não encontrado.', 'Erro');
            return redirect()->route('site.user');
        }
    
        return view('site.usuarios.edit', compact('users'));
    }

    /**
     * Atualiza dos dados no BD
     */
    public function update(Request $request, string $id)
    {
        $users = User::find($id);

        $validatedData = $request->validate([
            'password' => 'min:8',
        ]);

        //Atualizações dos dados no banco de dados
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->password = bcrypt($validatedData['password']);

        $users->save();

        toastr()->success('Usuário atualizado com sucesso!', 'Parabéns');
        return view('site.usuarios.update', compact('users'));
    }

    // /**
    //  * Remove registros do BD
    //  */
    public function destroy(string $id)
    {
        $users = User::find($id);
    
        if (!$users) {
            toastr()->error('Usuário não encontrado.', 'Erro');
            return redirect()->route('site.usuarios');
        }
    
        $users->delete();
        
        toastr()->info('Usuário excluído com sucesso!', 'Informação');
        return redirect()->route('site.usuarios');
    }
}
