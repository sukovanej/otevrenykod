<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Content;
use AppBundle\Model\ContentModel;
use AppBundle\Model\PublishedModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    const CONTENT_PER_PAGE = 10;
    const CONTENT_SHARED_PER_PAGE = 10;

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(PublishedModel $publishedModel, Request $request)
    {
        return $this->indexArticlesAction($publishedModel, $request, 0);
    }

    /**
     * @Route("/clanky/{page}", name="articles")
     */
    public function indexArticlesAction(PublishedModel $publishedModel, Request $request, $page)
    {
        $count = $publishedModel->getCountHomepageList();
        $content = $publishedModel->getHomepageList($page * self::CONTENT_PER_PAGE, self::CONTENT_PER_PAGE);
        $content_shared = $publishedModel->getHomepageSharedList(self::CONTENT_SHARED_PER_PAGE);

        return $this->render('default/index.html.twig', [
            "published_list" => $content,
            "published_shared" => $content_shared,
            "content_per_page" => self::CONTENT_PER_PAGE,
            "count" => $count,
        ]);
    }

    /**
     * @Route("/ajax/search", name="ajax_search")
     */
    public function ajaxSearch(ContentModel $contentModel) {
        $list = $contentModel->getList();

        /** @var Content $value */
        foreach ($list as $value) {
            $json_result[] = $value->getTitle();
        }

        $response = new Response(json_encode($json_result));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/vyhledavani", name="search")
     */
    public function resultSearchAction(Request $request, ContentModel $contentModel) {
        $list = [];

        if (($value = $request->get("value")) != null) {
            $list = $contentModel->search($value);
        }

        return $this->render("default/search.html.twig", [
            "content_list" => $list
        ]);
    }
}
