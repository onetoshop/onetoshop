<?php

namespace App\Controller;

use App\Entity\Card;
use App\Form\CardType;
use App\Form\UploadType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
class PostController extends AbstractController
{
    /**
     * @Route("/admin/card", name="card")
     * @IsGranted("ROLE_USER")
     */
    public function card()
    {
        $cards = $this->getDoctrine()->getRepository(Card::class)->findAll();
        return $this->render('upload/card.html.twig', [
            'cards' => $cards
        ]);
    }

    /**
     * @Route("/admin/card/show/{slug}", name="show_card")
     * @IsGranted("ROLE_USER")
     */
    public function show_card($slug)
    {
        $cards = $this->getDoctrine()->getRepository(Card::class)->findBy([
            'title' => $slug
        ]);


        return $this->render('upload/cardshow.html.twig', [
            'cards' => $cards
        ]);
    }


    /**
     * @Route("/admin/delete/{id}", name="delete")
     * @IsGranted("ROLE_USER")
     */
    public function delete(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $card = $em->getRepository(Card::class)->find($id);

        $em->remove($card);
        $em->flush();

        $this->addFlash(
            'info',
            'Card Succesvol Verwijderd'
        );

        return $this->redirectToRoute('card');
    }


    /**
     * @Route("/admin/card/add_card", name="add_card")
     * @IsGranted("ROLE_USER")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $imageEn = new Card();

        $form = $this->createForm(CardType::class, $imageEn);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */

            $file = $imageEn->getBackgroundimage();
            ($imageEn->getBackgroundimage());
            $file1 = $imageEn->getFrondimage();
            ($imageEn->getFrondimage());

            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $fileName1 = md5(uniqid()) . '.' . $file1->guessExtension();

            $file->move($this->getParameter('card'), $fileName);
            $file1->move($this->getParameter('card'), $fileName1);

            $imageEn->setBackgroundimage($fileName);
            $imageEn->setFrondimage($fileName1);
            $em->persist($imageEn);
            $em->flush();


            $this->addFlash(
                'info',
                'Card Succesvol Aangemaakt!'
            );

            return $this->redirectToRoute('card');

        }

        return $this->render('upload/upload.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/card/edit/{id}", name="edit_card", methods={"GET","POST"})
     */
    public function edit_card($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $card1 = $em->getRepository(Card::class)->findBy(['id' => $id]);
        $form = $this->createForm(CardType::class, $card1);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $card = $form->getData();

            $em->persist($card);
            $em->flush();

//            $this->addFlash('success', 'Article Created! Knowledge is power!');
            return $this->redirectToRoute('edit_card',[
                'id' => $card->getId(),
            ]);
        }
        return $this->render('upload/editcard.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
