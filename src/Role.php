<?php

namespace Kelunik\AccessControl;

interface Role {
    public function getName(): string;
    public function hasPermission(string $permission): bool;
    public function getPermissions(): array;
}