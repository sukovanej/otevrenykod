<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 25.9.17
 * Time: 10:03
 */

namespace AppBundle\Model;


use AppBundle\Entity\Published;
use AppBundle\Repository\PublishedRepository;

class PublishedModel extends EntityManagerModel {
    /**
     * @return PublishedRepository
     */
    public function getPublishedRepository(): PublishedRepository {
        return $this->getEntityManager()->getRepository(Published::class);
    }

    public function save(Published $published) {
        $this->getPublishedRepository()->save($published);
    }
}