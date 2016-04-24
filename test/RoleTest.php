<?php

namespace Kelunik\AccessControl;

abstract class RoleTest extends \PHPUnit_Framework_TestCase {
    /** @var Role */
    protected $role;

    protected abstract function setUpRole();

    protected function setUp() {
        $this->setUpRole();
    }

    /**
     * @dataProvider provideData
     * @param string $permission permission to check
     * @param bool   $expectation expected result
     */
    public function test(string $permission, bool $expectation) {
        $this->assertSame($expectation, $this->role->hasPermission($permission));
    }

    public function provideData() {
        return [
            ["read", true],
            ["write", true],
            ["delete", true],
            ["member", false],
            ["permission", false],
        ];
    }

    public function testPermissions() {
        $this->assertEquals([
            "delete",
            "read",
            "write",
        ], $this->role->getPermissions());
    }
}