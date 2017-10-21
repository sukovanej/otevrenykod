<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 21.10.17
 * Time: 12:55
 */

namespace AppBundle\Model;


use AppBundle\Entity\User;
use AppBundle\Repository\UserRepository;

class UserModel extends EntityManagerModel {
    /**
     * @return UserRepository
     */
    public function getUserRepository(): UserRepository {
        return $this->getEntityManager()->getRepository(User::class);
    }

    /**
     * @param User $comment
     */
    public function save(User $comment) {
        $this->getUserRepository()->save($comment);
    }

    /**
     * @return User[]
     */
    public function getList() {
        return $this->getUserRepository()->findAll();
    }

    /**
     * @param $ip
     */
    public function getOrCreateAnonym($ip) {
        $repo = $this->getUserRepository();
        $user = $repo->findOneBy(["username" => $ip]);

        if (!($user instanceof User)) {
            $user = new User();
            $user->setPassword(md5(random_int(0, 1000)));
            $user->setEmail("unknown");
            $user->setUsername($ip);
        }

        $repo->save($user);
        return $user;
    }
}