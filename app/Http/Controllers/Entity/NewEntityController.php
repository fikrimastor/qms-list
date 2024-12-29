<?php

namespace App\Http\Controllers\Entity;

use App\Contracts\Entities\CreateNewEntityContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Entity\StoreEntityRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class NewEntityController extends Controller
{
    /**
     * Display the new entity view.
     */
    public function create(Request $request): Response
    {
        return Inertia::render('Entity/CreateEntity', [
            'message' => session('message'),
        ]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(StoreEntityRequest $request, CreateNewEntityContract $adapter): RedirectResponse
    {
        $validated = $request->validated();

        $entity = $adapter->execute($request->user(), $validated);

        return to_route('entity.edit', compact('entity'))->with('status', __('entity.entity_created', ['name' => $entity->name]));
    }
}
