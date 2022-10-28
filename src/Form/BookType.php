<?php

namespace App\Form;

use App\Entity\Autor;
use App\Entity\Book;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cote', TextType::class, [
                'label'=>'Cote du livre'
                ])
            ->add('name')
            ->add('type')
            ->add('avalaible')
            ->add('borrowable')
            ->add('description')
            ->add('createdAt')
            ->add('volume')
            ->add('nbrPage')
            ->add('title')
            ->add('autors', EntityType::class, [
                'class'=>Autor::class,
                'expanded'=>true ,
                'multiple'=> true,
                'label'=> 'Auteur'
            ])

        ;
      //  https://symfony.com/doc/current/reference/forms/types/entity.html#query-builder
        //configuration
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
