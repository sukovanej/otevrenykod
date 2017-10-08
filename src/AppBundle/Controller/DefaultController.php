<?php

namespace AppBundle\Controller;

use AppBundle\Model\PublishedModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(PublishedModel $publishedModel, Request $request)
    {
        return $this->render('default/index.html.twig', [
            "published_list" => $publishedModel->getList()
        ]);
    }
}
