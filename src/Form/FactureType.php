<?php

namespace App\Form;

use App\Entity\Facture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('civilite', ChoiceType::class, [
                'label'=>'Civilité',
                'required'=>true,
                'choices'=>$this->getChoices(Facture::CIVILITE)
            ])
            ->add('nom', null, ['label'=>'Nom', 'required'=>true])
            ->add('prenom', null, ['label'=>'Prénom', 'required'=>true])
            ->add('adresse1',null, ['label'=>'Adresse', 'required'=>true])
            ->add('adresse2',null, ['label'=>'Complément d\'adresse'])
            ->add('cp',null, ['label'=>'Code Postal', 'required'=>true])
            ->add('ville',null, ['label'=>'Ville', 'required'=>true])
            ->add('paiement', ChoiceType::class,[
                'label'=>'Moyen de Paiement',
                'required'=>true,
                'choices'=>$this->getChoices(Facture::PAIEMENT),
                'help'=> 'Vous serez redirigé vers la page du moyen de paiement que vous selectionnez.'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Facture::class,
        ]);
    }

    private function getChoices(array $choices): array
    {
        $output = [];
        foreach($choices as $k=>$v):
            $output[$v] = $k;
        endforeach;
        return $output;
    }
}
