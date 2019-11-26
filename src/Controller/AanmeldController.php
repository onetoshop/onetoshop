<?php

namespace App\Controller;

use App\Entity\Aanmeld;
use App\Entity\Card;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\AanmeldType;
use Symfony\Component\Form\AbstractType;
class AanmeldController extends AbstractController
{
    // mogelijkheden pagina
    /**
     * @Route("/{_locale}/succes", name="succes",)
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

            $this->addFlash('succes', 'Aanmelding succesvol! U hoort van ons');


            return $this->redirectToRoute('aangemeld');
        }

            return $this->render('mogelijkheden/mogelijkheden.html.twig', [
                'form' => $form->createView(),
        ]);

    }
    /**
     * @Route("/{_locale}/aangemeld", name="aangemeld",)
     */
    public function aangemeld()
    {
        return $this->render('mogelijkheden/aangemeld.html.twig');
    }

    /**
     * @Route("/{_locale}/aanmeldingen", name="aanmeldingen")
     */
    public function index()
    {
        $aanmeld = $this->getDoctrine()->getRepository(Aanmeld::class)->findAll();
        return $this->render('mogelijkheden/aanmeldingen.html.twig', [
            'aanmeldingen' => $aanmeld
        ]);
    }
}
