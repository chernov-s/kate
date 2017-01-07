<?php

namespace app\controllers;
use app;
use app\core\Controller;
use app\models\Category;


class CategoryController extends Controller
{
    public function beforeAction() {
        parent::beforeAction();
        $this->layout = 'category';
    }

    public function actionIndex() {

        if(isset($_POST['parent_id'])) {
            $category = new Category(0, $_POST['name'], $_POST['parent_id']);
            $category->save();
        }

        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $category = Category::findByPk($id);
            $name = $category->name;
        } else {
            $name = SITE_NAME;
        }

        return $this->render('index', ['name' => $name]);
    }
}