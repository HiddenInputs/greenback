<?php

namespace AppBundle\Controller;

use AppBundle\Form\TransactionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\Request;

class TransactionController extends Controller
{
    public function newAction(Request $request)
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY', null, 'Unable to access this page!');
        $form = $this->createForm(TransactionType::class, $this->getUser());
        $transaction = $this->getDoctrine()->getRepository('AppBundle:Transaction');

        $transactionDateForm = $this->createTransactionBetweenDatesForm();

        $viewParams =   [
            'transactionForm' => $form->createView(),
            'transactionList' => $transaction->findAllTransactionsOrderedByCategoryName(),
            'transactionBetweenDatesForm' => $this->createTransactionBetweenDatesForm()->createView()
        ];

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $transactionDateForm->handleRequest($request);

            if ($form->isSubmitted()) {
                $transaction = $form->getData();
                $transaction->setUser($this->getUser());
                $em = $this->getDoctrine()->getManager();
                $em->persist($transaction);
                $em->flush();

                return $this->redirectToRoute('homepage_main');
            } else if ($transactionDateForm->isSubmitted()) {
                $dateForm = $request->request->get('form');
                $dateRange = explode(' , ',$dateForm['dateRange']);
                $transaction = $this->getDoctrine()->getRepository('AppBundle:Transaction');

                if(!empty($dateRange[0] && !empty($dateRange[1]))) {
                    $viewParams['transactionRange'] = $transaction->findAllTransactionsBetweenSelectedDates($dateRange[0],$dateRange[1]);
                }
            }

        }

        return $this->render('transaction/new.html.twig',$viewParams);
    }

    private function createTransactionBetweenDatesForm()
    {
        $defaultData = ['message' => 'Select transaction in dates'];
        $transactionBetweenDatesForm = $this->createFormBuilder($defaultData)
            ->add('dateRange', DateType::class, [
                'widget' => 'single_text',
                'html5' => false
            ])
            ->getForm();

        return $transactionBetweenDatesForm;
    }
}
