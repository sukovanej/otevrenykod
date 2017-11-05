<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 24.9.17
 * Time: 20:27
 */

namespace AppBundle\Form;


use AppBundle\Entity\Category;
use AppBundle\Entity\Content;
use Norzechowicz\AceEditorBundle\Form\Extension\AceEditor\Type\AceEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContentAddFormType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->getData()->__construct();

        $builder
            ->add("title", TextType::class)
            ->add("type", ChoiceType::class, [
                "choices" => $builder->getData()->getTypes(),
                "choice_translation_domain" => "messages"
            ])
            ->add("category", EntityType::class, [
                "class" => Category::class,
                "choice_label" => function(Category $category) {
                    return $category->getName();
                },
                "required" => false
            ])
            ->add("perex", TextAreaType::class, [
                "required"=> false
            ])
            ->add("content", AceEditorType::class, [
                'mode' => 'ace/mode/html',
                'theme' => 'ace/theme/github',
//                'keyboard_handler' => 'ace/keyboard/vim',
            ])
            ->add("imageFileObject", FileType::class, [
                "required" => false
            ])
            ->add("submit", SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            "data_class" => Content::class
        ]);
    }
}