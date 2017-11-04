<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 11/3/17
 * Time: 3:25 PM
 */

namespace AppBundle\Controller\Admin;


use AppBundle\Entity\Category;
use AppBundle\Form\CategoryAddFormType;
use AppBundle\Model\CategoryModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller {
    /**
     * @Route("/admin/kategorie", name="admin_category")
     */
    public function categoryAction(CategoryModel $categoryModel, Request $request) {
        $category = new Category();
        $category->setAuthor($this->getUser());

        $addForm = $this->createForm(CategoryAddFormType::class, $category);
        $addForm->handleRequest($request);

        if ($addForm->isSubmitted() && $addForm->isValid()) {
            $categoryModel->save($category);
            $this->addFlash("success", "Nová kategorie úspěšně vytvořena");

            return $this->redirectToRoute("admin_category");
        }

        return $this->render("admin/category/list.html.twig", [
            "category_list" => $categoryModel->getList(),
            "add_category_form" => $addForm->createView()
        ]);
    }
}