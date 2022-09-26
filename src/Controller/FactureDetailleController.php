<?php

namespace App\Controller;

use App\Entity\FactureDetaille;
use App\Entity\ProduitName;
use App\Form\FactureDetailleType;
use App\Repository\FactureDetailleRepository;
use App\Repository\ProduitNameRepository;
use App\Repository\ProduitRepository;
use App\Repository\SocieteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/facturedett")
 */
class FactureDetailleController extends AbstractController
{
    /**
     * @Route("/global", name="app_facture", methods={"GET"})
     */
    public function index2(FactureDetailleRepository $factureDetailleRepository, ProduitRepository $prod, ProduitNameRepository $prodName): Response
    {
        $dd = array();

        foreach ($prodName->findAll() as $pN) {
            $chifAff = 0;
            $qteTot = 0;
            $prixU = 0;
            $facDett = new FactureDetaille();

            foreach ($prod->findAll() as $p) {
                if ($p->getProduitName()->getProduitName() == $pN->getProduitName()) {
                    $chifAff += ($p->getQteExpedie() * $p->getPU());
                    $qteTot += $p->getQteExpedie();
                }
            }
            if($qteTot== 0)
                $prixU=0;
            else
            $prixU = $chifAff / $qteTot;
            $facDett->setChiffreAffaire($chifAff);
            $facDett->setPrixTotal($qteTot);
            $facDett->setProduitName($pN->getProduitName());
            $facDett->setPuTotal($prixU);
            array_push($dd, $facDett);
        }


        return $this->render('facture_detaille/index2.html.twig', [
            'facture_detailles' => $dd,
        ]);
    }

    /**
     * @Route("/societe/global", name="app_facture_societe", methods={"GET"})
     */
    public function index3(FactureDetailleRepository $factureDetailleRepository, ProduitRepository $prod, ProduitNameRepository $prodName, SocieteRepository $societe): Response
    {
        $dd = array();

        $fcd = new FactureDetaille() ;
        foreach ($societe->findAll() as $so) {

            foreach ($prodName->findAll() as $pn){
                $total=0;
                $qttotal = 0 ;
                foreach ($so->getProdFacts() as $pf){
                        if($pn->getProduitName() == $pf->getProdId()->getProduitName()->getProduitName()){
                            $qttotal =$qttotal+ $pf->getQuantity();
                            $total = $total +($pf->getProdId()->getPU() * $pf->getQuantity());
                        }
                }

                $fcd->setPu($total);
                $fcd->setRefPrincipale($so->getName());
                $fcd->setQteExpedie($qttotal);
                $fcd->setProduitName($pn->getProduitName());
                array_push($dd, $fcd);
            }

        }
            return $this->render('facture_detaille/hh.html.twig', [
                'facture_detailles' => $dd,
                'societe' => $societe->findAll(),
            ]);
        }

    /**
     * @Route("/", name="app_facture_detaille_index", methods={"GET"})
     */
    public function index(FactureDetailleRepository $factureDetailleRepository, ProduitRepository $prod): Response
    {

        return $this->render('facture_detaille/index.html.twig', [
            'facture_detailles' => $prod->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_facture_detaille_new", methods={"GET", "POST"})
     */
    public function new(Request $request, FactureDetailleRepository $factureDetailleRepository): Response
    {
        $factureDetaille = new FactureDetaille();
        $form = $this->createForm(FactureDetailleType::class, $factureDetaille);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refPrin = $factureDetaille->getNumOf()->getRefPrincipale();
            $factureDetaille->setRefPrincipale($refPrin);

            $qteExpedie = $factureDetaille->getNumOf()->getQteExpedie();
            $factureDetaille->setQteExpedie($qteExpedie);
            $prixTot = $factureDetaille->getPu() *  $factureDetaille->getNumOf()->getQteExpedie() ;
            $factureDetaille->setPrixTotal($prixTot);
            $factureDetaille->setProduitName("dd");
            $factureDetaille->setChiffreAffaire(111);
            $factureDetaille->setPuTotal(11);

            $factureDetailleRepository->add($factureDetaille, true);



            return $this->redirectToRoute('app_facture_detaille_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('facture_detaille/new.html.twig', [
            'facture_detaille' => $factureDetaille,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_facture_detaille_show", methods={"GET"})
     */
    public function show(FactureDetaille $factureDetaille): Response
    {
        return $this->render('facture_detaille/show.html.twig', [
            'facture_detaille' => $factureDetaille,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_facture_detaille_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, FactureDetaille $factureDetaille, FactureDetailleRepository $factureDetailleRepository): Response
    {
        $form = $this->createForm(FactureDetailleType::class, $factureDetaille);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $factureDetailleRepository->add($factureDetaille, true);

            return $this->redirectToRoute('app_facture_detaille_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('facture_detaille/edit.html.twig', [
            'facture_detaille' => $factureDetaille,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_facture_detaille_delete", methods={"POST"})
     */
    public function delete(Request $request, FactureDetaille $factureDetaille, FactureDetailleRepository $factureDetailleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$factureDetaille->getId(), $request->request->get('_token'))) {
            $factureDetailleRepository->remove($factureDetaille, true);
        }

        return $this->redirectToRoute('app_facture_detaille_index', [], Response::HTTP_SEE_OTHER);
    }
}
