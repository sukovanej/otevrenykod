<?php

namespace AppBundle\Controller;

use AppBundle\Model\PublishedModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    const CONTENT_PER_PAGE = 10;

    /**
     * @Route("/{page}", name="homepage")
     */
    public function indexAction(PublishedModel $publishedModel, Request $request, $page = 0)
    {
        $count = $publishedModel->getCountHomepageList();
        $content = $publishedModel->getHomepageList($page * self::CONTENT_PER_PAGE, self::CONTENT_PER_PAGE);

        return $this->render('default/index.html.twig', [
            "published_list" => $content,
            "content_per_page" => self::CONTENT_PER_PAGE,
            "count" => $count
        ]);
    }
}
