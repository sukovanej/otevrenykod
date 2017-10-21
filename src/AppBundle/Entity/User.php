<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 9/23/17
 * Time: 1:54 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package AppBundle\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\Table(name="`user`")
 */
class User extends \FOS\UserBundle\Model\User {
    /**
     * @var int
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Content[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Content", mappedBy="content")
     */
    private $contents;

    /**
     * @var Category[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Category", mappedBy="author")
     */
    private $categories;

    /**
     * @var Tag[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Tag", mappedBy="author")
     */
    private $tags;

    /**
     * User constructor.
     */
    public function __construct() {
        parent::__construct();
    }
}