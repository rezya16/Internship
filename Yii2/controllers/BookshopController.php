<?php

namespace app\controllers;

use Yii;
use app\models\Book;

class BookshopController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $conditions = ['publisher_id' => 1];
        $bookList = Book::find()
            ->orderBy('date_published')
            ->all();

        return $this->render('index', [
            'bookList' => $bookList,
        ]);
    }

    public function actionCreate() {
        $book = new Book();

        if ($book->load(Yii::$app->request->post())) {
           if ($book->save()) {
               Yii::$app->session->setFlash('success', 'Saved!');
           }
           return $this->refresh();
        }

        return $this->render('create', [
            'book' => $book
        ]);
    }

}
