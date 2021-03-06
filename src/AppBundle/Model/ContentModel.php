<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 24.9.17
 * Time: 20:52
 */

namespace AppBundle\Model;


use AppBundle\Entity\Content;
use AppBundle\Entity\User;
use AppBundle\Repository\ContentRepository;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ContentModel extends EntityManagerModel {
    /**
     * @return ContentRepository
     */
    public function getContentRepository(): ContentRepository {
        return $this->getEntityManager()->getRepository(Content::class);
    }

    /**
     * @param Content $content
     */
    public function merge(Content $content) {
        $file = $content->getImageFileObject();

        if ($file instanceof UploadedFile && $file->isValid()) {
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();

            $file->move(
                __DIR__ . "/../../../web/img/article",
                $fileName
            );

            $content->setImage($fileName);
        }

        $this->getContentRepository()->merge($content);
    }

    /**
     * @param Content $content
     */
    public function save(Content $content) {
        $file = $content->getImageFileObject();

        if ($file instanceof UploadedFile && $file->isValid()) {
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();

            $file->move(
                __DIR__ . "/../../../web/img/article",
                $fileName
            );

            $content->setImage($fileName);
        } else {
            $content->setImage("");
        }

        $this->getContentRepository()->save($content);
    }

    /**
     * @param User $user
     * @return Content[]
     */
    public function getByUser(User $user) {
        return $this->getContentRepository()->findBy(["author" => $user], ["created" => "DESC"]);
    }

    /**
     * @return array
     */
    public function getList() {
        return $this->getContentRepository()->findBy([], ["created" => "DESC"]);
    }

    /**
     * @param string $content
     * @return Content[]|[]
     */
    public function search($value) {
        $query = $this->getContentRepository()->createQueryBuilder("p")
            ->where("p.title LIKE :value OR p.content LIKE :value")
            ->setParameter("value", "%" . $value . "%")
            ->getQuery();

        return $query->getResult();
    }

    /**
     * @param $id
     * @return Content
     */
    public function getById($id) {
        return $this->getContentRepository()->find($id);
    }
}