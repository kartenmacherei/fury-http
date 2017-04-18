<?php
use Kartenmacherei\CodingStandard\KamStandard2017Php70;
use PhpCsFixer\Finder;

$config = new KamStandard2017Php70();
return $config
    ->setFinder(
        Finder::create()
            ->in(__DIR__ . '/src')
            ->in(__DIR__ . '/tests')
    );
