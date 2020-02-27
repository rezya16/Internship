<?php

//Итератор — это поведенческий паттерн проектирования,
//который даёт возможность последовательно обходить
//элементы составных объектов, не раскрывая их внутреннего
//представления.

/**
 * Итератор CSV-файлов.
 *
 * @author Josh Lockhart
 */
class CsvIterator implements \Iterator
{
    const ROW_SIZE = 4096;

    /**
     * Указатель на CSV-файл.
     *
     * @var resource
     */
    protected $filePointer = null;

    /**
     * Текущий элемент, который возвращается на каждой итерации.
     *
     * @var array
     */
    protected $currentElement = null;

    /**
     * Счётчик строк.
     *
     * @var int
     */
    protected $rowCounter = null;

    /**
     * Разделитель для CSV-файла.
     *
     * @var string
     */
    protected $delimiter = null;

    /**
     * Конструктор пытается открыть CSV-файл. Он выдаёт исключение при ошибке.
     *
     * @param string $file CSV-файл.
     * @param string $delimiter Разделитель.
     *
     * @throws \Exception
     */
    public function __construct($file, $delimiter = ',')
    {
        try {
            $this->filePointer = fopen($file, 'rb');
            $this->delimiter = $delimiter;
        } catch (\Exception $e) {
            throw new \Exception('The file "' . $file . '" cannot be read.');
        }
    }

    /**
     * Этот метод сбрасывает указатель файла.
     */
    public function rewind(): void
    {
        $this->rowCounter = 0;
        rewind($this->filePointer);
    }

    /**
     * Этот метод возвращает текущую CSV-строку в виде двумерного массива.
     *
     * @return array Текущая CSV-строка в виде двумерного массива.
     */
    public function current(): array
    {
        $this->currentElement = fgetcsv($this->filePointer, self::ROW_SIZE, $this->delimiter);
        $this->rowCounter++;

        return $this->currentElement;
    }

    /**
     * Этот метод возвращает номер текущей строки.
     *
     * @return int Номер текущей строки.
     */
    public function key(): int
    {
        return $this->rowCounter;
    }

    /**
     * Этот метод проверяет, достигнут ли конец файла.
     *
     * @return bool Возвращает true при достижении EOF, в ином случае false.
     */
    public function next(): bool
    {
        if (is_resource($this->filePointer)) {
            return !feof($this->filePointer);
        }

        return false;
    }

    /**
     * Этот метод проверяет, является ли следующая строка допустимой.
     *
     * @return bool Если следующая строка является допустимой.
     */
    public function valid(): bool
    {
        if (!$this->next()) {
            if (is_resource($this->filePointer)) {
                fclose($this->filePointer);
            }

            return false;
        }

        return true;
    }
}

/**
 * Клиентский код.
 */
$csv = new CsvIterator(__DIR__ . '/cats.csv');

foreach ($csv as $key => $row) {
    print_r($row);
}