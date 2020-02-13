<?php

//ПЛОХО
//Электронная книга не имеет веса, но класс ElectroBook вынужден реализовывать не нужный метод

interface Book {

    public function getPrice();
    public function getWeight();
    public function getQtyPages();

}

class PaperBook implements Book {

    public function getPrice(){
        // TODO: Implement getPrice() method.
    }

    public function getWeight()
    {
        // TODO: Implement getWeight() method.
    }

    public function getQtyPages()
    {
        // TODO: Implement getQtyPages() method.
    }

}

class ElectroBook implements Book {

    public function getPrice()
    {
        // TODO: Implement getPrice() method.
    }


    public function getQtyPages()
    {
        // TODO: Implement getQtyPages() method.
    }

    public function getWeight()
    {
        // Пустота
    }

}

//ХОРОШО
//Разделяем интерфейсы для каждого типа книг

interface Book {

    public function getPrice();
    public function getQtyPages();

}

interface PBook {

    public function getWeight();

}

class PaperBook implements Book, PBook {

    public function getPrice(){
        // TODO: Implement getPrice() method.
    }

    public function getWeight()
    {
        // TODO: Implement getWeight() method.
    }

    public function getQtyPages()
    {
        // TODO: Implement getQtyPages() method.
    }

}

class ElectroBook implements Book {

    public function getPrice()
    {
        // TODO: Implement getPrice() method.
    }


    public function getQtyPages()
    {
        // TODO: Implement getQtyPages() method.
    }

}