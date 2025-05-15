<?php declare(strict_types=1);

namespace AlanVdb\Server\Factory;

use AlanVdb\Server\Definition\ServerEnvironmentFactoryInterface;
use AlanVdb\Server\Definition\ServerEnvironmentInterface;
use AlanVdb\Server\ServerEnvironment;

class ServerEnvironmentFactory implements ServerEnvironmentFactoryInterface
{
    public function create(array $variables = []) : ServerEnvironmentInterface
    {
        return new ServerEnvironment($variables);
    }
}
