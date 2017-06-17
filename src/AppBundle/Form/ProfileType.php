<?php
/**
 * Created by PhpStorm.
 * User: tomek
 * Date: 17.06.17
 * Time: 21:24
 */

namespace AppBundle\Form;


use AppBundle\Entity\User;
use FOS\UserBundle\Form\Type\ProfileFormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $profileFormType = new ProfileFormType(User::class);
        $profileFormType->buildForm($builder,$options);
        $builder
            ->add('country')
            ->add('currency');
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }

    public function getBlockPrefix()
    {
        return 'fos_user_profile';
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class
        ));
    }
}