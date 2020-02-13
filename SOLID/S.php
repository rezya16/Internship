<?php

//S – The Single Responsibility Principle (Принцип единственной ответственности)

//ПЛОХО
//Перенагруженный класс большим количеством методов
class Product {

    public function addItem($item) {}
    public function deleteItem($id) {}
    public function updateItem($id) {}
    public function addToCart($id) {}
    public function calculateSum() {}
    public function calculateQty() {}
    public function showCart() {}
    public function printCart() {}

}

//ХОРОШО
//Класс отвечающий для распечатки Корзины или вывода на экран
class CartViewer {

    public function showCart () {}
    public function printCart() {}

}

//Класс отвечающий за работу с БД
class CartDB {

    public function addItem($item) {}
    public function deleteItem($id) {}
    public function updateItem($id) {}
    public function addToCart($id) {}

}

//Класс отвечающий за подсчёты в корзине
class CartCalculator {

    public function calculateSum() {}
    public function calculateQty() {}

}