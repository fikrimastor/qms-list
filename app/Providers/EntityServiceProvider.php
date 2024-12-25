<?php

namespace App\Providers;

use App\Actions\Users\AssignUserToEntity;
use App\Actions\Users\UpdateEntityInformation;
use App\Actions\Users\UserCreateNewEntity;
use App\Contracts\Entities\AssignUserToEntityContract;
use App\Contracts\Entities\CreateNewEntityContract;
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
        ];
    }
}
