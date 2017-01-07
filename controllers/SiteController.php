<?php

namespace app\controllers;
use app;
use app\core\Controller;
use app\models\Category;


class SiteController extends Controller
{
    public function actionIndex() {
        $category = Category::findAll();
        return $this->render('index', ['category' => $category]);
    }

    public function actionAbout() {
        return $this->render('about');
    }

    public function actionContact() {
        return $this->render('contact');
    }

    public function actionProduct() {
        return $this->render('index', ['model' => 'this is a index 2']);
    }

    public function actionError() {
        return $this->render('error');
    }
}