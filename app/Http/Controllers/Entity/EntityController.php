<?php

namespace App\Http\Controllers\Entity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EntityController extends Controller
{
    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Entity/EditEntity', [
            'email' => $request->email,
            'token' => $request->route('token'),
        ]);
    }
}
