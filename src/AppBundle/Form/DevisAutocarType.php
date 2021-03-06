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

class DevisAutocarType extends AbstractType
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
                array('label' => 'Nom de famille', 'attr' => array('class' => 'form-control form-control-sm'))
            )
            ->add('nickname', TextType::class,
                array('label' => 'Prénom', 'attr' => array('class' => 'form-control form-control-sm'))
            )
            ->add('phone', TextType::class,
                array('label' => 'Tél :', 'attr' => array('class' => 'form-control form-control-sm'))
            )
            ->add('address', TextType::class,
                array('label' => 'Adresse', 'attr' => array('class' => 'form-control form-control-sm'))
            )
            ->add('city', TextType::class,
                array('label' => 'Ville', 'attr' => array('class' => 'form-control form-control-sm'))
            )
            ->add('email', TextType::class,
                array('label' => 'Adresse de courriel', 'attr' => array('class' => 'form-control form-control-sm'))
            )
            ->add('society', TextType::class,
                array('label' => 'Société', 'attr' => array('class' => 'form-control form-control-sm'))
            )
            ->add('departDate', DateType::class,
                array('label' => 'Date de départ')
            )
            ->add('departHour', TimeType::class,
                array('label' => 'Heure de départ')
            )
            ->add('arrivedDate', DateType::class,
                array('label' => 'Date d\'arrivée')
            )
            ->add('arrivedHour', TimeType::class,
                array('label' => 'Heure d\'arrivée')
            )
            ->add('comments', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Commentaires'
            ])
            ->add('destination', TextType::class,
                array('label' => 'Destination', 'attr' => array('class' => 'form-control form-control-sm'))
            )
            ->add('equipment', ChoiceType::class,
                array(
                    'choices' => [
                        'Toilettes' => 'Toilettes',
                        'Couchettes' => 'Couchettes',
                        'Videos' => 'Videos',
                    ],
                    'multiple' => true,
                    'expanded' => true,
                    'label' => 'Equipements souhaités'
                )
            )
            ->add('capacity', IntegerType::class,
                array('label' => 'Capacité', 'attr' => array('class' => 'form-control form-control-sm'))
            )
            ->add('locationTake', TextType::class,
                array('label' => 'Lieu de prise en charge', 'attr' => array('class' => 'form-control form-control-sm'))
            )
            ->add('files', FileType::class,
                array('label' => 'Documents', 'attr' => array('class' => 'form-control form-control-sm'))
            )
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
            'data_class' => 'AppBundle\Entity\DevisAutocar'
        ));
    }
}
