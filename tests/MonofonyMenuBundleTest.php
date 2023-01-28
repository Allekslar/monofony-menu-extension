<?php

namespace Allekslar\MonofonyMenuBundle\Tests;

use Allekslar\MonofonyMenuBundle\MonofonyMenuBundle;
use PHPUnit\Framework\TestCase;

class MonofonyMenuBundleTest extends TestCase
{
    public function testGetPath(): void
    {
        $this->assertSame(\dirname(__DIR__), (new MonofonyMenuBundle())->getPath());
    }
}
