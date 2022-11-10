<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::select('id')->where('slug','super-usuario')->first();

        $menu1 = Menu::firstOrCreate(['nombre' => 'Dashboard','slug' => 'principal',
                                    'icono' => 'fas fa-tachometer-alt fa-fw', 'padre_id' => null,'orden' => 0
                                    ]);

        $menu2 = Menu::firstOrCreate(['nombre' => 'Sistema','slug' => 'sistema',
                                    'icono' => 'fab fa-windows fa-fw', 'padre_id' => null,'orden' => 1
                                    ])
        ;

        // $menu3 = Menu::firstOrCreate(['nombre' => 'Configuraciones','slug' => 'configuracion',
        //                             'icono' => 'fas fa-gears fa-fw', 'padre_id' => null,'orden' => 2
        // ])
        // ;

        $role1->menus()->sync([$menu1->id,$menu2->id]);
    }
}
