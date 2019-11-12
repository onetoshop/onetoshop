<?php

namespace App\Controller;

use App\Entity\Aanmelding;
use App\Entity\Card;
use App\Form\AanmeldType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class MogelijkhedenController extends AbstractController
{
    // mogelijkheden pagina
    /**
     * @Route("/mogelijkheden", name="mogelijkheden",)
     */
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $aanmeld = new Aanmelding();

        $form = $this->createForm(Aanmelding::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($aanmeld);
            $em->flush();

            return $this->redirectToRoute('mogelijkheden');
        }

        return $this->render('mogelijkheden/mogelijkheden.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
