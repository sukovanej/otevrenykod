<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 24.9.17
 * Time: 20:25
 */

namespace AppBundle\Controller\Admin;


use AppBundle\Entity\Content;
use AppBundle\Entity\Image;
use AppBundle\Entity\Published;
use AppBundle\Form\ContentAddFormType;
use AppBundle\Form\ContentPublishFormType;
use AppBundle\Model\ContentModel;
use AppBundle\Model\PublishedModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\TranslatorInterface;

class ContentController extends Controller {
    /**
     * @Route("admin/obsah/pridat", name="admin_content_add")
     * @param ContentModel $contentModel
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function add(ContentModel $contentModel, Request $request, TranslatorInterface $translator) {
        $content = new Content();

        $addContentForm = $this->createForm(ContentAddFormType::class, $content);
        $addContentForm->handleRequest($request);

        if($addContentForm->isSubmitted() && $addContentForm->isValid()) {
            $content->setAuthor($this->getUser());
            $contentModel->save($content);

            $this->addFlash("success", $translator->trans("message.content_created"));
            return $this->redirectToRoute("admin_content_edit", ["id" => $content->getId()]);
        }

        return $this->render("admin/content/add.html.twig", [
            "add_content_form" =>$addContentForm->createView()
        ]);
    }

    /**
     * @Route("admin/obsah/upravit/{id}", name="admin_content_edit")
     */
    public function edit($id, ContentModel $contentModel, Request $request) {
        $content = $contentModel->getById($id);

        $editForm = $this->createForm(ContentAddFormType::class, $content);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $contentModel->merge($content);
        }

        return $this->render("admin/content/edit.html.twig", [
            "content" => $content,
            "edit_form" => $editForm->createView()
        ]);
    }

    /**
     * @Route("admin/obsah/publikovat/{id}", name="admin_content_publish")
     */
    public function publish($id, ContentModel $contentModel, PublishedModel $publishedModel, TranslatorInterface $trans,
                            Request $request) {
        $content = $contentModel->getById($id);
        $messages = [];

        $published = new Published();
        $published->setContent($content);

        $publishForm = $this->createForm(ContentPublishFormType::class, $published);
        $publishForm->handleRequest($request);

        if ($publishForm->isSubmitted() && $publishForm->isValid()) {
            if (empty(($content->getImage())) && $content->getType() != Content::TYPE_NEWS) {
                $messages[] = ["danger", $trans->trans("message.not_image")];
            } else {
                $publishedModel->save($published);

                $this->addFlash("success", $trans->trans("message.published_success"));
                return $this->redirectToRoute("admin");
            }
        }

        return $this->render("admin/content/publish.html.twig", [
            "publish_form" => $publishForm->createView(),
            "messages" => $messages
        ]);
    }

    /**
     * @Route("admin/obsah/preview/{content_id}", name="admin_content_preview")
     */
    public function preview($content_id, ContentModel $contentModel) {
        $content = $contentModel->getById($content_id);

        $published = new Published();
        $published->setContent($content);
        $published->setUrl("ahoj");
        $published->setDatetime(new \DateTime());

        return $this->render("admin/content/preview.html.twig", [
            "content" => $content,
            "published" => $published
        ]);
    }
}