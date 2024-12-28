<?php

namespace App\Http\Controllers\Entity;

use App\Http\Controllers\Controller;
use App\Models\Entity;
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

    public function update(Request $request): Response
    {
        return Inertia::render('Entity/UpdateEntity', [
            'email' => $request->email,
            'token' => $request->route('token'),
        ]);
    }

    public function switch(Request $request, Entity $entity): \Symfony\Component\HttpFoundation\Response
    {
        $user = $request->user();

        $user->current_entity_id = $entity->id;
        $user->save();

//        $request->session()->previousUrl();

//        return redirect($request->session()->previousUrl())->with('status', 'Current entity updated.');

        return back()->with('status', 'Current entity updated.');
//        return Inertia::location($request->session()->previousUrl());
    }
}
