<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 4.11.17
 * Time: 17:49
 */

namespace AppBundle\Controller\Frontend;


use AppBundle\Entity\User;
use AppBundle\Model\PublishedModel;
use AppBundle\Model\UserModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller  {
    /**
     * @Route("uzivatel/{username}", name="user_view")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(UserModel $userModel, PublishedModel $publishedModel, $username) {
        $user = $userModel->getByUsername($username);

        return $this->render("default/user/view.html.twig", [
            "published_list" => $publishedModel->getByUser($user),
            "user" => $user
        ]);
    }

    /**
     * @Route("uzivatel/upravit", name="user_edit")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction(UserModel $userModel) {
        /** @var User $user */
        $user = $this->getUser();

        return $this->render("default/user/view.html.twig", [
            "user" => $user
        ]);
    }
}