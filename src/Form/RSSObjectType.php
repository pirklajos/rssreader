<?php

namespace App\Form;

use App\Entity\RSSObject;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RSSObjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('url', null, ['required' => true])
            ->add('active')
            /*->add('userid', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',
                'value'=> 4,
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RSSObject::class,
        ]);
    }
}
