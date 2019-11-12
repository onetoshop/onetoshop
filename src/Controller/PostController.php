<?php

namespace App\Controller;

use App\Entity\Card;
use App\Entity\Image;
use App\Form\CardType;
use App\Form\ImageUploadType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/post", name="post")
     */
    public function index()
    {
        $image = $this->getDoctrine()
            ->getRepository(Image::class)
            ->findAll();

        return $this->render('post/index.html.twig', [
            'image' => $image,
        ]);
    }

    /**
     * @Route("/card", name="card_upload")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $imageEn = new Card();

        $form = $this->createForm(CardType::class, $imageEn);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */

            $file = $imageEn->getBackgroundimage();
            ($imageEn->getBackgroundimage());
            $file1 = $imageEn->getFrondimage();
            ($imageEn->getFrondimage());

            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $fileName1 = md5(uniqid()).'.'.$file1->guessExtension();

            $file->move($this->getParameter('upload'), $fileName);
            $file1->move($this->getParameter('upload'), $fileName1);

            $imageEn->setBackgroundimage($fileName);
            $imageEn->setFrondimage($fileName1);
            $em->persist($imageEn);
            $em->flush();

            return $this->redirectToRoute('card_upload');

        }

        return $this->render('upload/upload.html.twig', array(
            'form' => $form->createView()
        ));
    }

}
