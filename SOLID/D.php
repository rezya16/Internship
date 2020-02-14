<?php

//ПЛОХО
//Конструктор строго работает с классом MYSQLConnection, нужно будет переписывать при необходимости работы с дркгой БД
class Catalog {

    private $database;

    public function __construct(MySQLConnection $dbConnection) {

    }

}

class MySQLConnection {
    public function connect() {}
}

//ХОРОШО
//Конструктор работает с интерфейсом

class Store {

    private $database;

    public function __construct(DB $dbConnection) {
    }
}

interface DB {
    public function connect();
}

class MySQL implements DB {
    public function connect()
    {
        // TODO: Implement connect() method.
    }
}

class MongoDB implements DB {
    public function connect()
    {
        // TODO: Implement connect() method.
    }
}


