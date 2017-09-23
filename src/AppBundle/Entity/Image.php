<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 16.8.17
 * Time: 20:38
 */

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @package AppBundle\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ImageRepository")
 * @ORM\Table("image")
 */
class Image {
    /**
     * @ORM\Column(type="blob")
     *
     * @Assert\NotBlank(message="general.error_image_format")
     * @Assert\File(mimeTypes={ "image/png", "image/jpeg" })
     */
    private $data;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var DateTime
     *
     * @ORM\Column("created", type="datetime")
     */
    private $created;

    /**
     * ImageEntity constructor.
     */
    public function __construct() {
        $this->created = new DateTime();
    }

    /**
     * @return string
     */
    public function getEncodedBase64Data() {
        return base64_encode(stream_get_contents($this->getData()));
    }

    /**
     * @return string
     */
    public function getData() {
        return $this->data;
    }

    /**
     * @param string $data
     */
    public function setData($data) {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return DateTime
     */
    public function getCreated() {
        return $this->created;
    }

    /**
     * @param DateTime $created
     */
    public function setCreated($created) {
        $this->created = $created;
    }
}