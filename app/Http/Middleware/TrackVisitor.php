<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visitor;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jalankan request halaman terlebih dahulu
        $response = $next($request);

        // Jangan catat jika yang dibuka adalah file aset (css, js, gambar) atau permintaan AJAX
        if (!$request->is('storage/*') && !$request->ajax()) {
            Visitor::create([
                'ip_address'  => $request->ip(),
                'url_visited' => $request->fullUrl(),
                'user_agent'  => $request->userAgent(),
                'user_id'     => Auth::check() ? Auth::id() : null,
            ]);
        }

        return $response;
    }
}