<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 12.11.17
 * Time: 18:18
 */

namespace AppBundle\Controller\Admin;


use AppBundle\Entity\Image;
use AppBundle\Form\ImageFormType;
use AppBundle\Model\ImageModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ImageController extends Controller {
    /**
     * @Route("admin/obrazky", name="admin_images")
     */
    public function imagesAction(ImageModel $imageModel, Request $request) {
        $imageList = $imageModel->getList();
        $image = new Image();

        $imageForm = $this->createForm(ImageFormType::class, $image);
        $imageForm->handleRequest($request);

        if ($imageForm->isSubmitted() && $imageForm->isValid()) {
            $imageModel->save($image);
            $this->addFlash("sucess", "Obrázek úspěšně nahrán.");

            return $this->redirectToRoute("admin_images");
        }

        return $this->render("admin/image/images.html.twig", [
            "image_list" => $imageList,
            "image_form" => $imageForm->createView()
        ]);
    }
}