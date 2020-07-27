<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTest\Http;

use Kartenmacherei\HttpFramework\Http\Domain;
use Kartenmacherei\HttpFramework\Http\InvalidDomainException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Http\Domain
 */
class DomainTest extends TestCase
{
    /**
     * @dataProvider getValidDomains
     *
     * @param string $domainName
     */
    public function testValidDomains(string $domainName): void
    {
        $domain = new Domain($domainName);

        $this->assertSame($domainName, $domain->asString());
    }

    public function getValidDomains(): array
    {
        return [
            ['configurator.kartenmacherei.de'],
            ['kartenmacherei.de'],
            ['local.kartenmacherei.de'],
            ['configurator.local.kartenmacherei.de'],
        ];
    }

    /**
     * @dataProvider getInvalidDomains
     *
     * @param string $domainName
     */
    public function testInvalidDomains(string $domainName): void
    {
        $this->expectException(InvalidDomainException::class);
        new Domain($domainName);
    }

    public function getInvalidDomains(): array
    {
        return [
            ['.de'],
            ['kartenmachereide'],
            ['localhost'],
        ];
    }
}
