<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Payment;
use AppBundle\Form\PaymentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PaymentController extends Controller
{
    public function newAction(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY', null, 'Unable to access this page!');
        $payment = $this->getDoctrine()->getRepository('AppBundle:Payment');
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
            'paymentForm' => $form->createView(),
            'paymentMethodList' => $payment->findAllPaymentMethods()
        ]);
    }


    public function editAction(Request $request, Payment $payment)
    {
        $form = $this->createForm(PaymentType::class, $payment);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $payment = $form->getData();
            $paymentDate = (array)$payment->getCreatedAt();

            $em = $this->getDoctrine()->getManager();
            $em->persist($payment);
            $em->flush();

            return new JsonResponse(
                [
                'name'=>$payment->getName(),
                'createdAt' => $paymentDate['date']
                ]
            );
        }

        return $this->render('payment/edit.html.twig', [
           'paymentForm' => $form->createView()
        ]);
    }

    public function deleteAction(Payment $payment)
    {
        if (!$payment) {
            return new JsonResponse(['status' => false]);
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($payment);
        $em->flush();
        return new JsonResponse(['status' => true]);
    }

}
