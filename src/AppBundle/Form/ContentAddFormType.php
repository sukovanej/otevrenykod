<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 24.9.17
 * Time: 20:27
 */

namespace AppBundle\Form;


use AppBundle\Entity\Content;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContentAddFormType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add("title", TextType::class)
            ->add("perex", TextAreaType::class)
            ->add("content", TextAreaType::class)
            ->add("submit", SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            "data_class" => Content::class
        ]);
    }
}