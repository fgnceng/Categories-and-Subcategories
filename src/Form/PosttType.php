<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class PosttType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('category', EntityType::class, [
                'class' => 'App\Entity\Category',
                'placeholder' => 'Select a category',
                'mapped' => false,
            ])
            ->add('save', SubmitType::class, array(
                    'label' => 'İleri',
                    'attr' => array('class' => 'save')
                )
            );


        $builder->get('category')->addEventListener(
            FormEvents::class,
            function (FormEvent $event) {
                $form = $event->getForm();
                $form->getParent()->add('sub_category', EntityType::class, [
                    'class' => 'App\Entity\Subcategory',
                    'placeholder' => 'Please select a sub category',
                    'choices' => $form->getData()->getSubcategories(),

                ]);
            }
        );


    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }

}