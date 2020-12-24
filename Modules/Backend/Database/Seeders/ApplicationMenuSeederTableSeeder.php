<?php

namespace Modules\Backend\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicationMenuSeederTableSeeder extends Seeder
{

    const TITLE = 'title';
    const DROPDOWN = 'dropdown';
    const LINK = 'link';
    protected $routePrefix = 'backend';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $menus = [
            'left_sidebar' => [
                'Dashboard' => [
                    'type' => self::LINK,
                    'icon' => 'cil-speedometer',
                    'href' => '/dashboard',
                    'sequence' => 1,
                    'permission' => 'dashboard-view'
                ],
                'Send Money' => [
                    'type' => self::LINK,
                    'icon' => 'cil-money',
                    'href' => '/send-money',
                    'sequence' => 2,
                    'permission' => 'send-money-view'
                ],
                'Rates' => [
                    'type' => self::LINK,
                    'icon' => 'cil-dollar',
                    'href' => '/rates',
                    'sequence' => 3,
                    'permission' => 'rate-view'
                ],
                'Preferences' => [
                    'type' => self::TITLE,
                    'sequence' => 4
                ],
                'Users and Role' => [
                    'type' => self::DROPDOWN,
                    'icon' => 'cil-user',
                    'href' => null,
                    'sequence' => 5,
                    'children' => [
                        'Users' => [
                            'type' => self::LINK,
                            'href' => '/users',
                            'sequence' => 1,
                            'permission' => 'user-view'
                        ],
                        'Roles' => [
                            'type' => self::LINK,
                            'href' => '/roles',
                            'sequence' => 2,
                            'permission' => 'role-view'
                        ]
                    ],

                ]
            ],
            'top' => [],
            'right_sidebar' => []
        ];
        DB::beginTransaction();
        foreach ($menus as $key => $menu) {
            $menu_id = DB::table('menus')->insertGetId([
                'name' => $key
            ]);

            $this->storeMenus($menu, $menu_id);
        }
        DB::commit();
    }

    protected function storeMenus($menus, $menu_id)
    {

        foreach ($menus as $k => $subMenus) {
            $parent_id = DB::table('menu_lists')
                ->insertGetId([
                    'type' => $subMenus['type'] ?? null,
                    'name' => $k,
                    'icon' => $subMenus['icon'] ?? null,
                    'permission' => $subMenus['permission'] ?? null,
                    'href' => isset($subMenus['href']) ? $this->routePrefix . $subMenus['href'] : null,
                    'menu_id' => $menu_id,
                    'parent_id' => null,
                    'sequence' => $subMenus['sequence']
                ]);
            if (isset($subMenus['children'])) {
                $this->insertMenus($subMenus['children'], $menu_id, $parent_id);
            }

        }

    }


    protected function insertMenus($menus, $menu_id, $parent_id = null)
    {

        foreach ($menus as $name => $subMenus) {
            DB::table('menu_lists')
                ->insertGetId([
                    'type' => $subMenus['type'] ?? null,
                    'name' => $name,
                    'icon' => $subMenus['icon'] ?? null,
                    'href' => isset($subMenus['href']) ? $this->routePrefix . $subMenus['href'] : null,
                    'menu_id' => $menu_id,
                    'parent_id' => $parent_id,
                    'sequence' => $subMenus['sequence'],
                    'permission' => $subMenus['permission'] ?? null,
                ]);
        }
    }


}
