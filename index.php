<?php

require __DIR__ . '/vendor/autoload.php';

//$c = new \RedRat\Cuddly\Collection\GeneralCollection();
//$c->add('foo');
//$c->add(true);
//
//dd(count($c), $c->getList());

$e = \RedRat\Cuddly\Collection\Factory\ObjectCollectionFactory::create(\RedRat\Cuddly\Pato\Pato::class);

dd($e);
