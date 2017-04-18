<?php declare(strict_types=1);
namespace Fury\ErrorHandler;

use Fury\Exception\ErrorException;
use Throwable;

abstract class ErrorHandler
{
    /**
     * @codeCoverageIgnore
     */
    public function register()
    {
        error_reporting(-1);
        ini_set('display_errors', false);
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
    public function handleError(int $errorNumber, string $errorMessage, string $errorFile, int $errorLine)
    {
        throw new ErrorException($errorMessage, $errorNumber, 0, $errorFile, $errorLine);
    }

    /**
     * @param Throwable $throwable
     */
    abstract public function handleException(Throwable $throwable);

    /**
     * @codeCoverageIgnore
     */
    public function handleShutdown()
    {
        $error = error_get_last();

        if ($error === null) { return; }

        $this->handleException(
            new ErrorException($error['message'], $error['type'], 0, $error['file'], $error['line'])
        );
    }

    /**
     * @codeCoverageIgnore
     *
     * @param string $output
     */
    protected function terminate(string $output)
    {
        http_response_code(500);
        die($output);
    }
}
