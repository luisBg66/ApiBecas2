<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Role;
Use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   
    public function run(): void
    {
        $Precidente = Role::create(['name' => 'Precidente']);
        $usurcomite = Role::create(['name' => 'usurcomite']);
        $usuario = Role::create(['name' => 'Usuario']);

        Permission::create(['name' => 'CrearEliminar'])->syncRoles([$Precidente]);
        Permission::create(['name' => 'Modificar registros'])->syncRoles([$Precidente, $usurcomite]);
        Permission::create(['name' => 'Ver registros'])->syncRoles([$usuario, $usurcomite, $Precidente]);
    }
    
}
