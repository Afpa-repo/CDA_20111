<?php

namespace App\Form;


use App\Entity\Membre;
use App\Entity\Produit;
use App\Entity\Recette;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;



class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('descr')
            ->add('produit', EntityType::class, ['class'=> Produit::class, 'multiple'=> true, 'choice_label'=>'nom'])
            ->add('image_file', FileType::class, ['required'=> false])
            ->add('tpsPrep')
            ->add('tpsCuisson')
            ->add('portion')
            ->add('difficulte')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recette::class,
        ]);
    }
}
