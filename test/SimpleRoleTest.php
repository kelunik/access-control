<?php

namespace Kelunik\AccessControl;

class SimpleRoleTest extends RoleTest {
    protected function setUpRole() {
        $this->role = new SimpleRole("guest", [
            "read",
            "write",
            "delete",
        ]);
    }

    public function testName() {
        $this->assertSame("guest", $this->role->getName());
    }
}