<?php

namespace AppBundle\Form;

use AppBundle\Entity\Category;
use AppBundle\Entity\Payment;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\PaymentRepository;
use function Sodium\add;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransactionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', EntityType::class, [
                'placeholder' => 'Choose a category',
                'class' => Category::class,
                'query_builder' => function(CategoryRepository $categoryRepository) {
                    return $categoryRepository->findAllCategoriesOrderedByName();
                }
            ])
            ->add('amount', NumberType::class, [
                'scale' => 8
            ])
            ->add('payment', EntityType::class, [
                'placeholder' => 'Choose payment method',
                'class' => Payment::class,
                'query_builder' => function(PaymentRepository $paymentRepository) {
                    return $paymentRepository->findAllPaymentMethodsOrderedByName();
                }
            ])
            ->add('comment', TextareaType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class' => 'AppBundle\Entity\Transaction'
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_transaction_type';
    }
}
