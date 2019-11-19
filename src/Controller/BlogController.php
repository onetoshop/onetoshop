<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Form\BlogType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {
        return $this->render('blog/blog.html.twig');
    }

    /**
     * @Route("/admin/blog/blog_card", name="add_blog")
     * @IsGranted("ROLE_USER")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $imageEn = new Blog();

        $form = $this->createForm(BlogType::class, $imageEn);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */

            $file = $imageEn->getImage();
            ($imageEn->getImage());

            $fileName = md5(uniqid()) . '.' . $file->guessExtension();

            $file->move($this->getParameter('upload'), $fileName);

            $imageEn->setImage($fileName);
            $em->persist($imageEn);
            $em->flush();

            $this->addFlash(
                'info',
                'Blog Succesvol Aangemaakt!'

            );

            return $this->redirectToRoute('add_blog');

        }

        return $this->render('admin/blog.html.twig', array(
            'form' => $form->createView()
        ));
    }

}
