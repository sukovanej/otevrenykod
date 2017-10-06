<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 25.9.17
 * Time: 9:46
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Published
 * @package AppBundle\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PublishedRepository")
 * @ORM\Table(name="published")
 */
class Published {
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Content
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Content", inversedBy="published")
     * @ORM\JoinColumn(name="published_id", referencedColumnName="id")
     */
    private $content;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $datetime;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $url;

    public function __construct() {
        $this->datetime = new \DateTime();
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
     * @return \DateTime
     */
    public function getDatetime() {
        return $this->datetime;
    }

    /**
     * @param \DateTime $datetime
     */
    public function setDatetime($datetime) {
        $this->datetime = $datetime;
    }

    /**
     * @return string
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url) {
        $this->url = $url;
    }

}