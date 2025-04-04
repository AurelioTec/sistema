<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifique se o usuário logado tem o papel de Admin ou Director
        if (Auth::check() && (Auth::user()->role == 'Admin' || Auth::user()->role == 'Diretor')) {
            return $next($request);
        }

        // Caso contrário, redirecione para uma página de erro ou acesso negado
        Alert::warning('Atenção', 'Você não tem permissão para acessar esta página.');
        return redirect()->route('page.relatorio');
    }
}
