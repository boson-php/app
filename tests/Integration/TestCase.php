<?php

declare(strict_types=1);

namespace App\Tests\Integration;

use App\Tests\Integration\Stub\ApplicationTestingStub;
use Boson\Application;
use Boson\ApplicationCreateInfo;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function createApplication(ApplicationCreateInfo $info = new ApplicationCreateInfo()): Application
    {
        return new ApplicationTestingStub($info);
    }
}
