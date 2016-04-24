<?php

namespace Kelunik\AccessControl;

class AccessControlTest extends \PHPUnit_Framework_TestCase {
    /** @var AccessControl */
    protected $accessControl;

    protected function setUp() {
        $guest = new SimpleRole("guest", ["read"]);
        $member = new CombinedRole("member", [$guest], ["write"]);

        $this->accessControl = new AccessControl([$guest, $member]);
    }

    /** @test */
    public function shouldAllowGuestToRead() {
        $this->assertTrue($this->accessControl->isGranted(["guest"], "read"));
    }

    /** @test */
    public function shouldDenyGuestToWriteAndDelete() {
        $this->assertFalse($this->accessControl->isGranted(["guest"], "write"));
        $this->assertFalse($this->accessControl->isGranted(["guest"], "delete"));
    }

    /** @test */
    public function shouldAllowMemberToReadAndWrite() {
        $this->assertTrue($this->accessControl->isGranted(["member"], "read"));
        $this->assertTrue($this->accessControl->isGranted(["member"], "write"));
    }

    /** @test */
    public function shouldDenyMemberToDelete() {
        $this->assertFalse($this->accessControl->isGranted(["member"], "delete"));
    }

    /** @test */
    public function shouldAllowGuestAndMemberToWrite() {
        $this->assertTrue($this->accessControl->isGranted(["guest", "member"], "write"));
    }

    /** @test */
    public function shouldIgnoreUnknownRoles() {
        $this->assertFalse($this->accessControl->isGranted(["foobar"], "write"));
    }
}