<?php

namespace Kelunik\AccessControl;

class AccessControl {
    private $roles;

    public function __construct(array $roles) {
        $this->roles = $this->mapRoles($roles);
    }

    private function mapRoles(array $roles): array {
        $roleMap = [];

        foreach ($roles as $role) {
            $name = $role->getName();
            $roleMap[$name] = $role;
        }

        return $roleMap;
    }

    public function isGranted(array $roleNames, string $permission): bool {
        foreach ($roleNames as $roleName) {
            if (!isset($this->roles[$roleName])) {
                continue;
            }

            $role = $this->roles[$roleName];

            if ($role->hasPermission($permission)) {
                return true;
            }
        }

        return false;
    }
}