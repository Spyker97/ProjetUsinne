<?php

namespace App\Controller;

use App\Entity\ProduitName;
use App\Form\ProduitNameType;
use App\Repository\ProduitNameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/produit_name")
 */
class ProduitNameController extends AbstractController
{
    /**
     * @Route("/", name="app_produit_name_index", methods={"GET"})
     */
    public function index(ProduitNameRepository $produitNameRepository): Response
    {
        return $this->render('produit_name/index.html.twig', [
            'produit_names' => $produitNameRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_produit_name_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ProduitNameRepository $produitNameRepository): Response
    {
        $produitName = new ProduitName();
        $form = $this->createForm(ProduitNameType::class, $produitName);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $produitNameRepository->add($produitName, true);

            return $this->redirectToRoute('app_produit_name_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produit_name/new.html.twig', [
            'produit_name' => $produitName,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_produit_name_show", methods={"GET"})
     */
    public function show(ProduitName $produitName): Response
    {
        return $this->render('produit_name/show.html.twig', [
            'produit_name' => $produitName,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_produit_name_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ProduitName $produitName, ProduitNameRepository $produitNameRepository): Response
    {
        $form = $this->createForm(ProduitNameType::class, $produitName);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $produitNameRepository->add($produitName, true);

            return $this->redirectToRoute('app_produit_name_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produit_name/edit.html.twig', [
            'produit_name' => $produitName,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_produit_name_delete", methods={"POST"})
     */
    public function delete(Request $request, ProduitName $produitName, ProduitNameRepository $produitNameRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produitName->getId(), $request->request->get('_token'))) {
            $produitNameRepository->remove($produitName, true);
        }

        return $this->redirectToRoute('app_produit_name_index', [], Response::HTTP_SEE_OTHER);
    }
}
