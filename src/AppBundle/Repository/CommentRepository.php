<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 10/20/17
 * Time: 4:23 PM
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Comment;
use Doctrine\ORM\EntityRepository;

class CommentRepository extends EntityRepository {
    /**
     * @param Comment $content
     */
    public function save(Comment $content) {
        $em = $this->getEntityManager();
        $em->persist($content);
        $em->flush();
    }

    /**
     * @param Comment $content
     */
    public function merge(Comment $content) {
        $em = $this->getEntityManager();
        $em->merge($content);
        $em->flush();
    }

}