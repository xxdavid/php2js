#!/usr/bin/env php
<?php
include __DIR__ . '/../vendor/autoload.php';
\Tracy\Debugger::$maxDepth = 10;
$tester = new \Php2js\Tester\Tester();
$tester->run();
