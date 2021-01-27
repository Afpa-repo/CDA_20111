<?php

namespace App\Form;

use App\Entity\PointRetrait;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PointRetraitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', null, [
                'label'=>'Nom',
                'required'=>true,
                'help'=>'exemple: la Mairie de Pont-De-Metz'
            ])
            ->add('adresse', null, ['label'=>'Adresse', 'required'=>true])
            ->add('cp', null, ['label'=>'Code Postal', 'required'=>true])
            ->add('ville', null, ['label'=>'Ville', 'required'=>true])
            ->add('description', TextareaType::class, ['label'=>'Description'])
            ->add('image',FileType::class, [
                'label'=>'Image',
                'help'=>'Seules les photos au format JPG, JPEG ou PNG seront acceptées. 500Ko max.',
                'required'=>false
            ])
            ->add('ouverture',ChoiceType::class, [
                'choices'=> $this->getChoices(PointRetrait::HORAIRES),
                'label'=> 'de',
                'required'=>true
            ])
            ->add('fermeture',ChoiceType::class,[
                'choices'=> $this->getChoices(PointRetrait::HORAIRES),
                'label'=> 'à',
                'required'=>true
            ])
            ->add('jour',ChoiceType::class, [
                'choices'=>$this->getChoices(PointRetrait::JOURS),
                'label'=>'Le',
                'required'=>true])
            ->add('email',EmailType::class, ['label'=>'Email', 'required'=>true])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PointRetrait::class,
        ]);
    }

    private function getChoices(array $choices)
    {
        $output = [];
        foreach($choices as $k=>$v):
            $output[$v] = $k;
        endforeach;
        return $output;
    }

}
