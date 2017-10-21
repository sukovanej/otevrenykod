<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 24.9.17
 * Time: 20:52
 */

namespace AppBundle\Model;


use AppBundle\Entity\Comment;
use AppBundle\Entity\Content;
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
     * @param Comment $comment
     */
    public function save(Comment $comment) {
        $this->getCommentRepository()->save($comment);
    }

    /**
     * @return Comment[]
     */
    public function getList() {
        return $this->getCommentRepository()->findAll();
    }

    /**
     * @param Content $content
     * @return Comment[]
     */
    public function getListByContent(Content $content) {
        $query = $this->getCommentRepository()->createQueryBuilder("p")
            ->where("p.id = 0")
            ->orderBy("p.created", "ASC")
            ->getQuery();

        return $query->getResult();
    }

    /**
     * @param $id
     * @return Comment
     */
    public function getById($id) {
        return $this->getCommentRepository()->find($id);
    }
}