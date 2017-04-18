<?php declare(strict_types=1);
namespace Fury\Example;

use PHPUnit\Framework\TestCase;

class FileTest extends TestCase
{
    public function testWorksOnExistingFile()
    {
        $file = new File(__DIR__ . '/fixtures/some-dir/some-file.txt');
        $this->assertTrue($file->exists());
    }

    public function testWorksOnSymlinkedFile()
    {
        $file = new File(__DIR__ . '/fixtures/some-dir/some-other-file.txt');
        $this->assertTrue($file->exists());
    }

    public function testThrowsExceptionIfPathIsASymlinkedDirectory()
    {
        $this->expectException(NotAFileException::class);
        new File(__DIR__ . '/fixtures/some-dir/some-other-dir');
    }

}
