<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 10/20/17
 * Time: 4:23 PM
 */

namespace AppBundle\Repository;


use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository {
    /**
     * @param User $content
     */
    public function save(User $content) {
        $em = $this->getEntityManager();
        $em->persist($content);
        $em->flush();
    }

    /**
     * @param User $content
     */
    public function merge(User $content) {
        $em = $this->getEntityManager();
        $em->merge($content);
        $em->flush();
    }

}