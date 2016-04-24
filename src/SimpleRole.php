<?php

namespace Kelunik\AccessControl;

class SimpleRole implements Role {
    private $name;
    private $permissionList;
    private $permissionLookup;

    public function __construct(string $name, array $permissions) {
        $this->name = $name;
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