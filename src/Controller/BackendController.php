<?php

namespace App\Controller;

use App\Entity\Aanmeld;
use App\Entity\App;
use App\Entity\Appinfo;
use App\Entity\Appinformatie;
use App\Entity\Apps;
use App\Entity\Blog;
use App\Entity\Card;
use App\Entity\Contact;
use App\Entity\Gegeven;
use App\Entity\Project;
use App\Entity\User;
use App\Form\AppinformatieType;
use App\Form\AppinfoType;
use App\Form\AppsType;
use App\Form\AppType;
use App\Form\BlogType;
use App\Form\ProjectType;
use App\Form\UserType;
use App\Repository\BlogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\AanmeldType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Form\GegevenType;
use App\Entity\Nieuwsbrief;
use App\Entity\Reply;
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
            'aanmeldingen' => $aanmeld,
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
    public function reply(Request $request, $id, \Swift_Mailer $mailer) {
        $reply = $this->getDoctrine()->getRepository(Reply::class)->findOneBy([
            'id' => $id,
        ]);


        $form = $this->createForm(ReplyType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $form = $form->getData();

            $message = (new \Swift_Message('Bericht van Onetoshop'))
                ->setFrom('dummyonetoshop@gmail.com')
                ->setSubject($form['Onderwerp'])
                ->setTo($form['Geadresseerde'])
                ->setBody($form['Bericht'], 'text/html');
            $mailer->send($message);

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

    /**
     * @Route("/admin/app_overzicht", name="app_overzicht")
     * @IsGranted("ROLE_USER")
     */
    public function app_show()
    {
        $app1 = $this->getDoctrine()->getRepository(App::class)->findAll();
        return $this->render('admin/app/app_show.html.twig', [
            'app1' => $app1
        ]);
    }

    /**
     * @Route("/admin/app_overzicht/delete_app/{id}", name="delete_app")
     * @IsGranted("ROLE_USER")
     */
    public function delete_app(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $app = $em->getRepository(App::class)->find($id);

        $em->remove($app);
        $em->flush();

        return $this->redirectToRoute('app_overzicht');
    }

    /**
     * @Route("/admin/app_overzicht/show/{slug}", name="show_app")
     * @IsGranted("ROLE_USER")
     */
    public function show_card($slug)
    {
        $app1 = $this->getDoctrine()->getRepository(App::class)->findBy([
            'naam' => $slug
        ]);

        return $this->render('admin/app/show_app.html.twig', [
            'app1' => $app1
        ]);
    }

    /**
     * @Route("/admin/app_overzict/add_app", name="add_app")
     * @IsGranted("ROLE_USER")
     */
    public function add_app(EntityManagerInterface $manager, Request $request)
    {
        $form = $this->createForm(AppType::Class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $app = $form->getData();

            $manager->persist($app);
            $manager->flush();

            return $this->redirectToRoute('app_overzicht');
        }
        return $this->render('admin/app/add_app.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/app_overzicht/edit_app/{id}", name="edit_app", methods={"GET","POST"})
     */
    public function edit_card(Request $request, $id)
    {
        $app = $this->getDoctrine()->getRepository(App::class)->findOneBy([
            'id' => $id,
        ]);

        $form = $this->createForm(AppType::class, $app);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $app = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($app);
            $em->flush();

            return $this->redirectToRoute('app_overzicht', [
                'id' => $app->getId(),
            ]);
        }
        return $this->render('admin/app/edit_app.html.twig', [
            'form' => $form->createView()
        ]);
    }

    //admin
    //appinformatie
    /**
     * @Route("/{_locale}/admin/appinformatie_overzicht", name="appinformatie_overzicht")
     * @IsGranted("ROLE_USER")
     */
    public function appinformatie_show()
    {
        $appinformatie = $this->getDoctrine()->getRepository(Appinformatie::class)->findAll();
        return $this->render('admin/app/appinformatie_show.html.twig', [
            'appinformatie' => $appinformatie
        ]);
    }

    /**
     * @Route("/{_locale}/admin/appinformatie_overzicht/delete_appinformatie/{id}", name="delete_appinformatie")
     * @IsGranted("ROLE_USER")
     */
    public function delete_appinformatie(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $appinformatie = $em->getRepository(Appinformatie::class)->find($id);

        $em->remove($appinformatie);
        $em->flush();

        return $this->redirectToRoute('appinformatie_overzicht');
    }

    /**
     * @Route("/{_locale}/admin/appinformatie_overzicht/show/{slug}", name="show_appinformatie")
     * @IsGranted("ROLE_USER")
     */
    public function show_appinformatie($slug)
    {
        $appinformatie = $this->getDoctrine()->getRepository(Appinformatie::class)->findBy([
            'title' => $slug
        ]);

        return $this->render('admin/app/show_appinformatie.html.twig', [
            'appinformatie' => $appinformatie
        ]);
    }

    /**
     * @Route("/{_locale}/admin/appinformatie_overzicht/add_appinformatie", name="add_appinformatie")
     * @IsGranted("ROLE_USER")
     */
    public function add_appinformatie(EntityManagerInterface $manager, Request $request)
    {
        $form = $this->createForm(AppinformatieType::Class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $appinformatie = $form->getData();

            $manager->persist($appinformatie);
            $manager->flush();

            return $this->redirectToRoute('appinformatie_overzicht');
        }
        return $this->render('admin/app/add_appinformatie.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{_locale}/admin/appinformatie_overzicht/edit_appinformatie/{id}", name="edit_appinformatie", methods={"GET","POST"})
     */
    public function edit_appinformatie(Request $request, $id)
    {
        $appinformatie = $this->getDoctrine()->getRepository(Appinformatie::class)->findOneBy([
            'id' => $id,
        ]);

        $form = $this->createForm(AppinformatieType::class, $appinformatie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $appinformatie = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($appinformatie);
            $em->flush();

            return $this->redirectToRoute('app_overzicht', [
                'id' => $appinformatie->getId(),
            ]);
        }
        return $this->render('admin/app/edit_appinformatie.html.twig', [
            'form' => $form->createView()
        ]);
    }

    //admin
    //appinfo
    /**
     * @Route("/{_locale}/admin/appinfo_overzicht", name="appinfo_overzicht")
     * @IsGranted("ROLE_USER")
     */
    public function appinfo_show()
    {
        $appinfo = $this->getDoctrine()->getRepository(Appinfo::class)->findAll();
        return $this->render('admin/app/appinfo_show.html.twig', [
            'appinfo' => $appinfo
        ]);
    }

    /**
     * @Route("/admin/appinfo_overzicht/delete_appinfo/{id}", name="delete_appinfo")
     * @IsGranted("ROLE_USER")
     */
    public function delete_appinfo(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $appinfo = $em->getRepository(Appinfo::class)->find($id);

        $em->remove($appinfo);
        $em->flush();

        return $this->redirectToRoute('appinfo_overzicht');
    }

    /**
     * @Route("/{_locale}/admin/appinfo_overzicht/show/{slug}", name="show_appinfo")
     * @IsGranted("ROLE_USER")
     */
    public function show_appinfo($slug)
    {
        $appinfo = $this->getDoctrine()->getRepository(Appinfo::class)->findBy([
            'naam' => $slug
        ]);

        return $this->render('admin/app/show_appinfo.html.twig', [
            'appinfo' => $appinfo
        ]);
    }

    /**
     * @Route("/{_locale}/admin/appinfo_overzicht/add_appinfo", name="add_appinfo")
     * @IsGranted("ROLE_USER")
     */
    public function add_appinfo(EntityManagerInterface $manager, Request $request)
    {
        $form = $this->createForm(AppinfoType::Class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $appinfo = $form->getData();

            $manager->persist($appinfo);
            $manager->flush();

            return $this->redirectToRoute('appinformatie_overzicht');
        }
        return $this->render('admin/app/add_appinfo.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{_locale}/admin/appinfo_overzicht/edit_appinfo/{id}", name="edit_appinfo", methods={"GET","POST"})
     */
    public function edit_appinfo(Request $request, $id)
    {
        $appinfo = $this->getDoctrine()->getRepository(Appinfo::class)->findOneBy([
            'id' => $id,
        ]);

        $form = $this->createForm(AppinfoType::class, $appinfo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $appinfo = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($appinfo);
            $em->flush();

            return $this->redirectToRoute('appinfo_overzicht', [
                'id' => $appinfo->getId(),
            ]);
        }
        return $this->render('admin/app/edit_appinfo.html.twig', [
            'form' => $form->createView()
        ]);
    }

    //admin
    //apps
    /**
     * @Route("/{_locale}/admin/apps_overzicht", name="apps_overzicht")
     * @IsGranted("ROLE_USER")
     */
    public function apps_show()
    {
        $apps = $this->getDoctrine()->getRepository(Apps::class)->findAll();
        return $this->render('admin/app/apps_show.html.twig', [
            'apps' => $apps
        ]);
    }

    /**
     * @Route("/{_locale}/admin/apps_overzicht/delete_apps/{id}", name="delete_apps")
     * @IsGranted("ROLE_USER")
     */
    public function delete_apps(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $apps = $em->getRepository(Apps::class)->find($id);

        $em->remove($apps);
        $em->flush();

        return $this->redirectToRoute('apps_overzicht');
    }

    /**
     * @Route("/{_locale}/admin/apps_overzicht/show/{slug}", name="show_apps")
     * @IsGranted("ROLE_USER")
     */
    public function show_apps($slug)
    {
        $apps = $this->getDoctrine()->getRepository(Apps::class)->findBy([
            'title' => $slug
        ]);

        return $this->render('admin/app/show_apps.html.twig', [
            'apps' => $apps
        ]);
    }

    /**
     * @Route("/{_locale}/admin/apps_overzicht/add_apps", name="add_apps")
     * @IsGranted("ROLE_USER")
     */
    public function add_apps(EntityManagerInterface $manager, Request $request)
    {
        $form = $this->createForm(AppsType::Class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $apps = $form->getData();

            $file = $apps->getImage();

            $image = $file->getFile();

            $fileName = md5(uniqid()) . '.' . $image->guessExtension();

            $image->move($this->getParameter('apps'), $fileName);

            $file->setName($fileName);

            $manager->persist($apps);
            $manager->flush();

            return $this->redirectToRoute('apps_overzicht');
        }
        return $this->render('admin/app/add_apps.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{_locale}/admin/apps_overzicht/edit_apps/{id}", name="edit_apps", methods={"GET","POST"})
     */
    public function edit_apps(Request $request, $id)
    {
        $apps = $this->getDoctrine()->getRepository(Apps::class)->findOneBy([
            'id' => $id,
        ]);

        $apps->setImage($apps->getImage());

        $form = $this->createForm(AppsType::class, $apps);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $apps = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($apps);
            $em->flush();

            return $this->redirectToRoute('apps_overzicht',[
                'id' => $apps->getId(),
            ]);
        }
        return $this->render('admin/app/edit_apps.html.twig', [
            'form' => $form->createView()
        ]);
    }
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

            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            return $this->redirectToRoute('project_overzicht',[
                'id' => $project->getId(),
            ]);
        }
        return $this->render('admin/project/edit_project.html.twig', [
            'form' => $form->createView()
        ]);
    }
}