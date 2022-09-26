<?php

namespace App\Controller;

use App\Entity\Facture;
use App\Entity\ProdFact;
use App\Entity\Produit;
use App\Entity\Societe;
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
use Dompdf\Dompdf;
use Dompdf\Options;
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
            'factures' => $factureRepository->findBy(array(), array('id' => 'DESC')),
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
            /* ->add('adrliv', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                 'required' => false
             ))*/
            ->add('societe', EntityType::class, array(
                'class' => Societe::class,
                'choice_label' => 'name',
            ))
            /* ->add('adrfab', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                 'required' => false,
                 'empty_data'=>"RELAIS  AUTOMATISMES INDUSTRIELS 23  RUE ALI ALHOUSSARI 2036 SOUKRA"
             ))*/
            /*   ->add('netpay', NumberType::class, array(


                   'required' => false
               ))*/
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


                'required' => false,
                'empty_data'=>0
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
            ->add('ref4', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))
            ->add('factExp4', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))
            ->add('decldou4', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))

            ->add('qte4', NumberType::class, array(


                'required' => false,
                'empty_data'=>0
            ))
            ->add('ref5', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))
            ->add('factExp5', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))
            ->add('decldou5', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))

            ->add('qte5', NumberType::class, array(


                'required' => false,
                'empty_data'=>0
            ))
            ->add('ref6', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))
            ->add('factExp6', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))
            ->add('decldou6', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))

            ->add('qte6', NumberType::class, array(


                'required' => false,
                'empty_data'=>0
            ))
            ->add('ref7', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))
            ->add('factExp7', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))
            ->add('decldou7', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))

            ->add('qte7', NumberType::class, array(


                'required' => false,
                'empty_data'=>0
            ))
            ->add('ref8', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))
            ->add('factExp8', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))
            ->add('decldou8', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))

            ->add('qte8', NumberType::class, array(


                'required' => false,
                'empty_data'=>0
            ))
            ->add('ref9', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))
            ->add('factExp9', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))
            ->add('decldou9', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))

            ->add('qte9', NumberType::class, array(


                'required' => false,
                'empty_data'=>0
            ))
            ->add('ref10', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))
            ->add('factExp10', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))
            ->add('decldou10', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))

            ->add('qte10', NumberType::class, array(


                'required' => false,
                'empty_data'=>0
            ))
            ->add('ref11', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))
            ->add('factExp11', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))
            ->add('decldou11', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))

            ->add('qte11', NumberType::class, array(


                'required' => false,
                'empty_data'=>0
            ))
            ->add('ref12', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))
            ->add('factExp12', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))
            ->add('decldou12', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(


                'required' => false
            ))

            ->add('qte12', NumberType::class, array(


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
            $facture->setAdressFab("RELAIS  AUTOMATISMES INDUSTRIELS 23  RUE ALI ALHOUSSARI 2036 SOUKRA");
            $facture->setAdressLiv($form2->get('societe')->getData()->getName()." ".$form2->get('societe')->getData()->getAdress());
            $facture->setNbrPalette($form2->get('nbrpaleete')->getData());
            /*$facture->setNetPayer($form2->get('netpay')->getData());*/
            $facture->setNetPayer(0);

            $facture->setTypefac($form2->get('typefac')->getData());

            if ($form2->get($ref."1")->getData()) {
                $factureRepository->add($facture, true);
                $lastFact = $factureRepository->findBy(array(), array('id' => 'DESC'), 1, 0)[0];
            }
            $a=$lastFact->getId();

            // return $this->redirectToRoute('app_facture_index', [], Response::HTTP_SEE_OTHER);
            $s=0 ;
            $p = 0;
            for( $i=1;$i<=12 ;$i++){
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


                    $s+=($prodid->getPU()*$form2->get($qte."{$i}")->getData());





                }
            }
            //update
            $fact=$factureRepository->find($lastFact->getId());
            $fact->setNetPayer($s);

            $factureRepository->add($fact, true);


            return $this->redirectToRoute('app_facture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('facture/new.html.twig', [
            'facture' => $facture,
            'form' => $form,
            'form2'=>$form2,
            'produits'=>$prodrepo->findAll()

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
    public function delete(Request $request, Facture $facture, FactureRepository $factureRepository , ProduitRepository $produitRepository): Response
    {

        foreach ($facture->getProdFacts() as $pf){
                $prd = $pf->getProdId();
                $prd->setQteExpedie($prd->getQteExpedie()-$pf->getQuantity());
                $produitRepository->add($prd, true);

        }
        if ($this->isCsrfTokenValid('delete'.$facture->getId(), $request->request->get('_token'))) {
            $factureRepository->remove($facture, true);
        }

        return $this->redirectToRoute('app_facture_index', [], Response::HTTP_SEE_OTHER);
    }


    /**
     * @Route("/listpdf/{id}", name="app_facture_pdf", methods={"GET"})
     */
    public function listpdf(FactureRepository $factureRepository , ProdFactRepository $prodFactRepository , $id): Response
    {
        $fact = $factureRepository->find($id);
        $prodfacr=$fact->getProdFacts();
        $ss=0;
        foreach ($prodfacr as $p){
            $ss = $ss + ($p->getProdId()->getPoid() * $p->getQuantity());
        }
        //pdf

        $path='./facttt-1.jpg';
        $type=pathinfo($path,PATHINFO_EXTENSION);
        $data=file_get_contents($path);
        $pic='data:image/' . $type .';base64,' .base64_encode($data);

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('facture/factpdf.html.twig', [
            'urlpict'=>$pic,
            'facture'=>$fact,
            'produits'=>$prodfacr,
            'poids' => $ss

        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);


        ///////
     /*   return $this->render('facture/index.html.twig', [
            'factures' => $factureRepository->findAll(),
        ]); */
    }
}
