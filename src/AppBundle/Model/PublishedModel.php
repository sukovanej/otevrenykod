<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 25.9.17
 * Time: 10:03
 */

namespace AppBundle\Model;


use AppBundle\Entity\Content;
use AppBundle\Entity\Published;
use AppBundle\Repository\PublishedRepository;

class PublishedModel extends EntityManagerModel {
    /**
     * @return PublishedRepository
     */
    public function getPublishedRepository(): PublishedRepository {
        return $this->getEntityManager()->getRepository(Published::class);
    }

    /**
     * @param Published $published
     */
    public function save(Published $published) {
        $this->getPublishedRepository()->save($published);
    }

    /**
     * @return Published[]
     */
    public function getList() {
        return $this->getPublishedRepository()->findPublished();
    }

    /**
     * @param $url
     * @return Published
     */
    public function getByUrl($url) {
        /** @var Published $published */
        $published = $this->getPublishedRepository()->findOneBy(["url" => $url]);
        return $published->getContent();
    }
}