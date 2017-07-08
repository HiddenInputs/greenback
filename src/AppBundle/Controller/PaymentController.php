<?php

namespace AppBundle\Controller;

use AppBundle\Form\PaymentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PaymentController extends Controller
{
    public function newAction(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY', null, 'Unable to access this page!');

        $form = $this->createForm(PaymentType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $payment = $form->getData();
            $payment->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($payment);
            $em->flush();

            return $this->redirectToRoute('homepage_main');
        }

        return $this->render('payment/new.html.twig',[
            'paymentForm' => $form->createView()
        ]);
    }
}
