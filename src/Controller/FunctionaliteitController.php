<?php

namespace App\Controller;

use App\Entity\Functionaliteit;
use App\Form\FunctionaliteitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
class FunctionaliteitController extends AbstractController
{
    /**
     * @Route("/{_locale}/functionaliteit", name="functionaliteit")
     */
    public function index()
    {
        $functionaliteit = $this->getDoctrine()->getRepository(Functionaliteit::class)->findBy([
            'parent' => NULL
        ]);

        $functionaliteitinfo = $this->getDoctrine()->getRepository(Functionaliteit::class)->findBy([
            'parent' => 1
        ]);

        return $this->render('functionaliteit/functionaliteit.html.twig', [
            'functionaliteit' => $functionaliteit,
            'functionaliteitinfo' => $functionaliteitinfo
        ]);

    }

    /**
     * @Route("/{_locale}/functies/{slug}", name="functionaliteitinfo")
     */
    public function functionaliteitinfo($slug){
        $functionaliteit = $this->getDoctrine()->getRepository(Functionaliteit::class)->findBy([
            'slug' => $slug
        ]);

        $functionaliteitinfo = $this->getDoctrine()->getRepository(Functionaliteit::class)->findBy([
            'parent'  => $functionaliteit[0]->getId()
        ]);

        return $this->render('functionaliteit/functionaliteitinfo.html.twig',[
           'functionaliteit' => $functionaliteit,
           'functionaliteitinfo' => $functionaliteitinfo

        ]);
    }



    /**
     * @Route("/{_locale}/admin/functionaliteit", name="functionaliteitadmin")
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
        return $this->render('admin/functionaliteit/functionaliteit.html.twig', array(
            'form' => $form->createView()
        ));
}


    /**
     * @Route("/{_locale}/admin/functionaliteit/info", name="functionaliteitinfoadmin")
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
        return $this->render('admin/functionaliteit/functionaliteitinfo.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{_locale}/admin/functionaliteit/card", name="functionaliteitcardadmin")
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
        return $this->render('admin/functionaliteit/functionaliteitcard.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
