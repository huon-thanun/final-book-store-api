<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Closure;

class CheckApiRole
{
    public function handle(Request $request, Closure $next, string $roleName): Response
    {
        if (!auth()->check() || auth()->user()->role->name !== $roleName) {
            return response()->json([
                'status' => 'error',
                'message' => 'សុំទោស! មានតែអ្នកដែលមានតួនាទីជា ' . $roleName . ' ទេ ទើបអាចប្រើមុខងារនេះបាន!'
            ], 403);
        }

        return $next($request);
    }
}
