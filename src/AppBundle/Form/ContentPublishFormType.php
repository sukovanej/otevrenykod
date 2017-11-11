<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 25.9.17
 * Time: 9:58
 */

namespace AppBundle\Form;


use AppBundle\Entity\Content;
use AppBundle\Entity\Published;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContentPublishFormType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        /** @var Published $data */
        $data = $builder->getData();

        if ($data->getContent()->getType() != Content::TYPE_SHARED)
        $builder
            ->add("url", TextType::class);

        $builder
            ->add("datetime", DateTimeType::class)
            ->add("submit", SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            "data_class" => Published::class
        ]);
    }
}