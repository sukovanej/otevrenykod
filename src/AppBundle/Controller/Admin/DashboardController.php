<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 9/23/17
 * Time: 3:24 PM
 */

namespace AppBundle\Controller\Admin;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends Controller
{
    /**
     * @Route("admin", name="admin")
     */
    public function indexAction() {
        return $this->render("admin/index.html.twig", []);
    }
}