<?php

namespace app\controllers;
use app;
use app\core\Controller;
use app\models\Category;
use app\models\Ads;


class CategoryController extends Controller
{
    public function beforeAction() {
        parent::beforeAction();
        $this->layout = 'category';
    }

    public function actionIndex() {

        //New
        if(isset($_POST['parent_id'])) {
            $end_branch = ((isset($_POST['end_branch']))&&($_POST['end_branch'] == 'on')) ? 1 : 0;
            $category = new Category(0, $_POST['name'], $_POST['parent_id'], $end_branch);
            $category->save();
        }

        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $model = Category::findByPk($id);
            $name = $model->name;
            $isEndBranch = $model->end_branch == 0;
            $category = Category::findChild($id);
            $ads = Ads::findChild($id);
        } else {
            $name = "Все разделы";
            $isEndBranch = true;
            $category = Category::findChild(0);
            $ads = [];
        }

        if(isset($_GET['price_min']) && isset($_GET['price_max'])) {
            $ads = $this->filterPrice($ads, $_GET['price_min'], $_GET['price_max']);
        }
        return $this->render('index', [
            'name' => $name,
            'isEndBranch' => $isEndBranch,
            'category' => $category,
            'ads' => $ads,
        ]);
    }

    public function filterPrice($ads, $min, $max) {
        $list = [];
        foreach ($ads as $item) {
            if($item->price <= $max && $item->price >= $min)
                $list[] = $item;
        }
        return $list;
    }

    public function actionSearch() {
        $q = isset($_GET['q']) ? $_GET['q'] : "";
        $ads = Ads::getSeatch($q);
        return $this->render('search', [
            'ads' => $ads,
            'q' => $q
        ]);
    }

    public function actionView() {
        if(isset($_POST['category_id'])) {
            $item = [];
            $item['name'] = $_POST['name'];
            $item['description'] = $_POST['description'];
            $item['category_id'] = $_POST['category_id'];
            $item['price'] = $_POST['price'];
            $item['create_at'] = date('Y-m-d h:m:s');
            $item['update_at'] = date('Y-m-d h:m:s');
            $ads = new Ads($item);
            $ads->save();
        } else {
            if(isset($_GET['ads'])) {
                $ads = Ads::findOne($_GET['ads']);
            } else {
                $ads = Ads::findAll();
            }
        }

        return $this->render('view', [
            'ads' => $ads
        ]);
    }
}