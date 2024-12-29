<?php

namespace App\Http\Controllers\Entity;

use App\Http\Controllers\Controller;
use App\Models\Entity;
use Illuminate\Http\RedirectResponse;
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
        return Inertia::render('Entity/Edit', [
            'currentEntity' => Inertia::always(fn () => $request->user()->currentEntity),
            'title' => __('entity.edit_entity'),
        ]);
    }

    public function update(Request $request, Entity $entity): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:entities,name,' . $entity->id,
            'description' => 'nullable|string|max:255',
        ]);

        $entity->update($validated);

        return back();
    }

    public function switch(Request $request, Entity $entity): RedirectResponse
    {
        $user = $request->user();

        $user->current_entity_id = $entity->id;
        $user->save();

        return redirect()->route('entity.edit', compact('entity'));
    }

    public function destroy(Entity $entity): RedirectResponse
    {
        $entity->delete();

        return to_route('dashboard');
    }
}
