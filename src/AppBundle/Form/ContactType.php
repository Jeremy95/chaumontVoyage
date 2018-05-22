<?php

namespace AppBundle\Form;

use Symfony\Component\DependencyInjection\Tests\Compiler\D;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', ChoiceType::class,
                array('label' => 'Titre',
                    'choices' => array(
                        'Mr' => 'Mr',
                        'Mme' => 'Mme',
                        'Mlle' => 'Mlle',
                    ), 'attr' => array('class' => 'form-control form-control-sm'))
            )
            ->add('name', TextType::class,
                array('label' => 'Nom', 'attr' => array('class' => 'form-control form-control-sm'))
            )
            ->add('nickname', TextType::class,
                array('label' => 'Prénom', 'attr' => array('class' => 'form-control form-control-sm'))
            )
            ->add('phone', TextType::class,
                array('label' => 'Tél :', 'attr' => array('class' => 'form-control form-control-sm'))
            )
            ->add('email', TextType::class,
                array('label' => 'Email', 'attr' => array('class' => 'form-control form-control-sm'))
            )
            ->add('society', TextType::class,
                array('label' => 'Société', 'attr' => array('class' => 'form-control form-control-sm'))
            )
            ->add('comments', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('submit', SubmitType::class,
                array('label' => 'Envoyer', 'attr' => array('class' => 'btn btn-primary post-form-button form-control form-control-sm'))
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Contact'
        ));
    }
}
