<?php

namespace App\Form;

use App\Entity\Cb;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CbType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', null, ['label'=>'Nom du titulaire de la carte',  'help'=>'exemple: Dupont', 'required'=>true])
            ->add('prenom', null, ['label'=>'Prénom du titulaire de la carte', 'help'=>'exemple: Henry', 'required'=>true])
            ->add('numero', null, ['label'=>'Numéro de la carte bancaire', 'required'=>true])
            ->add('date', null, ['label'=>'Date d\'expiration', 'required'=>true])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cb::class,
        ]);
    }
}
