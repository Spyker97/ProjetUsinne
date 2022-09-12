<?php

namespace App\Controller;

use App\Entity\Facture;
use App\Entity\ProdFact;
use App\Entity\Produit;
use App\Form\FactureType;
use App\Repository\FactureRepository;
use App\Repository\ProdFactRepository;
use App\Repository\ProduitRepository;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/facture")
 */
class FactureController extends AbstractController
{
    /**
     * @Route("/", name="app_facture_index", methods={"GET"})
     */
    public function index(FactureRepository $factureRepository): Response
    {
        return $this->render('facture/index.html.twig', [
            'factures' => $factureRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_facture_new", methods={"GET", "POST"})
     */
    public function new(Request $request, FactureRepository $factureRepository , ProduitRepository $prodrepo , ProdFactRepository $prodFactRepository): Response
    {
        $facture = new Facture();
        $form = $this->createForm(FactureType::class, $facture);
        $form->handleRequest($request);

        $form2 = $this->createFormBuilder()
            ->add('date',DateType::class,[
                'widget' => 'single_text',



                // prevents rendering it as type="date", to avoid HTML5 date pickers
                'html5' => true ,
                'required' => true,
                'empty_data' => '01/01/2000',])
            ->add('typefac', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))
            ->add('adrliv', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))
            ->add('adrfab', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))
            ->add('netpay', NumberType::class, array(


                'required' => false
            ))
            ->add('nbrpaleete', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))
            ->add('ref1', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))
            ->add('factExp1', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))
            ->add('decldou1', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))

            ->add('qte1', NumberType::class, array(


                'required' => false
            ))
            ->add('ref2', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))
            ->add('factExp2', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))
            ->add('decldou2', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))

            ->add('qte2', NumberType::class, array(


                'required' => false
            ))
            ->add('ref3', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))
            ->add('factExp3', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))
            ->add('decldou3', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))

            ->add('qte3', NumberType::class, array(


                'required' => false,
                'empty_data'=>0
            ))
            ->add("Save",SubmitType::class)


            ->getForm();
        $form2->handleRequest($request);
        $a="";
        $b=1;
        $ref="ref";
        $factExp="factExp";
        $decldou="decldou";
        $qte="qte";
        if ($form2->isSubmitted() && $form2->isValid()) {
            $facture->setDatefact($form2->get('date')->getData());
            $facture->setAdressFab($form2->get('adrfab')->getData());
            $facture->setAdressLiv($form2->get('adrliv')->getData());
            $facture->setNbrPalette($form2->get('nbrpaleete')->getData());
            $facture->setNetPayer($form2->get('netpay')->getData());
            $facture->setTypefac($form2->get('typefac')->getData());

            if ($form2->get($ref."1")->getData()) {
                $factureRepository->add($facture, true);
                $lastFact = $factureRepository->findBy(array(), array('id' => 'DESC'), 1, 0)[0];
            }
            $a=$lastFact->getId();

            // return $this->redirectToRoute('app_facture_index', [], Response::HTTP_SEE_OTHER);
            $s=0 ;
            for( $i=1;$i<=3 ;$i++){
                $prodfact=new ProdFact();
                if ($form2->get($ref."{$i}")->getData()){

                    $prodfact->setQuantity($form2->get($qte."{$i}")->getData());
                    $prodfact->setDeclarDouane($form2->get($decldou."{$i}")->getData());
                    $prodfact->setFactureExport($form2->get($factExp."{$i}")->getData());
                    $prodfact->setFactId($lastFact);
                    $prodid = $prodrepo->findOneBy(array('refComplete'=>$form2->get($ref."{$i}")->getData()));

                    $prodfact->setProdId($prodid);
                    $prodFactRepository->add($prodfact, true);

                    $prodid->setQteExpedie($form2->get($qte."{$i}")->getData()+$prodid->getQteExpedie());
                    $prodrepo->add($prodid, true);


                    $s+=$s+($prodid->getPU()*$form2->get($qte."{$i}")->getData());





                }
            }
            //update
            $fact=$factureRepository->find($lastFact->getId());
            $fact->setNetPayer($s);
            $factureRepository->add($fact, true);


        }

        return $this->renderForm('facture/new.html.twig', [
            'facture' => $facture,
            'form' => $form,
            'form2'=>$form2,

        ]);
    }

    /**
     * @Route("/{id}", name="app_facture_show", methods={"GET"})
     */
    public function show(Facture $facture,ProdFactRepository $prodFactRepository): Response
    {
        return $this->render('facture/show.html.twig', [
            'facture' => $facture,
            'prod_facts' => $facture->getProdFacts(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_facture_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Facture $facture, FactureRepository $factureRepository): Response
    {
        $form = $this->createForm(FactureType::class, $facture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $factureRepository->add($facture, true);

            return $this->redirectToRoute('app_facture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('facture/edit.html.twig', [
            'facture' => $facture,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_facture_delete", methods={"POST"})
     */
    public function delete(Request $request, Facture $facture, FactureRepository $factureRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$facture->getId(), $request->request->get('_token'))) {
            $factureRepository->remove($facture, true);
        }

        return $this->redirectToRoute('app_facture_index', [], Response::HTTP_SEE_OTHER);
    }
}
