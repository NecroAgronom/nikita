<?php

namespace app\controllers;

use app\modules\blog\controllers\DefaultController;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Posts;
use yii\data\Pagination;
use app\models\PostsSearch;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {

        $post = Posts::find()->where(['category_id' => 1]);
        $poem = Posts::find()->where(['category_id' => 2]);
        $music = Posts::find()->where(['category_id' => 3]);
        $post_q = $post->count();
        $poem_q = $poem->count();
        $music_q = $music->count();






         return $this->render('index',[
             'posts' => $post_q,
             'poems' => $poem_q,
             'music' => $music_q,
             'p' => $post
         ]);

    }

    public function actionPosts(){

        $allPosts = Posts::find()->where(['category_id' => 1]);


        if($allPosts){

            $pages  = new Pagination(['totalCount' => $allPosts->count(), 'pageSize' => 9]);
            $posts = $allPosts->offset( $pages->offset )->limit( $pages->limit )->all();

            return $this->render('posts', [
                'posts' => $posts,
                'pages' => $pages

            ]);
        }

    }

    public function actionMusic(){




        $allPosts = Posts::find()->where(['category_id' => 3]);


        if($allPosts){

            $pages  = new Pagination(['totalCount' => $allPosts->count(), 'pageSize' => 9]);
            $posts = $allPosts->offset( $pages->offset )->limit( $pages->limit )->all();

            return $this->render('music', [
                'posts' => $posts,
                'pages' => $pages

            ]);
        }

    }

    public function actionPoems(){

        $allPosts = Posts::find()->where(['category_id' => 2]);


        if($allPosts){

            $pages  = new Pagination(['totalCount' => $allPosts->count(), 'pageSize' => 9]);
            $posts = $allPosts->offset( $pages->offset )->limit( $pages->limit )->all();

            return $this->render('poems', [
                'posts' => $posts,
                'pages' => $pages

            ]);
        }

    }

    public function actionView($id)
    {
        $this->findModel($id)->incViewed($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Posts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Posts();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Posts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Posts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Posts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Posts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Posts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionDownload($id) {


        $file = Posts::findOne(['id' => $id]);
        if ($file == null) {
            throw new NotFoundHttpException('Image not found');
        }
        return Yii::$app->response->sendFile(Yii::getAlias('@webroot' . $file->aud));


    }

    public function actionDev()
    {
        return $this->render('dev');
    }

}
