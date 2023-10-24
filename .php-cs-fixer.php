<?php
use Kartenmacherei\CodingStandard\KamCodingStandard;
use PhpCsFixer\Finder;

$config = new KamCodingStandard();
return $config
    ->setFinder(
        Finder::create()
            ->in(__DIR__ . '/src')
            ->in(__DIR__ . '/tests')
    );
