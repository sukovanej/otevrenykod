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
     * @return int
     */
    public function getCountHomepageList() {
        $repository = $this->getPublishedRepository();

        $query = $repository->createQueryBuilder('a')
            ->select("count(a.id)")
            ->where('a.datetime <= CURRENT_TIMESTAMP()')
            ->getQuery();

        return $query->getSingleScalarResult();
    }

    /**
     * @return Published[]
     */
    public function getHomepageSharedList($offset) {
        $repository = $this->getPublishedRepository();

        $query = $repository->createQueryBuilder('a')
            ->join("a.content", "c")
            ->where('a.datetime <= CURRENT_TIMESTAMP() and c.type = 3')
            ->setMaxResults($offset)
            ->orderBy("a.datetime", "DESC")
            ->getQuery();

        return $query->getResult();
    }

    /**
     * @return Published[]
     */
    public function getHomepageList($start, $offset) {
        $repository = $this->getPublishedRepository();

        $query = $repository->createQueryBuilder('a')
            ->where('a.datetime <= CURRENT_TIMESTAMP()')
            ->setFirstResult($start)
            ->setMaxResults($offset)
            ->orderBy("a.datetime", "DESC")
            ->getQuery();

        return $query->getResult();
    }

    /**
     * @param User $user
     * @return Published[]
     */
    public function getByUser(User $user) {
        $repository = $this->getPublishedRepository();

        $query = $repository->createQueryBuilder('a')
            ->join('a.content', 'd')
            ->where('d.author = :author AND a.datetime <= CURRENT_TIMESTAMP()')
            ->setParameter('author', $user)
            ->orderBy("a.datetime", "DESC")
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
            ->where('c = :category AND a.datetime <= CURRENT_TIMESTAMP()')
            ->setParameter('category', $category)
            ->orderBy("a.datetime", "DESC")
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