<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class CategoryController extends Controller
{
    public function newAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $transaction = $this->getDoctrine()->getRepository('AppBundle:Transaction');

        $form = $this->createForm(CategoryType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();
            $category->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            $this->addFlash('success', 'New category has been created');


            return $this->redirectToRoute('homepage_main');
        }

        return $this->render('category/index.html.twig', [
            'categoryForm' => $form->createView(),
            'transactionDetails' => $transaction->findAllTransactionDetailsGroupedByName()
        ]);
    }

    public function editAction(Request $request, Category $category)
    {
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $category = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return new JsonResponse(['name' => $category->getName()]);
        }
    }

    public function deleteAction(Category $category)
    {
        if (!$category) {
            throw $this->createNotFoundException('No category found');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();

        return $this->redirectToRoute('category_new');
    }
}
