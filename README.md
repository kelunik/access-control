# access-control

[![Build Status](https://img.shields.io/travis/kelunik/access-control/master.svg?style=flat-square)](https://travis-ci.org/kelunik/access-control)
[![CoverageStatus](https://img.shields.io/coveralls/kelunik/access-control/master.svg?style=flat-square)](https://coveralls.io/github/kelunik/access-control?branch=master)
![License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)

`kelunik/access-control` is a role based access control system.

## Requirements

- PHP 7.0+

## Installation

```bash
composer require kelunik/access-control
```

## Usage

```php
$guest = new SimpleRole("guest", ["read"]);
$member = new CombinedRole("member", [$guest], ["read.internal"]);
$student = new CombinedRole("student", [$guest, $member], ["write.internal"]);
$staff = new CombinedRole("staff", [$guest, $member], ["write"]);

$accessControl = new AccessControl([
    $guest, $member, $student, $staff
]);

$isAllowed = $accessControl->isGranted(["member", "staff"], "write");
```