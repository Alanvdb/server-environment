# PHP Server Environment

A PHP library for managing environment variables with strict type checking and comprehensive error handling.

## Features

- Secure environment variable management
- Strict type enforcement
- Immutable system environment variables
- Easy-to-use interface for retrieving environment variables
- Comprehensive exception handling

## Installation

Install via Composer:

```bash
composer require alanvdb/server-environment
```

## Usage

### Basic Usage

```php
use AlanVdb\Server\ServerEnvironment;

// Create an environment with optional initial variables
$env = new ServerEnvironment([
    'APP_DEBUG' => 'true',
    'APP_ENV' => 'development'
]);

// Retrieve an environment variable
$debugMode = $env->get('APP_DEBUG'); // returns 'true'

// Check if a variable exists
$hasEnv = $env->has('APP_ENV'); // returns true
```

### Error Handling

```php
use AlanVdb\Server\Exception\EnvironmentVariableNotFound;
use AlanVdb\Server\Exception\CannotMutateEnvironmentVariable;

try {
    // Attempting to get a non-existent variable will throw an exception
    $value = $env->get('NON_EXISTENT_VAR');
} catch (EnvironmentVariableNotFound $e) {
    // Handle missing variable
}

try {
    // Attempting to modify a system environment variable will throw an exception
    $env = new ServerEnvironment(['PATH' => '/custom/path']);
} catch (CannotMutateEnvironmentVariable $e) {
    // Handle mutation attempt
}
```

## Factory

```php
use AlanVdb\Server\ServerEnvironmentFactory;

$factory = new ServerEnvironmentFactory();
$env = $factory->create([
    'APP_DEBUG' => 'true',
    'APP_ENV' => 'development'
]);
```

## Requirements

- PHP 8.2+
- Composer

## Key Design Principles

- Immutability of system environment variables
- Type safety
- Clear and descriptive exceptions
- Easy integration with existing PHP projects

## License

[MIT License](LICENSE)