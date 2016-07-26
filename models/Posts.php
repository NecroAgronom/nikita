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
    public $audio;
    public $audioname;
    public $audiostring;
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
            [['img'], 'file','extensions' => 'gif, jpg, bmp, png'],
            [['aud'], 'file','extensions' => 'mp3']
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
            'aud' => 'Audio',
            'category_id' => 'Category'
        ];
    }

    public function incViewed($id){
        $post = Posts::findOne($id);
        $post->viewed++;
        $post->save();
    }

    public function beforeSave($insert){
        if ($this->isNewRecord) {
            //generate & upload
            $this->string = substr(uniqid('img'), 0, 12); //imgRandomString
            $this->image = UploadedFile::getInstance($this, 'img');
            $this->audiostring = substr(uniqid('audio'), 0, 12); //imgRandomString
            $this->audio = UploadedFile::getInstance($this, 'aud');

            if($this->image){
                $this->filename = 'static/images/' . $this->string . '.' . $this->image->extension;
                $this->image->saveAs($this->filename);
                $this->img = '/' . $this->filename;
            }
            if($this->audio){
                $this->audioname = 'static/audios/' . $this->audiostring . '.' . $this->audio->extension;
                $this->audio->saveAs($this->audioname);
                $this->aud = '/' . $this->audioname;
            }


            $this->text_prev = BaseStringHelper::truncate($this->text,30 , '...');

            //save

        }else{
            //$this->image = UploadedFile::getInstance($this, 'img');
            //$this->audio = UploadedFile::getInstance($this, 'aud');
            //if($this->image){
            //    $this->image->saveAs(substr($this->img, 1));
            //}

            //if($this->audio){
            //    $this->audio->saveAs(substr($this->aud, 1));
            //}

            $this->image = UploadedFile::getInstance($this, 'img');
            $this->audio = UploadedFile::getInstance($this, 'aud');
            //var_dump($this->image);

            if($this->image) {
                $this->string = substr(uniqid('img'), 0,12);
                $this->filename = 'static/images/' . $this->string . '.' .$this->image->extension;
                $this->img = '/' .$this->filename;
                $this->image->saveAs(substr($this->img,1));

            } else {
                //var_dump($this->id);
                //$this->img = Posts::find()->where(['id' => $this->id]);
                $array = Posts::find()->select('img')->where(['id' => $this->id])->asArray()->column();
                $this->img = current($array);


            }
            if($this->audio) {
                $this->audiostring = substr(uniqid('audio'), 0,12);
                $this->audioname = 'static/audios/' . $this->audiostring . '.' .$this->audio->extension;
                $this->aud = '/' .$this->audioname;
                $this->audio->saveAs(substr($this->aud,1));

            } else {
                //var_dump($this->id);
                //$this->img = Posts::find()->where(['id' => $this->id]);
                $arraya = Posts::find()->select('aud')->where(['id' => $this->id])->asArray()->column();
                $this->aud = current($arraya);


            }

        }

        return parent::beforeSave($insert);
    }

    public function getCategory(){
        return $this->hasOne(Category::className(),[ 'id' => 'category_id']);
    }


}
