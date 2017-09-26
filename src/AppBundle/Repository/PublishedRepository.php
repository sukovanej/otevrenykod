<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 25.9.17
 * Time: 10:03
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Published;
use Doctrine\ORM\EntityRepository;

class PublishedRepository extends EntityRepository {
    /**
     * @param Published $published
     */
    public function save(Published $published) {
        $em = $this->getEntityManager();
        $em->persist($published);
        $em->flush();
    }
}