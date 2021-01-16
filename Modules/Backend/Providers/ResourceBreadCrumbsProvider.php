<?php

namespace Modules\Backend\Providers;

use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Support\ServiceProvider;

class ResourceBreadCrumbsProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        Breadcrumbs::macro('resource', function ($name, $title) {
            // Home > Blog
//            $route = 'admin.' . $name;
            Breadcrumbs::for("$name.index", function ($trail) use ($name, $title) {
                $trail->parent('dashboard');
                $trail->push($title, route("$name.index"));
            });

            // Home > Blog > New
            Breadcrumbs::for("$name.create", function ($trail) use ($name) {
                $trail->parent("$name.index");
                $trail->push('New', route("$name.create"));
            });

            // Home > Blog > Post 123
            Breadcrumbs::for("$name.show", function ($trail, $model) use ($name) {
                $trail->parent("$name.index");
                $trail->push('Show', route("$name.show", $model->id));
            });

            // Home > Blog > Post 123 > Edit
            Breadcrumbs::for("$name.edit", function ($trail, $model) use ($name) {
                $trail->parent("$name.show", $model);
                $trail->push('Edit', route("$name.edit", $model));
            });
        });

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [];
    }
}
