<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\BaseStringHelper;
use app\models\Category;

/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property string $text_prev
 * @property string $img
 */
class Posts extends \yii\db\ActiveRecord
{

    public $image;
    public $filename;
    public $string;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text','category_id'], 'required'],
            [['text'], 'string'],
            [['title', 'text_prev'], 'string', 'max' => 255],
            //[['img'], 'file']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'text' => 'Text',
            'text_prev' => 'Text Prev',
            'img' => 'Img',
            'category_id' => 'Category'
        ];
    }

    public function beforeSave($insert){
        if ($this->isNewRecord) {
            //generate & upload
            $this->string = substr(uniqid('img'), 0, 12); //imgRandomString
            $this->image = UploadedFile::getInstance($this, 'img');
            $this->filename = 'static/images/' . $this->string . '.' . $this->image->extension;
            $this->image->saveAs($this->filename);

            $this->text_prev = BaseStringHelper::truncate($this->text,50 , '...');

            //save
            $this->img = '/' . $this->filename;
        }else{
            $this->image = UploadedFile::getInstance($this, 'img');
            if($this->image){
                $this->image->saveAs(substr($this->img, 1));
            }
        }

        return parent::beforeSave($insert);
    }

    public function getCategory(){
        return $this->hasOne(Category::className(),[ 'id' => 'category_id']);
    }


}
