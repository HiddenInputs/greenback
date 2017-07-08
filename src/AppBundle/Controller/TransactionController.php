<?php

namespace AppBundle\Controller;

use AppBundle\Form\TransactionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class TransactionController extends Controller
{
    public function newAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $form = $this->createForm(TransactionType::class);
        $transaction = $this->getDoctrine()->getRepository('AppBundle:Transaction');
        $form->handleRequest($request);
        $this->createTransactionBetweenDatesForm()->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $transaction = $form->getData();
            $transaction->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($transaction);
            $em->flush();

            return $this->redirectToRoute('homepage_main');
        }

        return $this->render('transaction/new.html.twig',[
            'transactionForm' => $form->createView(),
            'transactionList' => $transaction->findAllTransactionsOrderedByCategoryName(),
            'transactionBetweenDatesForm' => $this->createTransactionBetweenDatesForm()->createView()
        ]);
    }


    private function createTransactionBetweenDatesForm()
    {
        $defaultData = ['message' => 'Select transaction in dates'];
        $transactionBetweenDatesForm = $this->createFormBuilder($defaultData)
            ->add('dateInterval', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'data-range' =>true,
                    'data-multiple-dates-separator'=> " - ",
                    'data-language'=>'en',
                    'class' => 'js-datepicker',
                ],
                'html5' => false
            ])
            ->add('send', SubmitType::class)
            ->getForm();

        return $transactionBetweenDatesForm;
    }
}
