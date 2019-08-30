<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'student-list',
            'student-create',
            'student-edit',
            'student-delete',
            'subject-list',
            'subject-create',
            'subject-edit',
            'subject-delete'
        ];
        foreach ($permissions as $permission){
            \Spatie\Permission\Models\Permission::create(['name' => $permission]);
        }
    }
}
