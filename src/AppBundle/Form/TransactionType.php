<?php

namespace AppBundle\Form;

use AppBundle\Entity\Category;
use AppBundle\Entity\Payment;
use AppBundle\Entity\User;
use AppBundle\Form\DataTransformer\UserToIdTransformer;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\PaymentRepository;
use Doctrine\ORM\EntityManager;
use function Sodium\add;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransactionType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $user= $options['data'];

//        dump($user);die;
        $builder
            ->add('category', EntityType::class, [
                'placeholder' => 'Choose a category',
                'class' => Category::class,
                'query_builder' => function(CategoryRepository $categoryRepository) use ($user) {
                    return $categoryRepository->findAllCategoriesOrderedByName($user);
                },
                'label' => false
            ])
            ->add('amount', NumberType::class, [
                'scale' => 8,
                'label' => false
            ])
            ->add('payment', EntityType::class, [
                'placeholder' => 'Choose payment method',
                'class' => Payment::class,
                'query_builder' => function(PaymentRepository $paymentRepository) {
                    return $paymentRepository->findAllPaymentMethodsOrderedByName();
                },
                'label' => false
            ])
            ->add('comment', TextType::class, [
                'label' => false
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class' => 'AppBundle\Entity\Transaction',

        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_transaction_type';
    }
}
