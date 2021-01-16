<?php

namespace Modules\Backend\Providers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Backend';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'backend';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerSystemConfiguration();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }


    protected function registerSystemConfiguration()
    {
        View::composer('backend::*', function ($view) {
            $routePrefix = Request::route()->getAction('routePrefix');
            $view->with([
                'routePrefix' => $routePrefix,
                'host' => request()->getHttpHost()
            ]);
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
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

    private function registerAppMenus()
    {
        $appMenus = new Collection();
        if (Schema::hasTable('menu_lists')) {
            $items = Cache::rememberForever('users', function () {
                return DB::select($this->getCteQuery());
            });
            $appMenus = Collection::make($items);
        }
        View::composer('backend::*', function ($view) use ($appMenus) {
            $view->with(['appMenus' => $appMenus]);
        });

    }

    private function getCteQuery(): string
    {
        return "
        WITH RECURSIVE menu_items
                   AS
                   (
                       (SELECT menu_lists.name,
                               menu_lists.id,
                               menu_lists.parent_id,
                               menu_lists.icon,
                               menu_lists.href,
                               menu_lists.sequence,
                               menu_lists.menu_id,
                               menu_lists.type,
                               m.name as menu_position,
                               menu_lists.permission
                        FROM menu_lists
                                 join menus m on m.id = menu_lists.menu_id
                        WHERE menu_lists.parent_id IS NULL

                       )
                       UNION ALL
                       (SELECT ml.name,
                               ml.id,
                               ml.parent_id,
                               ml.icon,
                               ml.href,
                               ml.sequence,
                               ml.menu_id,
                               ml.type,
                               m2.name           as menu_position,
                               ml.permission
                        FROM menu_items AS mi
                                 JOIN menu_lists AS ml
                                      ON mi.id = ml.parent_id
                                 join menus m2 on m2.id = ml.menu_id
                       )
                   )
            Select *
            from menu_items

        ";
    }
}
