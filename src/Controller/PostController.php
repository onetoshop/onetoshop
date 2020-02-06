<?php

namespace App\Controller;

use App\Entity\Apps;
use App\Entity\Card;
use App\Entity\Project;
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
     * @Route("/{_locale}/admin/card_overzicht", name="card_overzicht")
     * @IsGranted("ROLE_USER")
     */
    public function card()
    {
        $cards = $this->getDoctrine()->getRepository(Card::class)->findAll();
        return $this->render('admin/card/card_show.html.twig', [
            'cards' => $cards
        ]);
    }

    /**
     * @Route("/{_locale}/admin/card_overzicht/card_overzicht/show_card/{slug}", name="show_card")
     * @IsGranted("ROLE_USER")
     */
    public function show_card($slug)
    {
        $cards = $this->getDoctrine()->getRepository(Card::class)->findBy([
            'title' => $slug
        ]);


        return $this->render('admin/card/show_card.html.twig', [
            'cards' => $cards
        ]);
    }


    /**
     * @Route("/{_locale}/admin/card_overzicht/delete_card/{id}", name="delete_card")
     * @IsGranted("ROLE_USER")
     */
    public function delete_card(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $card = $em->getRepository(Card::class)->find($id);

        $em->remove($card);
        $em->flush();

        return $this->redirectToRoute('card_overzicht');
    }


    /**
     * @Route("/{_locale}/admin/card_overzicht/add_card", name="add_card")
     * @IsGranted("ROLE_USER")
     */
    public function indexAction(EntityManagerInterface $manager, Request $request)
    {
        $form = $this->createForm(CardType::Class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $card = $form->getData();

            $manager->persist($card);
            $manager->flush();

            return $this->redirectToRoute('card_overzicht');
        }
        return $this->render('admin/card/add_card.html.twig', [
        'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{_locale}/admin/card_overzicht/edit_card/{id}", name="edit_card", methods={"GET","POST"})
     */
    public function edit_card(Request $request, $id)
    {
        $card = $this->getDoctrine()->getRepository(Card::class)->findOneBy([
            'id' => $id,
        ]);


        $form = $this->createForm(CardType::class, $card);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $card = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($card);
            $em->flush();

            return $this->redirectToRoute('card_overzicht',[
                'id' => $card->getId(),
            ]);
        }
        return $this->render('admin/card/edit_card.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{_locale}/project/{naam}", name="project")
     */
    public function project($naam){
        $project = $this->getDoctrine()->getRepository(Project::class)->findBy([
            'naam'  => $naam
        ]);
        return $this->render('project/project.html.twig',[
            'project' => $project
        ]);
    }




}
