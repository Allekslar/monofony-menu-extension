<?php

namespace Allekslar\MonofonyMenuBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MonofonyMenuBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
