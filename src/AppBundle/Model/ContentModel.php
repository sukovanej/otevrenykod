<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 24.9.17
 * Time: 20:52
 */

namespace AppBundle\Model;


use AppBundle\Entity\Content;
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
        /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
        $file = $content->getImage();
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();

        $file->move(
            "../../../web/img/article",
            $fileName
        );

        $content->getImage($fileName);
        $this->getContentRepository()->save($content);
    }

    /**
     * @return array
     */
    public function getList() {
        return $this->getContentRepository()->findAll();
    }

    /**
     * @param $id
     * @return Content
     */
    public function getById($id) {
        return $this->getContentRepository()->find($id);
    }
}