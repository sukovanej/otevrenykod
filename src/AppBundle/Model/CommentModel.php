<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 24.9.17
 * Time: 20:52
 */

namespace AppBundle\Model;


use AppBundle\Entity\Comment;
use AppBundle\Repository\CommentRepository;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CommentModel extends EntityManagerModel {
    /**
     * @return CommentRepository
     */
    public function getCommentRepository(): CommentRepository {
        return $this->getEntityManager()->getRepository(Comment::class);
    }

    /**
     * @param Comment $content
     */
    public function save(Comment $content) {
        $this->getCommentRepository()->save($content);
    }

    /**
     * @return Comment[]
     */
    public function getList() {
        return $this->getCommentRepository()->findAll();
    }

    /**
     * @param Comment $content
     * @return Comment[]
     */
    public function getListByComment(Comment $content) {
        return $this->getCommentRepository()->findBy(
            ["content" => $content]
        );
    }

    /**
     * @param $id
     * @return Comment
     */
    public function getById($id) {
        return $this->getCommentRepository()->find($id);
    }
}