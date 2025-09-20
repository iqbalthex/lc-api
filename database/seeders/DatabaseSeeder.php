<?php

namespace Database\Seeders;

use App\Enum\PermissionAction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::factory()->createOne(['name' => 'Admin', 'email' => 'admi1n@example.com']);
        $user = User::factory()->create(['name' => 'User', 'email' => 'use3r@example.com']);

        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        $admin->assignRole($adminRole);
        $user->assignRole($userRole);

        foreach ($this->getPermissions() as $role => $perms) {
            /** @var Role */
            $role = $role === 'admin' ? $adminRole : $userRole;
            $permissions = [];

            foreach ($perms as $object => $actions) {
                foreach ($actions as $action) {
                    $permissions[] = Permission::create([
                        'name' => $action->getNameForModel($object),
                    ]);
                }
            }

            $role->givePermissionTo($permissions);
        }
    }

    /**
     * @return array<string, array<string, PermissionAction[]>>
     */
    private function getPermissions(): array
    {
        return [
            'admin' => [
                'document' => [
                    PermissionAction::List,
                    PermissionAction::View,
                    PermissionAction::Create,
                ],
                'user' => [
                    PermissionAction::List,
                    PermissionAction::View,
                    PermissionAction::Create,
                    PermissionAction::Update,
                ],
            ],
            'user' => [
                'document' => [
                    PermissionAction::List,
                    PermissionAction::View,
                    PermissionAction::Create,
                ],
                'user' => [
                    PermissionAction::List,
                    PermissionAction::View,
                    PermissionAction::Create,
                    PermissionAction::Update,
                ],
            ],
        ];
    }
}
