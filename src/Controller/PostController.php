<?php

namespace App\Controller;

use App\Entity\Image;
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
     * @Route("/image", name="image_upload")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $imageEn = new Image();

        $form = $this->createForm(ImageUploadType::class, $imageEn);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */

            $file = $imageEn->getImage();
            ($imageEn->getImage());
            $file1 = $imageEn->getImage1();
            ($imageEn->getImage1());

            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $fileName1 = md5(uniqid()).'.'.$file1->guessExtension();

            $file->move($this->getParameter('upload'), $fileName);
            $file1->move($this->getParameter('upload'), $fileName1);

            $imageEn->setImage($fileName);
            $imageEn->setImage1($fileName1);
            $em->persist($imageEn);
            $em->flush();

            $this->addFlash('notice', 'Post Submitted Successfully!!!');

            return $this->redirectToRoute('image_upload');

        }

        return $this->render('upload/upload.html.twig', array(
            'form' => $form->createView()
        ));
    }

}
