<?php

namespace App\Controller;

use App\Entity\Aanmeld;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\AanmeldType;
use Symfony\Component\Form\AbstractType;
class AanmeldController extends AbstractController
{
    // mogelijkheden pagina
    /**
     * @Route("/mogelijkheden", name="mogelijkheden",)
     */
    public function mogelijkheden(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $aanmeld = new Aanmeld();

        $form = $this->createForm(AanmeldType::class, $aanmeld);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $em->persist($aanmeld);
            $em->flush();


            return $this->redirectToRoute('homepage');
        }

            return $this->render('mogelijkheden/mogelijkheden.html.twig', [
                'form' => $form->createView(),
        ]);

    }
}
