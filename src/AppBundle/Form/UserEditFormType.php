<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 4.11.17
 * Time: 18:38
 */

namespace AppBundle\Form;


use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserEditFormType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->getData()->__construct();

        $builder
            ->add("imageFileObject", FileType::class, [
                "required" => false
            ])
            ->add("submit", SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            "data_class" => User::class
        ]);
    }
}