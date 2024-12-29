<?php

namespace App\Http\Controllers\Entity;

use App\Contracts\Entities\CreateNewEntityContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Entity\StoreEntityRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\{RedirectResponse, Request};
use Inertia\Inertia;
use Inertia\Response;

class NewEntityController extends Controller
{
    /**
     * Display the new entity view.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        return Inertia::render('Entity/CreateEntity', [
            'message' => session('message'),
        ]);
    }

    /**
     * Handle an incoming create new entity request.
     * @throws ValidationException
     *
     * @param  StoreEntityRequest  $request
     * @param  CreateNewEntityContract  $adapter
     * @return RedirectResponse
     */
    public function store(StoreEntityRequest $request, CreateNewEntityContract $adapter): RedirectResponse
    {
        $validated = $request->validated();

        $entity = $adapter->execute($request->user(), $validated);

        return to_route('entity.edit', compact('entity'))->with('status', __('entity.entity_created', ['name' => $entity->name]));
    }
}
