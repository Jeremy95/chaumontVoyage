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

class AccueilType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titleOne', TextType::class, [
                    'label' => 'Titre',
                    'required' => false,
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add('imageOne', FileType::class, [
                    'label' => 'Choisissez une image',
                    'required' => false,
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add('contentOne', TextareaType::class, [
                    'label' => 'Contenu',
                    'required' => false,
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add('titleTwo', TextType::class, [
                    'label' => 'Titre',
                    'required' => false,
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add('imageTwo', FileType::class, [
                    'label' => 'Choisissez une image',
                    'required' => false,
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add('contentTwo', TextareaType::class, [
                    'label' => 'Contenu',
                    'required' => false,
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add('titleThree', TextType::class, [
                    'label' => 'Titre',
                    'required' => false,
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add('subtitleThree', TextType::class, [
                    'label' => 'Sous-Titre',
                    'required' => false,
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add('contentThree', TextareaType::class, [
                    'label' => 'Contenu',
                    'required' => false,
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add('submit', SubmitType::class,
                array('label' => 'Envoyer', 'attr' => array('class' => 'button button-3d nomargin'))
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null
        ));
    }
}
