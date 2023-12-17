<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Dormitory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Dormitory1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('keywords')
            ->add('description')
            ->add('image')
            ->add('address')
            ->add('phone')
            ->add('email')
            ->add('city')
            ->add('status')
            ->add('created_at')
            ->add('updated_at')
            ->add('detail')
            ->add('userid')
            ->add('category', EntityType::class, [
                'class' => Category::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dormitory::class,
        ]);
    }
}
