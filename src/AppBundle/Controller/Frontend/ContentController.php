<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 6.10.17
 * Time: 21:34
 */

namespace AppBundle\Controller\Frontend;


use AppBundle\Model\PublishedModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class ContentController extends Controller {
    /**
     * @Route("content/{url}", name="content")
     */
    public function indexAction(PublishedModel $publishedModel, $url) {
        return $this->render(":default:content.html.twig", [
            "content" => $publishedModel->getByUrl($url)
        ]);
    }

    /**
     * @Route("content/{url}/comments, name="content_comments")
     */
    public function commentsAction(PublishedModel $publishedModel, CommentModel $commentModel, $url) {
        $content = $publishedModel->getByUrl($url)->getContent();

        return $this->render("");
    }
}