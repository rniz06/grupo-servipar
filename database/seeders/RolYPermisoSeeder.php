<?php

namespace Database\Seeders;

use App\Models\Admin\Permiso;
use App\Models\Admin\Rol;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RolYPermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos = [
            'SuperAdmin',            
        ];

        foreach ($permisos as $permiso) {
            Permiso::create(['name' => $permiso]);
        }

        // CREAR USUARIO ADMINISTRADOR
        $user = User::create([
            'name' => 'Administrador',
            'usuario' => 'Administrador',
            'email' => 'ronaldalexisniznunez@gmail.com',
            'nro_cedula' => null,
            'nro_celular' => null,
            'observacion' => 'USUARIO ADMINISTRADOR DEL SISTEMA',
            'password' => Hash::make('Rann2006'),
            'activo'  => true,
            'ultimo_acceso'  => null,
        ]);

        // CREAR ROL "ADMIN"
        $role = Rol::create(['name' => 'SuperAdmin']);

        // ASIGNAR TODOS LOS PERMISOS CREADOS AL ROL "SuperAdmin"
        $permissions = Permiso::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
