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

class AutocarsTtiType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageSlider', FileType::class, [
                    'label' => 'Image slider',
                    'required' => false,
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add('title', TextType::class, [
                    'label' => 'Titre 1',
                    'required' => false,
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add('titleOne', TextType::class, [
                    'label' => 'Titre 1',
                    'required' => false,
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add('contentOne', TextType::class, [
                    'label' => 'Contenu 1',
                    'required' => false,
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add('imageOne', FileType::class, [
                    'label' => 'Image 1',
                    'required' => false,
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add('titleTwo', TextType::class, [
                    'label' => 'Titre 2',
                    'required' => false,
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add('contentTwo', TextType::class, [
                    'label' => 'Contenu 2',
                    'required' => false,
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add('imageTwo', FileType::class, [
                    'label' => 'Image 2',
                    'required' => false,
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add('titleThree', TextType::class, [
                    'label' => 'Titre 3',
                    'required' => false,
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add('contentThree', TextType::class, [
                    'label' => 'Contenu 3',
                    'required' => false,
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add('imageThree', FileType::class, [
                    'label' => 'Image 3',
                    'required' => false,
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add('contentVideo', TextType::class, [
                    'label' => 'Contenu texte vidéo',
                    'required' => false,
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add('sliderVideo', TextType::class, [
                    'label' => 'Url vidéo',
                    'required' => false,
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add('titleFour', TextType::class, [
                    'label' => 'Titre 4',
                    'required' => false,
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add('contentFour', TextType::class, [
                    'label' => 'Contenu 4',
                    'required' => false,
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add('imageFour', FileType::class, [
                    'label' => 'Image 4',
                    'required' => false,
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add('titleFive', TextType::class, [
                    'label' => 'Titre 5',
                    'required' => false,
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add('contentFive', TextType::class, [
                    'label' => 'Contenu 5',
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
