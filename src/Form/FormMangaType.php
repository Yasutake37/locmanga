<?php

namespace App\Form;

use App\Entity\Commande;
use App\Entity\Manga;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class FormMangaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('nom', TextType::class, [
                'required' => true
            ])
            ->add('email', EmailType::class, [
                'required' => true
            ])
            ->add('manga', EntityType::class,
            [
                //mapping classe Manga
                'class' => Manga::class,
                //pas de choix multiple
                'multiple' => false,
                //selecteur simple
                'expanded' => false,
                //champ requis
                'required' => true
                //pas de choice_label : la méthode __toString est appelée
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
