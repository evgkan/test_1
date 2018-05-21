<?php
namespace app\controllers;

use engine\Controller;
use models\Category;
use models\Product;

class ApiController extends Controller
{


    public function getProductByIdAction()
    {
        $id = $this->getParam('id');
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $model = Product::findById($id);
        if(!$model)
            throw new \Exception('Model is not found');
        return $model->getAttrs();
    }


    public function getProductsByNameSubstringAction()
    {
        $substr = $this->getParam('substr');
        $substr = filter_var($substr, FILTER_SANITIZE_STRING);
        $models = Product::findByNameSubstring($substr);
        $result = [];
        foreach ($models as $model) {
            $result[] = $model->getAttrs();
        }
        return $result;
    }


    public function getProductsByMakersAction()
    {
        $makers = (array) $this->getParam('makers');

        foreach ($makers as $key=>$maker) {
            $makers[$key] = filter_var($maker, FILTER_SANITIZE_STRING);
        }

        $models = Product::findByMakers($makers);
        $result = [];
        foreach ($models as $model) {
            $result[] = $model->getAttrs();
        }
        return $result;
    }


    public function getProductsByCategoryAction()
    {
        $id = $this->getParam('id');
        $id = filter_var($id, FILTER_VALIDATE_INT);

        $models = Product::findByCategories($id);
        $result = [];
        foreach ($models as $model) {
            $result[] = $model->getAttrs();
        }
        return $result;
    }


    public function getProductsByCategoryRecursivelyAction()
    {
        $id = $this->getParam('id');
        $id = filter_var($id, FILTER_VALIDATE_INT);

        $category = Category::findById($id);
        if(!$category)
            throw new \Exception('Category is not found');

        $subIds = $category->getSubIds();

        $categories_ids = array_unique( array_merge([$id], $subIds) );

        $models = Product::findByCategories($categories_ids);
        $result = [];
        foreach ($models as $model) {
            $result[] = $model->getAttrs();
        }
        return $result;
    }


}
