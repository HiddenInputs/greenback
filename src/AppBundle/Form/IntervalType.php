<?php

namespace AppBundle\Form;

use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IntervalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('transactionDate',DateTime::class, [
           'placeholder' => 'Select your transactions'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class' => null
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_interval_type';
    }
}
