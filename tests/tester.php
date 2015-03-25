#!/usr/bin/env php
<?php

use Nette\Utils\Finder;
use Php2js\Transpiler;
use Tracy\Debugger;
use Colors\Color;
use Php2js\Exceptions\NotImplementedException;

require __DIR__ . '/../vendor/autoload.php';

echo "Running tests...\n\n";
Debugger::timer();

$transpiler = new Transpiler();
$color = new Color();
$color->setForceStyle(true);
$files = Finder::findFiles('*.php')->exclude('tester.php')->from(__DIR__);
$failures = [];

foreach ($files as $phpFilePath => $phpFileInfo) {
    $jsFilePath = rtrim($phpFilePath, '.php') . '.js';
    $name = substr(rtrim($phpFilePath, '.php'), strlen(__DIR__) + 1);
    if (!file_exists($jsFilePath)) {
        throw new \Exception('Not defined JS result file for: ' . $name);
    }
    try {
        $result = $transpiler->transpile(file_get_contents($phpFilePath));
        $expected = file_get_contents($jsFilePath);
        if ($result === $expected) {
            echo $color('.')->green();
        } else {
            echo $color('F')->red();
            $failures[] = $color->apply('red', $name) // $color($name)->red() doesn't work; don't know why
                .  $color(' failed:')->light_red() . "\n"
                . $color($result)->white()->bg_red()
                .$color("\nShould be:\n")->yellow()
                . $color($expected)->white()->bg_green();
        }
    } catch (NotImplementedException $e) {
        echo $color('F')->red();
        $failures[] = $color->apply('red', $name)
            .  $color(' failed:')->light_red() . "\n"
            . $color($e->getMessage())->red();
    }
}

foreach ($failures as $failure) {
    echo "\n\n";
    echo $failure;
}

if ($failures) {
    echo "\n";
}

echo "\nCompleted in " . round(Debugger::timer(), 2) . " seconds.\n";
