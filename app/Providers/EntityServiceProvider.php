<?php

namespace App\Providers;

use App\Actions\Entities\AssignUserToEntity;
use App\Actions\Entities\DeleteEntities;
use App\Actions\Entities\SwitchEntity;
use App\Actions\Entities\UpdateEntityInformation;
use App\Actions\Entities\UserCreateNewEntity;
use App\Contracts\Entities\AssignUserToEntityContract;
use App\Contracts\Entities\CreateNewEntityContract;
use App\Contracts\Entities\DeleteEntitiesContract;
use App\Contracts\Entities\SwitchEntityContract;
use App\Contracts\Entities\UpdateEntityContract;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class EntityServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    /**
     * All the container singletons that should be registered.
     */
    public array $singletons = [
        CreateNewEntityContract::class => UserCreateNewEntity::class,
        UpdateEntityContract::class => UpdateEntityInformation::class,
        AssignUserToEntityContract::class => AssignUserToEntity::class,
        DeleteEntitiesContract::class => DeleteEntities::class,
        SwitchEntityContract::class => SwitchEntity::class,
    ];

    /**
     * Get the services provided by the provider.
     *
     * @return array<int, string>
     */
    public function provides(): array
    {
        return [
            CreateNewEntityContract::class,
            UpdateEntityContract::class,
            AssignUserToEntityContract::class,
            DeleteEntitiesContract::class,
            SwitchEntityContract::class,
        ];
    }
}
