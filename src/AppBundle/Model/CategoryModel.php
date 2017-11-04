<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 11/3/17
 * Time: 3:39 PM
 */

namespace AppBundle\Model;


use AppBundle\Entity\Category;
use AppBundle\Repository\CategoryRepository;

class CategoryModel  extends EntityManagerModel {
    /**
     * @return CategoryRepository
     */
    public function getCategoryRepository(): CategoryRepository {
        return $this->getEntityManager()->getRepository(Category::class);
    }

    /**
     * @param Category $comment
     */
    public function save(Category $comment) {
        $this->getCategoryRepository()->save($comment);
    }

    /**
     * @return Category[]
     */
    public function getList() {
        return $this->getCategoryRepository()->findAll();
    }

    /**
     * @param $id
     * @return Category
     */
    public function getById($id) {
        return $this->getCategoryRepository()->find($id);
    }

    /**
     * @param $name
     * @return Category
     */
    public function getByName($name) {
        return $this->getCategoryRepository()->findOneBy(["name" => $name]);
    }
}