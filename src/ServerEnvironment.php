<?php declare(strict_types=1);

namespace AlanVdb\Server;

use AlanVdb\Server\Definition\ServerEnvironmentInterface;
use AlanVdb\Server\Exception\InvalidServerEnvironmentParamProvided;
use AlanVdb\Server\Exception\CannotMutateEnvironmentVariable;
use AlanVdb\Server\Exception\EnvironmentVariableNotFound;

class ServerEnvironment implements ServerEnvironmentInterface
{
    /**
     * @var array<string, string>
     */
    protected array $variables = [];

    /**
     * @param array<string, string> $variables Initial environment variables
     * @throws InvalidServerEnvironmentParamProvided
     */
    public function __construct(array $variables = [])
    {
        $this->variables = array_merge($_ENV, $_SERVER);

        foreach($variables as $key => $value) {
            if (
                (array_key_exists($key, $_ENV) && $_ENV[$key] !== $value)
                || (array_key_exists($key, $_SERVER) && $_SERVER[$key] !== $value)
            ) {
                throw new CannotMutateEnvironmentVariable("$key mutation is not allowed.");
            }
            $this->variables[$key] = $value;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $key): string
    {
        if (!$this->has($key)) {
            throw new EnvironmentVariableNotFound(
                sprintf('Environment variable "%s" not found', $key)
            );
        }
        return $this->variables[$key];
    }

    /**
     * {@inheritdoc}
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->variables);
    }
}
