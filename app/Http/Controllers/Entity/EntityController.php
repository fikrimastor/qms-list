<?php

namespace App\Http\Controllers\Entity;

use App\Contracts\Entities\DeleteEntitiesContract;
use App\Contracts\Entities\SwitchEntityContract;
use App\Contracts\Entities\UpdateEntityContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Entity\UpdateEntityRequest;
use App\Models\Entity;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\{RedirectResponse, Request, Response as ResponseAlias};
use Inertia\Inertia;
use Inertia\Response;

class EntityController extends Controller
{
    /**
     * Handle display edit entity view.
     *
     * @throws AuthorizationException
     * @param  Request  $request
     * @return Response
     */
    public function edit(Request $request): Response
    {
        $user = $request->user();
        $entity = $user->currentEntity;

        abort_if($user->cannot('update', $entity), ResponseAlias::HTTP_FORBIDDEN);

        return Inertia::render('Entity/Edit', [
            'currentEntity' => Inertia::always(fn () => $entity),
            'title' => __('entity.edit_entity'),
        ]);
    }

    /**
     * Handle update entity request.
     *
     * @param  UpdateEntityRequest  $request
     * @param  Entity  $entity
     * @param  UpdateEntityContract  $executor
     * @return RedirectResponse
     */
    public function update(UpdateEntityRequest $request, Entity $entity, UpdateEntityContract $executor): RedirectResponse
    {
        abort_if($request->user()->cannot('update', $entity), ResponseAlias::HTTP_FORBIDDEN);

        $executor->execute($entity->id, $request->validated());

        return back();
    }

    /**
     * Handle switch entity request.
     *
     * @param  Request  $request
     * @param  Entity  $entity
     * @param  SwitchEntityContract  $executor
     * @return RedirectResponse
     */
    public function switch(Request $request, Entity $entity, SwitchEntityContract $executor): RedirectResponse
    {
        abort_if($request->user()->cannot('view', $entity), ResponseAlias::HTTP_FORBIDDEN);

        $executor->execute($request->user(), $entity->id);

        return redirect()->route('entity.edit', compact('entity'));
    }

    /**
     * Handle delete entity request.
     *
     * @param  Request  $request
     * @param  Entity  $entity
     * @param  DeleteEntitiesContract  $executor
     * @return RedirectResponse
     */
    public function destroy(Request $request, Entity $entity, DeleteEntitiesContract $executor): RedirectResponse
    {
        abort_if($request->user()->cannot('delete', $entity), ResponseAlias::HTTP_FORBIDDEN);

        $executor->execute($entity->id);

        return to_route('dashboard');
    }
}
