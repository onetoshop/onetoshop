<?php

namespace App\Controller;

use App\Entity\Aanmeld;
use App\Entity\Apps;
use App\Entity\Blog;
use App\Entity\Card;
use App\Entity\Contact;
use App\Entity\Gegeven;
use App\Entity\Project;
use App\Entity\User;
use App\Form\AppsType;
use App\Form\ProjectType;
use Doctrine\ORM\EntityManagerInterface;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Tests\Compiler\D;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\AanmeldType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Form\GegevenType;
use App\Entity\Nieuwsbrief;
use App\Form\ReplyType;


class BackendController extends AbstractController
{

    /**
     * @Route("/{_locale}/admin", name="admin")
     * @IsGranted("ROLE_USER")
     */
    public function index()
    {
        # get amount of signups
        $em = $this->getDoctrine()->getManager();
        $repoArticles = $em->getRepository(Aanmeld::class);
        $totaleaanmeld = $repoArticles->createQueryBuilder('a')->select('count(a.id)')->getQuery()->getSingleScalarResult();

        # get all signups
        $aanmeld = $this->getDoctrine()->getRepository(Aanmeld::class)->findAll();

        # get amount of articles
        $em = $this->getDoctrine()->getManager();
        $repoArticles = $em->getRepository(Gegeven::class);
        $gegeven = $repoArticles->createQueryBuilder('a')->select('count(a.id)')->getQuery()->getSingleScalarResult();

        # get amount of newsletter signups
        $em = $this->getDoctrine()->getManager();
        $repoArticles = $em->getRepository(Nieuwsbrief::class);
        $nieuwsbrief = $repoArticles->createQueryBuilder('a')->select('count(a.id)')->getQuery()->getSingleScalarResult();

        # get amount of inbox
        $em = $this->getDoctrine()->getManager();
        $repoArticles = $em->getRepository(Contact::class);
        $inbox = $repoArticles->createQueryBuilder('a')->select('count(a.id)')->getQuery()->getSingleScalarResult();

        # get amount of users
        $em = $this->getDoctrine()->getManager();
        $repoArticles = $em->getRepository(User::class);
        $users = $repoArticles->createQueryBuilder('a')->select('count(a.id)')->getQuery()->getSingleScalarResult();

        # get amount of cads
        $em = $this->getDoctrine()->getManager();
        $repoArticles = $em->getRepository(Card::class);
        $cards = $repoArticles->createQueryBuilder('a')->select('count(a.id)')->getQuery()->getSingleScalarResult();

        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('handleSearch'))
            ->add('Zoek', TextType::class, ['label' => false])
            ->add('submit', SubmitType::class, ['label' => 'Ga'])
            ->getForm()
        ;




        return $this->render('admin/index.html.twig', [
            'totaleaanmeld' => $totaleaanmeld,
            'aanmeldingen' => $aanmeld,
            'gegeven' => $gegeven,
            'nieuwsbrief' => $nieuwsbrief,
            'users' => $users,
            'inbox' => $inbox,
            'cards' => $cards,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{_locale}/blogs", name="blogs")
     */
    public function index1()
    {
        $blog = $this->getDoctrine()->getRepository(Blog::class)->findBy(
            array(),
            array('id' => 'ASC'),
            10,
            0);

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
     * @Route("/{_locale}/admin/blog", name="blogoverzicht")
     */
    public function blogs()
    {
        $blogs = $this->getDoctrine()->getRepository(Blog::class)->findAll();

        return $this->render('admin/blog/blogshow.html.twig', [
            'blogs' => $blogs
        ]);
    }
    /**
     * @Route("/{_locale}/admin/blog/blogtonen/{slug}", name="show_blog1")
     * @IsGranted("ROLE_USER")
     */
    public function show_blog1($slug)
    {
        $blog = $this->getDoctrine()->getRepository(Blog::class)->findBy([
            'id' => $slug
        ]);

        return $this->render('admin/blog/blogtonen.html.twig', [
            'blog' => $blog
        ]);
    }

    /**
     * @Route("/{_locale}/admin/blog/delete_blog/{id}", name="delete_blog")
     * @IsGranted("ROLE_USER")
     */
    public function delete_blog1(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $app = $em->getRepository(Blog::class)->find($id);

        $em->remove($app);
        $em->flush();

        return $this->redirectToRoute('blogoverzicht');
    }


    /**
     * @Route("/{_locale}/admin/aanmeldingen", name="aanmeldingen")
     * @IsGranted("ROLE_USER")
     */
    public function mogelijkheden(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $aanmeld = new Aanmeld();

        $form = $this->createForm(AanmeldType::class, $aanmeld);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($aanmeld);
            $em->flush();


            return $this->redirectToRoute('aanmeldingen');
        }

        $aanmeld = $this->getDoctrine()->getRepository(Aanmeld::class)->findAll();

        return $this->render('admin/aanmeldingen/aanmeldingen.html.twig', [
            'aanmeld' => $aanmeld,
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/{_locale}/admin/aanmeldingen/aanmeldingshow/{slug}", name="show_aanmeld")
     * @IsGranted("ROLE_USER")
     */
    public function show_aanmeld($slug)
    {
        $aanmeld = $this->getDoctrine()->getRepository(Aanmeld::class)->findBy([
            'id' => $slug
        ]);

        return $this->render('admin/aanmeldingen/aanmeldingshow.html.twig', [
            'aanmeldingen' => $aanmeld
        ]);
    }

    /**
     * @Route("/{_locale}/admin/aanmeldingen/delete_aanmelding/{id}", name="delete_aanmelding")
     * @IsGranted("ROLE_USER")
     */
    public function delete_aanmelding(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $app = $em->getRepository(Aanmeld::class)->find($id);

        $em->remove($app);
        $em->flush();

        return $this->redirectToRoute('aanmeldingen');
    }



    /**
     * @Route("/{_locale}/admin/informatie", name="informatie")
     * @IsGranted("ROLE_USER")
     */
    public function informatie(Request $request)
    {


        $gegeven = $this->getDoctrine()->getRepository(Gegeven::class)->findAll();

        $em = $this->getDoctrine()->getManager();
        $gegeven1 = new Gegeven();

        $form = $this->createForm(GegevenType::class, $gegeven1);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($gegeven1);
            $em->flush();


            return $this->redirectToRoute('informatie');
        }

        return $this->render('admin/informatie.html.twig', [
            'gegeven' => $gegeven,
            'form' => $form->createView()
        ]);


    }

    /**
     * @Route("/{_locale}/admin/mail/inbox", name="inbox")
     * @IsGranted("ROLE_USER")
     */
    public function inbox()
    {
        $gegeven = $this->getDoctrine()->getRepository(Contact::class)->findAll();

        return $this->render('admin/mail/inbox.html.twig', [
            'gegeven' => $gegeven
        ]);

    }

    /**
     * @Route("/{_locale}/admin//mail/inbox/{slug}", name="show_mail")
     * @IsGranted("ROLE_USER")
     */
    public function show_mail($slug)
    {
        $app1 = $this->getDoctrine()->getRepository(Contact::class)->findBy([
            'id' => $slug
        ]);

        return $this->render('admin/mail/show_mail.html.twig', [
            'app1' => $app1
        ]);
    }
    /**
     * @Route("/{_locale}/admin//mail/reply/{id}", name="reply_mail")
     * @IsGranted("ROLE_USER")
     */
    public function reply(Request $request, $id,  \Swift_Mailer $mailer) {
        $reply = $this->getDoctrine()->getRepository(Contact::class)->findOneBy([
            'id' => $id,
        ]);

        $mail = $reply->getEmail();

        $form = $this->createForm(ReplyType::class);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $form = $form->getData();

            $message = (new \Swift_Message('Bericht van Onetoshop'))
                ->setFrom('dummyonetoshop@gmail.com')
                ->setSubject($form['Onderwerp'])
                ->setTo($mail)
                ->setBody($form['Bericht'], 'text/html');
            $mailer->send($message);
            $this->addFlash('notice', "Mail verstuurd");
        return $this->redirectToRoute('inbox', [
            'id' => $reply->getId(),
        ]);
        }
        return $this->render('admin/mail/reply.html.twig', [
            'formreply' => $form->createView()
        ]);
    }

    /**
     * @Route("/{_locale}/admin/mail/inbox/delete_mail/{id}", name="delete_mail")
     * @IsGranted("ROLE_USER")
     */
    public function delete_mail(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $app = $em->getRepository(Contact::class)->find($id);

        $em->remove($app);
        $em->flush();

        return $this->redirectToRoute('inbox');
    }


    //apps
    /**
     * @Route("/{_locale}/admin/apps", name="apps_admin")
     * @IsGranted("ROLE_USER")
     */
    public function apps_admin()
    {
        $apps = $this->getDoctrine()->getRepository(Apps::class)->findBy([
            'apps' => NULL
        ]);

        return $this->render('admin/app/apps_admin.html.twig', [
            'apps' => $apps
        ]);
    }

    /**
     * @Route("/{_locale}/admin/apps/delete_apps/{id}", name="delete_apps")
     * @IsGranted("ROLE_USER")
     */
    public function delete_apps($id)
    {
        $em = $this->getDoctrine()->getManager();

        $app = $em->getRepository(Apps::class)->find([$id]);

        $em->remove($app);
        $em->flush();


        return $this->redirectToRoute('apps_admin');
    }


    /**
     * @Route("/{_locale}/admin/apps/{slug}", name="apps_slug_admin")
     * @IsGranted("ROLE_USER")
     */
    public function apps_slug_admin($slug)
    {
        $app = $this->getDoctrine()->getRepository(Apps::class)->findBy([
            'slug'  => $slug
        ]);

        $apps = $this->getDoctrine()->getRepository(Apps::class)->findBy([
            'apps'  => $app[0]->getId()
        ]);

        return $this->render('admin/app/apps_slug_admin.html.twig', [
            'apps' => $apps
        ]);

    }

    /**
     * @Route("/{_locale}/admin/apps_toevoegen", name="apps_toevoegen")
     * @IsGranted("ROLE_USER")
     */
    public function apps_toevoegen(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $apps = new Apps();

        $form = $this->createForm(AppsType::class, $apps);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $em->persist($apps);
            $em->flush();

            return $this->redirectToRoute('apps_admin');

        }
        return $this->render('admin/app/apps_admin_toevoegen.html.twig', [
            'form' => $form->createView(),
        ]);


    }

    /**
     * @Route("/{_locale}/admin/apps/koppeling-bewerken/{id}", name="edit_apps", methods={"GET","POST"})
     */
    public function edit_apps(Request $request, $id)
    {
        $apps = $this->getDoctrine()->getRepository(Apps::class)->findOneBy([
            'id' => $id,
        ]);

        $form = $this->createForm(AppsType::class, $apps);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $apps = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($apps);
            $em->flush();

            return $this->redirectToRoute('apps_admin',[
                'id' => $apps->getId(),
            ]);
        }
        return $this->render('admin/app/edit_test.html.twig', [
            'form' => $form->createView()
        ]);
    }


//    /**
//     * @Route("/{_locale}/admin/apps_overzicht/add_apps", name="add_apps")
//     * @IsGranted("ROLE_USER")
//     */
//    public function add_apps(EntityManagerInterface $manager, Request $request)
//    {
//        $form = $this->createForm(AppsType::Class);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//
//            $apps = $form->getData();
//
//            $file = $apps->getImage();
//
//            $image = $file->getFile();
//
//            $fileName = md5(uniqid()) . '.' . $image->guessExtension();
//
//            $image->move($this->getParameter('apps'), $fileName);
//
//            $file->setName($fileName);
//
//            $manager->persist($apps);
//            $manager->flush();
//
//            return $this->redirectToRoute('apps_overzicht');
//        }
//        return $this->render('admin/app/apps_slug_admin.html.twig', [
//            'form' => $form->createView(),
//        ]);
//    }
//
//    /**
//     * @Route("/{_locale}/admin/apps_overzicht/edit_apps/{id}", name="edit_apps", methods={"GET","POST"})
//     */
//    public function edit_apps(Request $request, $id)
//    {
//        $apps = $this->getDoctrine()->getRepository(Apps::class)->findOneBy([
//            'id' => $id,
//        ]);
//
//        $apps->setImage($apps->getImage());
//
//        $form = $this->createForm(AppsType::class, $apps);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//
//            $apps = $form->getData();
//
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($apps);
//            $em->flush();
//
//            return $this->redirectToRoute('apps_overzicht',[
//                'id' => $apps->getId(),
//            ]);
//        }
//        return $this->render('admin/app/apps_admin_toevoegen.html.twig', [
//            'form' => $form->createView()
//        ]);
//    }
    //end apps





    /**
     * @Route("/{_locale}/admin/nieuwsbrief", name="nieuwsbrief")
     *  @IsGranted("ROLE_USER")
     */
    public function nieuwsbrief()
    {
        $gegeven = $this->getDoctrine()->getRepository(Nieuwsbrief::class)->findAll();

        return $this->render('admin/nieuwsbrief/nieuwsbrief.html.twig', [
            'gegeven' => $gegeven
        ]);

    }
    /**
     * @Route("/{_locale}/admin/nieuwsbrief/aanmaken", name="nieuwsbriefaanmaken")
     *  @IsGranted("ROLE_USER")
     */
    public function nieuwsbriefaanmaken(Request $request, EntityManagerInterface $entityManager, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(NewsType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $bericht = $form->get('bericht')->getData();
            $reply = $this->getDoctrine()->getRepository(Nieuwsbrief::class)->findAll();

            $mail = $reply->getEmail();

            $message = (new \Swift_Message('Bericht van Onetoshop'))
                ->setFrom('dummyonetoshop@gmail.com')
                ->setSubject('Nieuwsbrief')
                ->setTo($mail)
                ->setBody($bericht, 'text/html');
            $mailer->send($message);
            $this->addFlash('success', "Nieuwsbrief gestuurd");
            return $this->redirectToRoute('nieuwsbrief');

        }
        return $this->render('admin/nieuwsbrief/nieuws.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/{_locale}/admin/project_overzicht", name="project_overzicht")
     * @IsGranted("ROLE_USER")
     */
    public function project_show()
    {
        $project = $this->getDoctrine()->getRepository(Project::class)->findall();
        return $this->render('admin/project/project_show.html.twig', [
            'project' => $project
        ]);
    }

    /**
     * @Route("/{_locale}/admin/project_overzicht/delete_project/{id}", name="delete_project")
     * @IsGranted("ROLE_USER")
     */
    public function delete_project(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $project = $em->getRepository(Project::class)->find($id);

        $em->remove($project);
        $em->flush();

        return $this->redirectToRoute('project_overzicht');
    }

    /**
     * @Route("/{_locale}/admin/project_overzicht/show/{naam}", name="show_project")
     * @IsGranted("ROLE_USER")
     */
    public function show_project($naam)
    {
        $project = $this->getDoctrine()->getRepository(Project::class)->findBy([
            'naam' => $naam
        ]);

        return $this->render('admin/project/show_project.html.twig', [
            'project' => $project
        ]);
    }

    /**
     * @Route("/{_locale}/admin/project_overzicht/add_project", name="add_project")
     * @IsGranted("ROLE_USER")
     */
    public function add_project(EntityManagerInterface $manager, Request $request)
    {
        $form = $this->createForm(ProjectType::Class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $project = $form->getData();

            $file = $project->getImage();

            $image = $file->getFile();

            $fileName = md5(uniqid()) . '.' . $image->guessExtension();

            $image->move($this->getParameter('project'), $fileName);

            $file->setName($fileName);

            $manager->persist($project);
            $manager->flush();

            return $this->redirectToRoute('project_overzicht');
        }
        return $this->render('admin/project/add_project.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{_locale}/admin/project_overzicht/edit_project/{id}", name="edit_project", methods={"GET","POST"})
     */
    public function edit_project(Request $request, $id)
    {
        $project = $this->getDoctrine()->getRepository(Project::class)->findOneBy([
            'id' => $id,
        ]);

        $project->setImage($project->getImage());

        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $project = $form->getData();

            $file = $project->getImage();

            $image = $file->getFile();

            $fileName = md5(uniqid()) . '.' . $image->guessExtension();

            $image->move($this->getParameter('project'), $fileName);

            $file->setName($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            return $this->redirectToRoute('project_overzicht',[
                'id' => $project->getId(),
            ]);
        }
        return $this->render('admin/project/edit_project.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}