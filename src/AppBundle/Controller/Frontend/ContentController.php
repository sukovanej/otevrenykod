<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 6.10.17
 * Time: 21:34
 */

namespace AppBundle\Controller\Frontend;


use AppBundle\Entity\Comment;
use AppBundle\Entity\User;
use AppBundle\Form\CommentAddFormType;
use AppBundle\Model\CommentModel;
use AppBundle\Model\PublishedModel;
use AppBundle\Model\UserModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContentController extends Controller {

    /**
     * @Route("obsah/{url}", name="content")
     */
    public function indexAction(PublishedModel $publishedModel, $url) {
        return $this->render(":default:content.html.twig", [
            "content" => $publishedModel->getByUrl($url)
        ]);
    }

    /**
     * @Route("obsah/{url}/nazory", name="content_comments")
     */
    public function commentsAction(UserModel $userModel, PublishedModel $publishedModel, CommentModel $commentModel,
                                             Request $request, $url) {
        $content = $publishedModel->getByUrl($url);

        $comment = new Comment();
        $comment->setParent(null);
        $comment->setContent(null);

        $addCommentForm = $this->createForm(CommentAddFormType::class, $comment);
        $addCommentForm->handleRequest($request);

        if ($addCommentForm->isSubmitted() && $addCommentForm->isValid()) {
            if ($comment->getParent() == null) {
                $comment->setContent($content);
            } else {
                $comment->setParent($commentModel->getById($comment->getParent()));
            }

            $user = $this->getUser();

            if (!($user instanceof User)) {
                $user = $userModel->getOrCreateAnonym($request->getClientIp());
            }

            $comment->setAuthor($user);

            $commentModel->save($comment);
            $this->addFlash("success", "Komentář vytvořen");

            return $this->redirectToRoute("content_comments", ["url" => $url]);
        }

        return $this->render("default/comment/comments.html.twig", [
            "comments" => $commentModel->getListByContent($content),
            "content" => $content,
            "add_form" => $addCommentForm->createView()
        ]);
    }

    /**
     * @Route("content/{url}/comments", name="content_comments_deprecated")
     */
    public function commentsActionDeprecated(UserModel $userModel, PublishedModel $publishedModel, CommentModel $commentModel,
                                   Request $request, $url) {
        return $this->commentsAction($userModel, $publishedModel, $commentModel, $request, $url);
    }

    /**
     * @Route("content/{url}", name="content_deprecated")
     */
    public function indexActionDeprecated(PublishedModel $publishedModel, $url) {
        return $this->indexAction($publishedModel, $url);
    }

}