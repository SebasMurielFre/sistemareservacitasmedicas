<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        //seeder para roles y permisos - admin, secretaria, doctor, paciente, usuario
        $admin = Role::create(['name'=>'admin']);
        $secretaria = Role::create(['name'=>'secretaria']);
        $doctor = Role::create(['name'=>'doctor']);
        $paciente = Role::create(['name'=>'paciente']);
        $usuario = Role::create(['name'=>'usuario']);

        // Permisos generales
        Permission::create(['name'=>'admin.index']);

        // Permisos para admin-usuarios
        Permission::create(['name'=>'admin.usuarios.index'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.usuarios.create'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.usuarios.store'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.usuarios.show'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.usuarios.edit'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.usuarios.update'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.usuarios.confirmDelete'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.usuarios.destroy'])->syncRoles([$admin]);

        // Permisos para admin-secretarias
        Permission::create(['name'=>'admin.secretarias.index'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.secretarias.create'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.secretarias.store'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.secretarias.show'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.secretarias.edit'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.secretarias.update'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.secretarias.confirmDelete'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.secretarias.destroy'])->syncRoles([$admin]);

        // Permisos para admin-pacientes
        Permission::create(['name'=>'admin.pacientes.index'])->syncRoles([$admin, $secretaria, $doctor]);
        Permission::create(['name'=>'admin.pacientes.create'])->syncRoles([$admin, $secretaria, $doctor]);
        Permission::create(['name'=>'admin.pacientes.store'])->syncRoles([$admin, $secretaria, $doctor]);
        Permission::create(['name'=>'admin.pacientes.show'])->syncRoles([$admin, $secretaria, $doctor]);
        Permission::create(['name'=>'admin.pacientes.edit'])->syncRoles([$admin, $secretaria, $doctor]);
        Permission::create(['name'=>'admin.pacientes.update'])->syncRoles([$admin, $secretaria, $doctor]);
        Permission::create(['name'=>'admin.pacientes.confirmDelete'])->syncRoles([$admin, $secretaria,$doctor]);
        Permission::create(['name'=>'admin.pacientes.destroy'])->syncRoles([$admin, $secretaria, $doctor]);

        // Permisos para admin-consultorios
        Permission::create(['name'=>'admin.consultorios.index'])->syncRoles([$admin, $secretaria, $doctor]);
        Permission::create(['name'=>'admin.consultorios.create'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.consultorios.store'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.consultorios.show'])->syncRoles([$admin, $secretaria, $doctor]);
        Permission::create(['name'=>'admin.consultorios.edit'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.consultorios.update'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.consultorios.confirmDelete'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.consultorios.destroy'])->syncRoles([$admin]);

        // Permisos para admin-doctores
        Permission::create(['name'=>'admin.doctores.index'])->syncRoles([$admin, $secretaria, $doctor]);
        Permission::create(['name'=>'admin.doctores.create'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.doctores.store'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.doctores.show'])->syncRoles([$admin, $secretaria, $doctor]);
        Permission::create(['name'=>'admin.doctores.edit'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.doctores.update'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.doctores.confirmDelete'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.doctores.destroy'])->syncRoles([$admin]);

        // Permisos para admin-horarios
        Permission::create(['name'=>'admin.horarios.index'])->syncRoles([$admin, $secretaria, $doctor]);
        Permission::create(['name'=>'admin.horarios.tabla_horario_doctor'])->syncRoles([$admin, $secretaria, $doctor]);
        Permission::create(['name'=>'admin.horarios.tabla_horario_consultorio'])->syncRoles([$admin, $secretaria, $doctor]);
        Permission::create(['name'=>'admin.horarios.create'])->syncRoles([$admin, $secretaria, $doctor]);
        Permission::create(['name'=>'admin.horarios.store'])->syncRoles([$admin, $secretaria, $doctor]);
        Permission::create(['name'=>'admin.horarios.show'])->syncRoles([$admin, $secretaria, $doctor]);
        Permission::create(['name'=>'admin.horarios.edit'])->syncRoles([$admin, $secretaria, $doctor]);
        Permission::create(['name'=>'admin.horarios.update'])->syncRoles([$admin, $secretaria, $doctor]);
        Permission::create(['name'=>'admin.horarios.confirmDelete'])->syncRoles([$admin, $secretaria, $doctor]);
        Permission::create(['name'=>'admin.horarios.destroy'])->syncRoles([$admin, $secretaria, $doctor]);
    }
}
