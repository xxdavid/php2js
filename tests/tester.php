#!/usr/bin/env php
<?php

use Nette\Utils\Finder;
use Php2js\Transpiler;
use Tracy\Debugger;
use Colors\Color;

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
    $result = $transpiler->transpile(file_get_contents($phpFilePath));
    $expected = file_get_contents($jsFilePath);
    if ($result === $expected) {
        echo $color('.')->green();
    } else {
        echo $color('F')->red();
        $failures[] = [$name, $result, $expected];
    }
}

foreach ($failures as $failure) {
    echo "\n\n";
    echo $color($failure[0])->red(), $color(" failed:\n")->light_red();
    echo $color($failure[1])->white()->bg_red(), $color("\nShould be:\n")->yellow(), $color($failure[2])->white()->bg_green();
    ;
}

if ($failures) {
    echo "\n";
}

echo "\nCompleted in " . round(Debugger::timer(), 2) . " seconds.\n";
