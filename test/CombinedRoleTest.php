<?php

namespace Kelunik\AccessControl;

class CombinedRoleTest extends RoleTest {
    protected function setUpRole() {
        $this->role = new CombinedRole("admin", [
            new SimpleRole("guest", [
                "read",
            ]),
            new SimpleRole("member", [
                "write",
            ]),
        ], ["delete"]);
    }

    public function testName() {
        $this->assertSame("admin", $this->role->getName());
    }
}