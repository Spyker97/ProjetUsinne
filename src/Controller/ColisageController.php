<?php

namespace App\Controller;

use App\Entity\Colisage;
use App\Form\ColisageType;
use App\Repository\ColisageRepository;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/colisage")
 */
class ColisageController extends AbstractController
{
    /**
     * @Route("/", name="app_colisage_index", methods={"GET"})
     */
    public function index(ColisageRepository $colisageRepository , ProduitRepository $prod): Response
    {




        return $this->render('colisage/index.html.twig', [
            'colisages' => $prod->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_colisage_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ColisageRepository $colisageRepository): Response
    {
        $colisage = new Colisage();
        $form = $this->createForm(ColisageType::class, $colisage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $volume = 1 / $colisage->getNumOF()->getVolume() ;

            $numColi = round($volume * $colisage->getNumOF()->getQteExpedie());
            $colisage->getNumOF()->getProduitName()->getProduitName();
            $colisage->setNumColi($numColi);
            $qteExpd = $colisage->getNumOF()->getQteExpedie();
            $colisage->setQuantite($qteExpd);
            $colisage->setReference($colisage->getNumOF()->getRefPrincipale());
            $colisage->setPoidColi($colisage->getNumOF()->getPoid() *$colisage->getNumOF()->getQteExpedie() );
            $colisageRepository->add($colisage, true);

            return $this->redirectToRoute('app_colisage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('colisage/new.html.twig', [
            'colisage' => $colisage,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_colisage_show", methods={"GET"})
     */
    public function show(Colisage $colisage): Response
    {
        return $this->render('colisage/show.html.twig', [
            'colisage' => $colisage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_colisage_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Colisage $colisage, ColisageRepository $colisageRepository): Response
    {
        $form = $this->createForm(ColisageType::class, $colisage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $colisageRepository->add($colisage, true);

            return $this->redirectToRoute('app_colisage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('colisage/edit.html.twig', [
            'colisage' => $colisage,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_colisage_delete", methods={"POST"})
     */
    public function delete(Request $request, Colisage $colisage, ColisageRepository $colisageRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$colisage->getId(), $request->request->get('_token'))) {
            $colisageRepository->remove($colisage, true);
        }

        return $this->redirectToRoute('app_colisage_index', [], Response::HTTP_SEE_OTHER);
    }


    public function calcule (ProduitRepository $poidunitaire ){


    }
}
