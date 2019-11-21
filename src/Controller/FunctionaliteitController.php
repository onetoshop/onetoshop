<?php

namespace App\Controller;

use App\Entity\Functionaliteit;
use App\Entity\Functionaliteitcard;
use App\Entity\Functionaliteitinfo;
use App\Form\FunctionaliteitcardType;
use App\Form\FunctionaliteitinfoType;
use App\Form\FunctionaliteitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
class FunctionaliteitController extends AbstractController
{
    /**
     * @Route("/functionaliteit", name="functionaliteit")
     *  @IsGranted("ROLE_USER")
     */
    public function index()
    {
        $functionaliteit = $this->getDoctrine()->getRepository(Functionaliteit::class)->findAll();

        return $this->render('functionaliteit/functionaliteit.html.twig', [
            'functionaliteit' => $functionaliteit
        ]);
    }

    /**
     * @Route("/functionaliteit/{slug}", name="functionaliteitinfo")
     */
    public function functionaliteitinfo($slug){
        $functionaliteitinfo = $this->getDoctrine()->getRepository(Functionaliteitinfo::class)->findBy([
            'url' => $slug
        ]);
        $functionaliteitcard = $this->getDoctrine()->getRepository(Functionaliteitcard::class)->findBy([
            'url' => $slug
            ]);


        return $this->render('functionaliteit/functionaliteitinfo.html.twig',[
            'functionaliteitinfo' => $functionaliteitinfo,
            'functionaliteitcard' => $functionaliteitcard
        ]);
    }

    /**
     * @Route("/admin/functionaliteit", name="functionaliteitadmin")
     */
    public function adminfunctionaliteit(Request $request)
    {


        $em = $this->getDoctrine()->getManager();
        $imageEn = new Functionaliteit();

        $form = $this->createForm(FunctionaliteitType::class, $imageEn);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */


            $em->persist($imageEn);
            $em->flush();


            $this->addFlash(
                'info',
                'Functionaliteit Succesvol Aangemaakt!'
            );

            return $this->redirectToRoute('functionaliteitadmin');


        }
        return $this->render('admin/functionaliteit.html.twig', array(
            'form' => $form->createView()
        ));
}


    /**
     * @Route("/admin/functionaliteit/info", name="functionaliteitinfoadmin")
     */
    public function functionaliteitadmininfo(Request $request)
    {


        $em = $this->getDoctrine()->getManager();
        $imageEn = new Functionaliteitinfo();

        $form = $this->createForm(FunctionaliteitinfoType::class, $imageEn);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */


            $em->persist($imageEn);
            $em->flush();


            $this->addFlash(
                'info',
                'Functionaliteit Succesvol Aangemaakt!'
            );

            return $this->redirectToRoute('functionaliteitadmin');


        }
        return $this->render('admin/functionaliteitinfo.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/functionaliteit/card", name="functionaliteitcardadmin")
     */
    public function functionaliteitadmincard(Request $request)
    {


        $em = $this->getDoctrine()->getManager();
        $imageEn = new Functionaliteitcard();

        $form = $this->createForm(FunctionaliteitcardType::class, $imageEn);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */


            $em->persist($imageEn);
            $em->flush();


            $this->addFlash(
                'info',
                'Functionaliteitcard Succesvol Aangemaakt!'
            );

            return $this->redirectToRoute('functionaliteitcardadmin');


        }
        return $this->render('admin/functionaliteitcard.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
