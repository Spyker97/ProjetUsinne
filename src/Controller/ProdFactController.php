<?php

namespace App\Controller;

use App\Entity\ProdFact;
use App\Form\ProdFactType;
use App\Repository\ProdFactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/prod/fact")
 */
class ProdFactController extends AbstractController
{
    /**
     * @Route("/", name="app_prod_fact_index", methods={"GET"})
     */
    public function index(ProdFactRepository $prodFactRepository): Response
    {
        return $this->render('prod_fact/index.html.twig', [
            'prod_facts' => $prodFactRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_prod_fact_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ProdFactRepository $prodFactRepository): Response
    {
        $prodFact = new ProdFact();
        $form = $this->createForm(ProdFactType::class, $prodFact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $prodFactRepository->add($prodFact, true);

            return $this->redirectToRoute('app_prod_fact_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('prod_fact/new.html.twig', [
            'prod_fact' => $prodFact,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_prod_fact_show", methods={"GET"})
     */
    public function show(ProdFact $prodFact): Response
    {
        return $this->render('prod_fact/show.html.twig', [
            'prod_fact' => $prodFact,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_prod_fact_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ProdFact $prodFact, ProdFactRepository $prodFactRepository): Response
    {
        $form = $this->createForm(ProdFactType::class, $prodFact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $prodFactRepository->add($prodFact, true);

            return $this->redirectToRoute('app_facture_show', ['id'=>$prodFact->getFactId()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('prod_fact/edit.html.twig', [
            'prod_fact' => $prodFact,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_prod_fact_delete", methods={"POST"})
     */
    public function delete(Request $request, ProdFact $prodFact, ProdFactRepository $prodFactRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$prodFact->getId(), $request->request->get('_token'))) {
            $prodFactRepository->remove($prodFact, true);
        }

        return $this->redirectToRoute('app_prod_fact_index', [], Response::HTTP_SEE_OTHER);
    }
}
