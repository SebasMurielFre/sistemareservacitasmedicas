<?php

namespace Database\Seeders;

use App\Models\Consultorio;
use App\Models\Doctor;
use App\Models\Paciente;
use App\Models\Secretaria;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        //llamada al seeder de roles y permisos
        $this->call([RoleSeeder::class]);

        //creación de usuario admin
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678')
        ])->assignRole('admin');

        //creación de usuario secretaria
        User::create([
            'name' => 'Secretaria 1',
            'email' => 'secretaria@admin.com',
            'password' => Hash::make('12345678')
        ])->assignRole('secretaria');

        Secretaria::create([
            'user_id' => '2',
            'nombres' => 'Secretaria',
            'apellidos' => '1',
            'dni' => '1111111111',
            'celular' => '1111111111',
            'fecha_nacimiento' => '2000-10-10',
            'direccion' => 'asdasdasd'
        ]);

        //creación de usuarios doctor
        User::create([
            'name' => 'Doctor 1',
            'email' => 'doctor1@admin.com',
            'password' => Hash::make('12345678')
        ])->assignRole('doctor');

        Doctor::create([
            'user_id' => '3',
            'nombres' => 'Doctor',
            'apellidos' => '1',
            'dni' => '2222222222',
            'licencia_medica' => '3333333333',
            'especialidad' => 'Pediatría',
            'celular' => '2222222222',
            'fecha_nacimiento' => '1999-12-05',
            'direccion' => 'asdasdasd'
        ]);

        User::create([
            'name' => 'Doctor 2',
            'email' => 'doctor2@admin.com',
            'password' => Hash::make('12345678')
        ])->assignRole('doctor');

        Doctor::create([
            'user_id' => '4',
            'nombres' => 'Doctor',
            'apellidos' => '2',
            'dni' => '3333333333',
            'licencia_medica' => '4444444444',
            'especialidad' => 'Neurología',
            'celular' => '3333333333',
            'fecha_nacimiento' => '1979-12-12',
            'direccion' => 'asdasdasd'
        ]);

        User::create([
            'name' => 'Doctor 3',
            'email' => 'doctor3@admin.com',
            'password' => Hash::make('12345678')
        ])->assignRole('doctor');

        Doctor::create([
            'user_id' => '5',
            'nombres' => 'Doctor',
            'apellidos' => '3',
            'dni' => '4444444444',
            'licencia_medica' => '5555555555',
            'especialidad' => 'Traumatismo',
            'celular' => '4444444444',
            'fecha_nacimiento' => '1988-04-20',
            'direccion' => 'asdasdasd'
        ]);

        //creación de usuario paciente
        User::create([
            'name' => 'Paciente 1',
            'email' => 'paciente1@admin.com',
            'password' => Hash::make('12345678')
        ])->assignRole('paciente');

        //creación de consultorios
        Consultorio::create([
            'nombre' => 'Laboratorio',
            'ubicacion' => 'Piso 2 - 345',
            'capacidad' => '10',
            'telefono' => '1234567890',
            'extension' => '02',
            'especialidad' => 'Laboratorio',
            'estado' => 'Activo',
            'equipamiento' => '3 máquinas',
            'descripcion' => 'Tratamiento de pruebas de sangre',
        ]);

        Consultorio::create([
            'nombre' => 'Radiología',
            'ubicacion' => 'Piso 3 - 456',
            'capacidad' => '5',
            'telefono' => '1234567891',
            'extension' => '03',
            'especialidad' => 'Radiología',
            'estado' => 'Activo',
            'equipamiento' => '2 máquinas',
            'descripcion' => 'Tratamiento de pruebas de radiología',
        ]);

        Consultorio::create([
            'nombre' => 'Urgencias',
            'ubicacion' => 'Piso 1 - 123',
            'capacidad' => '20',
            'telefono' => '1234567892',
            'extension' => '01',
            'especialidad' => 'Urgencias',
            'estado' => 'Activo',
            'equipamiento' => '5 camas',
            'descripcion' => 'Tratamiento de emergencias',
        ]);

        //creación de usuario
        User::create([
            'name' => 'Usuario1',
            'email' => 'usuario1@admin.com',
            'password' => Hash::make('12345678')
        ])->assignRole('usuario');

        //llamada al seeder de pacientes
        $this->call([PacienteSeeder::class]);
    }
}
