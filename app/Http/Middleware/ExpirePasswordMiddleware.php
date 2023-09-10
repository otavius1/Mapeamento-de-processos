<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\ResetsUserPasswords;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Closure;

class ExpirePasswordMiddleware
{
    /**
     * Manipula a requisição verificando se a senha do usuário expirou e toma ações apropriadas.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Verifica se o usuário está autenticado
        if (Auth::check()) {
            $user = Auth::user();

            // Verifica se a senha expirou e precisa ser redefinida
            if ($user->password_expiry && $user->password_expiry < Carbon::now()) {
                // Desfaz o login do usuário
                Auth::logout();

                // Cria um novo token de redefinição de senha
                $token = app('auth.password.broker')->createToken($user);

                // Redireciona para a página de redefinição de senha com uma mensagem de senha expirada
                return redirect()
                    ->route('password.reset', ['token' => $token, 'email' => $user->email]) 
                    ->with('password_expired', 'Sua senha expirou. Por favor, defina uma nova senha.');
            }
        }

        // Permite a continuação da requisição
        return $next($request);
    }
}
