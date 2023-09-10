<?php

namespace App\Http\Controllers\Site;

use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController as FortifyAuthenticatedSessionController;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class PasswordExpiryController extends FortifyAuthenticatedSessionController
{

    /**
     * Exibe o formulário de redefinição de senha.
     *
     * @param  string  $token
     * @param  string  $email
     * @return \Illuminate\View\View
     */
    public function showResetForm($token, $email)
    {
        // Retorna a view para redefinição de senha, passando o token, o email e o request como dados
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $email,
            'request' => request(), // Passa o objeto $request para a visualização
        ]);
    }

    public function store(LoginRequest $request)
    {
        // Obter o usuário com base no email fornecido no formulário de login
        $user = User::where('email', $request->email)->first();

        // Verificar se a senha expirou
        if ($user && $user->password_expiry && Carbon::now()->gte($user->password_expiry)) {
            // Gerar um novo token de redefinição de senha
            $token = app('auth.password.broker')->createToken($user);

            // Redirecionar o usuário para a página de redefinição de senha
            return redirect()->route('password.reset', ['token' => $token, 'email' => $request->email]);
        }

        // Chama o método "store" na classe pai para tratar a autenticação da sessão
        return parent::store($request);
    }

    // ...
}
