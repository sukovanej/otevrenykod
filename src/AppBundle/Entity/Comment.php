<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 10/20/17
 * Time: 4:22 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Comment
 * @package AppBundle\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommentRepository")
 * @ORM\Table(name="comment")
 */
class Comment {
    /**
     * @var integer
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id", nullable=true)
     */
    private $author;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var Comment
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Comment")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     */
    private $parent;

    /**
     * @var Content
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Content")
     * @ORM\JoinColumn(name="content_id", referencedColumnName="id", nullable=true)
     */
    private $content;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * Comment constructor.
     */
    public function __construct() {
        $this->$this->setCreated(new \DateTime());
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return User
     */
    public function getAuthor() {
        return $this->author;
    }

    /**
     * @param User $author
     */
    public function setAuthor($author) {
        $this->author = $author;
    }

    /**
     * @return \DateTime
     */
    public function getCreated() {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated($created) {
        $this->created = $created;
    }

    /**
     * @return Comment
     */
    public function getParent() {
        return $this->parent;
    }

    /**
     * @param Comment $parent
     */
    public function setParent($parent) {
        $this->parent = $parent;
    }

    /**
     * @return Content
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * @param Content $content
     */
    public function setContent($content) {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getText() {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text) {
        $this->text = $text;
    }
}