<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 6.11.17
 * Time: 23:48
 */

namespace AppBundle\Controller\Admin;


use AppBundle\Model\UserModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller {

    /**
     * @Route("admin/uzivatele", name="admin_users")
     */
    public function indexAction(UserModel $userModel) {
        return $this->render("admin/user/list.html.twig", [
            "user_list" => $userModel->getList()
        ]);
    }
}