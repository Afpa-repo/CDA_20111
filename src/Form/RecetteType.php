<?php

namespace App\Form;

use App\Entity\Recette;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('descr',TextareaType::class, ['label'=>'Description'])
            ->add('photo')
            ->add('tpsPrep',TextType::class, ['label'=> 'Temps de préparation'])
            ->add('tpsCuisson',TextType::class, ['label'=> 'Temps de cuisson'])
            ->add('portion')
            ->add('difficulte',CheckboxType::class, ['label'=> 'Difficulté'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recette::class,
        ]);
    }
}
