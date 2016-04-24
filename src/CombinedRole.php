<?php

namespace Kelunik\AccessControl;

class CombinedRole implements Role {
    private $name;
    private $permissionList;
    private $permissionLookup;

    public function __construct(string $name, array $children, array $permissions = []) {
        $this->name = $name;

        foreach ($children as $child) {
            if (!$child instanceof Role) {
                throw new \InvalidArgumentException("All children must be instance of Kelunik\\AccessControl\\Role.");
            }
        }

        foreach ($children as $role) {
            $permissions = array_merge($permissions, $role->getPermissions());
        }

        $this->permissionList = array_unique($permissions);
        $this->permissionLookup = array_flip($this->permissionList);

        sort($this->permissionList);
    }

    public function getName(): string {
        return $this->name;
    }

    public function hasPermission(string $permission): bool {
        return isset($this->permissionLookup[$permission]);
    }

    public function getPermissions(): array {
        return $this->permissionList;
    }
}