<?php

namespace AppBundle\Form;

use AppBundle\Service\CountryGenerator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    /**
     * @var CountryGenerator
     */
    private $country;

    public function __construct()
    {
        $this->country = new CountryGenerator();
    }

    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('country', ChoiceType::class, [
            'choices' => $this->country->getCountryNames(),
            'choice_label' => function($value, $key, $index) {
                    return $value;
            }
        ]);

        $builder->add('currency', ChoiceType::class, [
           'choices' => $this->country->getCurrencies(),
           'choice_label' => function($value, $key, $index) {
                return $value;
           }
        ]);
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'app_bundle_registration';
    }

}
