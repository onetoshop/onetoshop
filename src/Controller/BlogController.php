<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Form\BlogType;
use App\Repository\BlogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {
        $blog = $this->getDoctrine()->getRepository(Blog::class)->findAll();


        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('handleSearch'))
            ->add('Zoek', TextType::class, ['label' => false])
            ->add('submit', SubmitType::class, ['label' => 'Ga'])
            ->getForm()
        ;

        return $this->render('blog/blog.html.twig', [
            'blogs' => $blog,
            'form' => $form->createView()

        ]);
    }

    /**
     * @Route("/blog/handleSearch", name="handleSearch")
     */
    public function handleSearch(Request $request, BlogRepository $blogRepository)
    {
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('handleSearch'))
            ->add('Zoek', TextType::class, ['label' => false])
            ->add('submit', SubmitType::class, ['label' => 'Ga'])
            ->getForm()
        ;

        $zoek = $request->request->get('form')['Zoek'];
        if ($zoek) {
        $blogs = $blogRepository->findBlogsByName($zoek);
     }
        return $this->render('blog/results.html.twig', [
            'form' => $form->createView(),
            'blogs' => $blogs,
            ]);
    }

    /**
     * @Route("/blog/{slug}", name="blogshow")
     */
    public function show($slug)
    {
//
        $blogs = $this->getDoctrine()->getRepository(Blog::class)->findBy([
            'slug' => $slug
        ]);


        return $this->render('blog/showblog.html.twig', [
            'blogs' => $blogs
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
