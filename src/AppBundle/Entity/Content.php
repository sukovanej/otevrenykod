<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 9/23/17
 * Time: 1:54 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Content
 * @package AppBundle\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContentRepository")
 * @ORM\Table(name="content")
 */
class Content {
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="contents")
     * @ORM\JoinColumn(name="author", referencedColumnName="id")
     */
    private $author;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $content = null;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $perex = null;

    /**
     * @var File
     * @ORM\Column(type="string", nullable=true)
     */
    private $image = null;

    /**
     * @var UploadedFile
     */
    private $imageFileObject = null;

    /**
     * @var Tag[]
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Tag")
     * @ORM\JoinTable(name="content_tag",
     *      joinColumns={@ORM\JoinColumn(name="content_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")})
     */
    private $tags;

    /**
     * @var Category
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category", inversedBy="contents")
     */
    private $category;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var Published
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Published", mappedBy="content")
     */
    private $published;

    public function __construct() {
        $this->created = new \DateTime();
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
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content) {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getPerex() {
        return $this->perex;
    }

    /**
     * @param string $perex
     */
    public function setPerex($perex) {
        $this->perex = $perex;
    }

    /**
     * @return File
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * @param Image $image
     */
    public function setImage($image) {
        $this->image = $image;
    }

    /**
     * @return Tag[]
     */
    public function getTags(): array {
        return $this->tags;
    }

    /**
     * @param Tag[] $tags
     */
    public function setTags(array $tags) {
        $this->tags = $tags;
    }

    /**
     * @return Category
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory($category) {
        $this->category = $category;
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
     * @return Published
     */
    public function getPublished() {
        return $this->published;
    }

    /**
     * @param Published $published
     */
    public function setPublished($published) {
        $this->published = $published;
    }

    /**
     * @return UploadedFile
     */
    public function getImageFileObject() {
        return $this->imageFileObject;
    }

    /**
     * @param File $imageFileObject
     */
    public function setImageFileObject($imageFileObject) {
        $this->imageFileObject = $imageFileObject;
    }

}