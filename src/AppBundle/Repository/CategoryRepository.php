<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 11/3/17
 * Time: 3:37 PM
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Category;
use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository {
    /**
     * @param Category $content
     */
    public function save(Category $content) {
        $em = $this->getEntityManager();
        $em->persist($content);
        $em->flush();
    }

    /**
     * @param Category $content
     */
    public function merge(Category $content) {
        $em = $this->getEntityManager();
        $em->merge($content);
        $em->flush();
    }
}