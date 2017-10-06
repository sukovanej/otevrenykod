<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 24.9.17
 * Time: 20:56
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Content;
use Doctrine\ORM\EntityRepository;

class ContentRepository extends EntityRepository {
    /**
     * @param Content $content
     */
    public function save(Content $content) {
        $em = $this->getEntityManager();
        $em->persist($content);
        $em->flush();
    }

    /**
     * @param Content $content
     */
    public function merge(Content $content) {
        $em = $this->getEntityManager();
        $em->merge($content);
        $em->flush();
    }
}