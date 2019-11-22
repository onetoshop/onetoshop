<?php

namespace App\Controller;

use App\Entity\Card;
use App\Form\CardType;
use Doctrine\ORM\EntityManagerInterface;
use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
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
    public function indexAction(EntityManagerInterface $manager, Request $request)
    {
        $form = $this->createForm(CardType::Class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $card = $form->getData();

            $image = $card->getBgimage();
            $image1 = $card->getFrimage();

            $bgimage = $image->getFile();
            $frimage = $image1->getFile();

            $fileName = md5(uniqid()) . '.' . $bgimage->guessExtension();
            $fileName1 = md5(uniqid()) . '.' . $frimage->guessExtension();

            $bgimage->move($this->getParameter('card'), $fileName);
            $frimage->move($this->getParameter('card'), $fileName1);
            $image->setName($fileName);
            


            $manager->persist($card);
            $manager->flush();

            $this->addFlash(
                'notice',
                "Card is toegevoed"
            );
            return $this->redirectToRoute('card');
        }
        return $this->render('upload/upload.html.twig', [
        'form' => $form->createView(),
        ]);
    }

//    /**
//     * @Route("/admin/card/edit/{id}", name="edit_card", methods={"GET","POST"})
//     */
//    public function edit_card(Request $request, $id)
//    {
//        $card = $this->getDoctrine()->getRepository(Card::class)->findOneBy([
//            'id' => $id,
//        ]);
//
//        $card->setBackgroundimage($card->getBackgroundimage());
//        $card->setFrondimage($card->getFrondimage());
//
//        $form = $this->createForm(CardType::class, $card);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//
//            $card = $form->getData();
//
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($card);
//            $em->flush();
//
//            return $this->redirectToRoute('card',[
//                'id' => $card->getId(),
//            ]);
//        }
//        return $this->render('upload/editcard.html.twig', [
//            'form' => $form->createView()
//        ]);
//    }




}
