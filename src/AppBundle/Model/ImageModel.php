<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 12.11.17
 * Time: 18:21
 */

namespace AppBundle\Model;


use AppBundle\Entity\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageModel {
    const IMAGES_DIR = __DIR__ . "/../../../web/obrazky";

    public function getList() {
        $d = @dir(self::IMAGES_DIR);
        $imagesList = [];

        while (false !== ($entry = @$d->read())) {
            if (!in_array($entry, [".", ".."]))
                $imagesList[] = $entry;
        }

        $d->close();

        return $imagesList;
    }

    /**
     * @param Image $content
     */
    public function save(Image $image) {
        $file = $image->getImageFileObject();

        if ($file instanceof UploadedFile && $file->isValid()) {
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();

            $file->move(
                self::IMAGES_DIR,
                $fileName
            );
        }
    }
}