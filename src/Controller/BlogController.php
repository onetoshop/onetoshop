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
        $blog = $this->getDoctrine()->getRepository(Blog::class)->findAll();

        return $this->render('blog/blog.html.twig', [
            'blogs' => $blog
        ]);
    }

    /**
     * @Route("/blog/{slug}", name="blogshow")
     */
    public function show($slug)
    {
//
        $gegeven = $this->getDoctrine()->getRepository(Blog::class)->findOneBy([
            'title' => $slug
        ]);
        $blog = $this->getDoctrine()->getRepository(Blog::class)->findAll();

        return $this->render('blog/showblog.html.twig', [
            'blog' => $gegeven,
            'blogs' => $blog
        ]);
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

            $file = $form->get('image')->getData();
            ($imageEn->getImage());

            $fileName = md5(uniqid()) . '.' . $file->guessExtension();

            $file->move($this->getParameter('blog'), $fileName);

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
