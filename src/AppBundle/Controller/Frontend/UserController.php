<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 4.11.17
 * Time: 17:49
 */

namespace AppBundle\Controller\Frontend;


use AppBundle\Entity\User;
use AppBundle\Form\UserEditFormType;
use AppBundle\Model\PublishedModel;
use AppBundle\Model\UserModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller  {
    /**
     * @Route("uzivatel/zobrazit/{username}", name="user_view")
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
    public function editAction(UserModel $userModel, Request $request) {
        /** @var User $user */
        $user = $this->getUser();

        $editForm = $this->createForm(UserEditFormType::class, $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $userModel->merge($user);
        }

        return $this->render("default/user/edit.html.twig", [
            "user" => $user,
            "edit_form" => $editForm->createView()
        ]);
    }
}