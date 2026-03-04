<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        Permission::create(['name' => 'add player notes']);
        Permission::create(['name' => 'view player notes']);

        $agentRole = Role::create(['name' => 'support-agent']);
        $agentRole->givePermissionTo(['add player notes', 'view player notes']);
    }
}
