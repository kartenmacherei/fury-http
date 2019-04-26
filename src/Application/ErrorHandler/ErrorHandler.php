<?php

declare(strict_types=1);
namespace Fury\Application;

use Throwable;

abstract class ErrorHandler
{
    /**
     * @codeCoverageIgnore
     */
    public function register(): void
    {
        error_reporting(-1);
        ini_set('display_errors', 'false');
        class_exists(ErrorException::class, true);
        set_error_handler([$this, 'handleError']);
        set_exception_handler([$this, 'handleException']);
        register_shutdown_function([$this, 'handleShutdown']);
    }

    /**
     * @param int $errorNumber
     * @param string $errorMessage
     * @param string $errorFile
     * @param int $errorLine
     *
     * @throws ErrorException
     */
    public function handleError(int $errorNumber, string $errorMessage, string $errorFile, int $errorLine): void
    {
        throw new ErrorException($errorMessage, $errorNumber, 0, $errorFile, $errorLine);
    }

    /**
     * @param Throwable $throwable
     */
    abstract public function handleException(Throwable $throwable): void;

    /**
     * @codeCoverageIgnore
     */
    public function handleShutdown(): void
    {
        $error = error_get_last();

        if ($error === null) {
            return;
        }

        $this->handleException(
            new ErrorException($error['message'], $error['type'], 0, $error['file'], $error['line'])
        );
    }

    /**
     * @codeCoverageIgnore
     *
     * @param string $output
     */
    protected function terminate(string $output): void
    {
        http_response_code(500);
        die($output);
    }
}
