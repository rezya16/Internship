<?php

//ПЛОХО
//При добавлении другого способа доставки приходиться изменять уже имеющийся код
class Cart {

    protected $sum;

    public function getProductPrice() {}

    public function getDeliveryPrice($transport)
    {
        if ($transport == 'legs') {
            return 0;
        } elseif ($transport == 'train') {
            return 1500;
        } elseif ($transport == 'plane') {
            return 5000;
        }
    }
}

//ХОРОШО
//При добавлении нового способа доставки нужно создать новый класс и имплиментировать интерфейс Delivery, уже написанный код трогать не нужно
interface Delivery {
    public function getDeliveryPrice() ;
}

class Legs implements Delivery {
    public function getDeliveryPrice() {
        return 0;
    }
}

class Train implements Delivery {
    public function getDeliveryPrice(){
        return 1500;
    }
}

class Plane implements Delivery {
    public function getDeliveryPrice() {
        return 5000;
    }
}

class Carts {

    protected  $sum;

    public function getSum() {}

    public function getProductPrice($object) {

        $result = new $object;
        return $result->getDeliveryPrice();

    }
}

