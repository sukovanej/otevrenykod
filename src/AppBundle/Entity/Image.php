<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 12.11.17
 * Time: 18:23
 */

namespace AppBundle\Entity;


class Image {
    private $imageFileObject;

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