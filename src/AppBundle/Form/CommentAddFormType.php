<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 20.10.17
 * Time: 20:56
 */

namespace AppBundle\Form;


use AppBundle\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentAddFormType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add("text", TextareaType::class, [
                "label" => false
            ])
            ->add("parent", HiddenType::class)
            ->add("submit", SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            "data_class" => Comment::class
        ]);
    }
}