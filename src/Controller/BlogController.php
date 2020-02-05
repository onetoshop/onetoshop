<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Form\BlogType;
use App\Repository\BlogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BlogController extends AbstractController
{
    /**
     * @Route("/{_locale}/blogs", name="blogs")
     */
    public function index()
    {
        $blog = $this->getDoctrine()->getRepository(Blog::class)->findBy(
            array(),
            array('id' => 'ASC'),
            10,
            0);


        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('handleSearch'))
            ->add('Zoek', TextType::class, ['label' => false])
            ->add('submit', SubmitType::class, ['label' => 'Zoek',    'attr' => array(
                'placeholder' => 'Zoek naar blogs...')])
            ->getForm()
        ;

        return $this->render('blog/blog.html.twig', [
            'blogs' => $blog,
            'form' => $form->createView()

        ]);
    }

    /**
     * @Route("/{_locale}/blog/handleSearch", name="handleSearch")
     */
    public function handleSearch(Request $request, BlogRepository $blogRepository)
    {
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('handleSearch'))
            ->add('Zoek', TextType::class, ['label' => false])
            ->add('submit', SubmitType::class, ['label' => 'Zoek',    'attr' => array(
                'placeholder' => 'Zoek naar blogs...')])
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
     * @Route("/{_locale}/blog/{slug}", name="blogshow")
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
     * @Route("/{_locale}/admin/blog/blog_card", name="add_blog")
     * @IsGranted("ROLE_USER")
     */
    public function add_blog(EntityManagerInterface $manager, Request $request)
    {
        $form = $this->createForm(BlogType::Class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $blog = $form->getData();

            $file = $blog->getImage();

            $image = $file->getFile();

            $fileName = md5(uniqid()) . '.' . $image->guessExtension();

            $image->move($this->getParameter('blog'), $fileName);

            $file->setName($fileName);

            $manager->persist($blog);
            $manager->flush();

            return $this->redirectToRoute('add_blog');
        }
        return $this->render('admin//blog/blog.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/app_overzicht/edit_blog/{id}", name="edit_blog", methods={"GET","POST"})
     */
    public function edit_card(Request $request, $id)
    {
        $app = $this->getDoctrine()->getRepository(Blog::class)->findOneBy([
            'id' => $id,
        ]);

        $form = $this->createForm(BlogType::class, $app);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $app = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($app);
            $em->flush();

            return $this->redirectToRoute('blogoverzicht', [
                'id' => $app->getId(),
            ]);
        }
        return $this->render('admin/blog/edit_blog.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
