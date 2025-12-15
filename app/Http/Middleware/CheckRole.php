<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        
        // Asumsi relasi user->role->name ada. 
        // Jika user->role_id langsung ke tabel roles, kita perlu cek relasinya.
        // Di User.php tadi ada `public function role() { return $this->belongsTo(Role::class); }`
        
        if ($user->role && strtolower($user->role->name) === strtolower($role)) {
            return $next($request);
        }

        // Jika user admin, bolehlah akses apa saja (optional, tapi requestnya spesifik role)
        if ($user->role && strtolower($user->role->name) === 'admin') {
             return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}
