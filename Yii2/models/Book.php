<?php


namespace app\models;

use Yii;
use app\models\Publisher;
use yii\db\ActiveRecord;


class Book extends ActiveRecord
{
    public static function tableName()
    {
        return '{{book}}';
    }

    public function rules()
    {
        return [
            [['name','publisher_id'], 'required']
        ];
    }

    /**
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function getDatePublished() {
        return ($this->date_published) ? Yii::$app->formatter->asDate($this->date_published) : "Not set";
    }

    /**
     * @return array|ActiveRecord|null
     */
    public function getPublisher() {
        return $this->hasOne(\app\models\Publisher::className(), ['id' => 'publisher_id'])->one();
    }

    /**
     * @return mixed|string
     */
    public function getPublisherName() {

        if ($publisher = $this->getPublisher()) {
            return $publisher->name;
        }
        return "Not set";
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function  getBookToAuthorRelations() {
        return $this->hasMany(BookToAuthor::className(), ['book_id' => 'id']);
    }

    /**
     * @return array|ActiveRecord[]
     */
    public function getAuthors() {
        return $this->hasMany(Author::className(), ['id' => 'author_id'])->via('bookToAuthorRelations')->all();
    }
}