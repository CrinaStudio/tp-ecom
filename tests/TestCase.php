<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{

    public function createApplication()
    {
        $app = require __DIR__ . '/../app/bootstrap/app.php';
        $app->make(Kernel::class)->bootstrap();
        return $app;
    }

}
