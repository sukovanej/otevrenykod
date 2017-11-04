<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 4.11.17
 * Time: 21:03
 */

namespace AppBundle\Controller\Frontend;


use AppBundle\Model\CategoryModel;
use AppBundle\Model\ContentModel;
use AppBundle\Model\PublishedModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryController extends Controller {

    /**
     * @Route("/kategorie/{category_name}", name="category")
     *
     * @param CategoryModel $categoryModel
     * @param PublishedModel $publishedModel
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function categoryAction(CategoryModel $categoryModel, PublishedModel $publishedModel, $category_name) {
        $category = $categoryModel->getByName(urldecode($category_name));
        $publishedList = $publishedModel->getByCategory($category);

        return $this->render("default/index.html.twig", [
            "published_list" => $publishedList
        ]);
    }
}