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
 * @ORM\Entity()
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
     * User constructor.
     */
    public function __construct() {
        parent::__construct();
    }
}