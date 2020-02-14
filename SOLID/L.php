<?php

//ПЛОХО
//почему нарушен: типы параметров метода подкласса должны совпадать или быть более абстрактными, чем типы параметров базового метода.
class A {
    public function __construct(int $a) {
    }
}

class B extends A {

    public function __construct(int $a, string $b)
    {
        parent::__construct($a);
    }

}

//по L - должно работать с любым use
//use A as myClass;
use B as myClass;

$a = 1;
$obj = new myClass($a); // c A - работает; с B - нет

//ХОРОШО
//Убираем из конструктора подкласса аторой аргумент
class C {
    public function __construct(int $a) {
    }
}

class D extends C {

    public function __construct(int $a)
    {
        parent::__construct($a);
    }

}

//по L - должно работать с любым use
use C as myClas;
use D as myCla;

$a = 1;
$obj = new myClas($a); // c A - работает; с B - нет
$obj = new myCla($a);