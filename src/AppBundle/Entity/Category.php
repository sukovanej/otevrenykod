<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 9/23/17
 * Time: 1:55 PM
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Category
 * @package AppBundle\Entity
 * @ORM\Entity()
 * @ORM\Table(name="category")
 */
class Category {
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="categories")
     */
    private $author;

    /**
     * @var Content[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Content", mappedBy="id")
     */
    private $contents;

    /**
     * Category constructor.
     */
    public function __construct() {
        $this->created = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id) {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name) {
        $this->name = $name;
    }

    /**
     * @return \DateTime
     */
    public function getCreated(): \DateTime {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated(\DateTime $created) {
        $this->created = $created;
    }

    /**
     * @return User
     */
    public function getAuthor(): User {
        return $this->author;
    }

    /**
     * @param User $author
     */
    public function setAuthor(User $author) {
        $this->author = $author;
    }

    /**
     * @return Content[]
     */
    public function getContents(): array {
        return $this->contents;
    }

    /**
     * @param Content[] $contents
     */
    public function setContents(array $contents) {
        $this->contents = $contents;
    }
}