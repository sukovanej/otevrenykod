<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 25.9.17
 * Time: 10:03
 */

namespace AppBundle\Model;


use AppBundle\Entity\Category;
use AppBundle\Entity\Content;
use AppBundle\Entity\Published;
use AppBundle\Entity\User;
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
     * @param User $user
     * @return Published[]
     */
    public function getByUser(User $user) {
        $repository = $this->getPublishedRepository();

        $query = $repository->createQueryBuilder('a')
            ->join('a.content', 'd')
            ->where('d.author = :author')
            ->setParameter('author', $user)
            ->getQuery();

        return $query->getResult();
    }

    /**
     * @param Category $category
     * @return Published[]
     */
    public function getByCategory(Category $category) {
        $repository = $this->getPublishedRepository();

        $query = $repository->createQueryBuilder('a')
            ->join('a.content', 'd')
            ->join('d.category', 'c')
            ->where('c = :category')
            ->setParameter('category', $category)
            ->getQuery();

        return $query->getResult();
    }

    /**
     * @param $url
     * @return Published
     */
    public function getByUrl($url) {
        /** @var Published $published */
        $published = $this->getPublishedRepository()->findOneBy(["url" => $url]);
        return $published;
    }
}