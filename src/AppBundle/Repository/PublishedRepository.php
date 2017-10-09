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

    /**
     * @return Published[]
     */
    public function findPublished() {
        $q = $this->getEntityManager()
            ->createQuery("SELECT e, f FROM AppBundle:Published e JOIN e.content f
WHERE e.datetime <= CURRENT_TIMESTAMP() ORDER BY e.datetime DESC");

        return $q->getResult();
    }
}