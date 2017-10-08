<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 24.9.17
 * Time: 21:08
 */

namespace AppBundle\Model;


use Doctrine\ORM\EntityManagerInterface;

class EntityManagerModel {
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * ProductParameterModel constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager) {
        $this->setEntityManager($entityManager);
    }

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function setEntityManager(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * @return EntityManagerInterface
     */
    public function getEntityManager(): EntityManagerInterface {
        return $this->entityManager;
    }

}