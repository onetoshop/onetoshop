<?php

namespace App\Controller;

use App\Entity\App;
use App\Entity\Appinfo;
use App\Entity\Appinformatie;
use App\Entity\Apps;
use App\Form\AppinformatieType;
use App\Form\AppinfoType;
use App\Form\AppsType;
use App\Form\AppType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class AppController extends AbstractController
{
    /**
     * @Route("/app", name="app")
     */
    public function app()
    {
        $app = $this->getDoctrine()->getRepository(App::class)->findAll();

        return $this->render('app/app.html.twig', [
            'app' => $app
        ]);
    }

    /**
     * @Route("/app/{slug}", name="appinfo")
     */
    public function appinfo($slug){
        $appinfo = $this->getDoctrine()->getRepository(Appinfo::class)->findBy([
            'groep' => $slug
        ]);

        $appinformatie = $this->getDoctrine()->getRepository(Appinformatie::class)->findBy([
            'groep' => $slug
        ]);

        return $this->render('app/apps.html.twig',[
          'appinfo' => $appinfo,
          'appinformatie' => $appinformatie
        ]);
    }

    /**
     * @Route("/app/{slug}/{naam}", name="apps")
     */
    public function apps($slug, $naam)
    {
        $apps = $this->getDoctrine()->getRepository(Apps::class)->findBy([
            'groep' => $slug,
            'naam'  => $naam
        ]);

        return $this->render('app/appsinfo.html.twig',[
            'apps' => $apps
        ]);
    }

    //admin
    //app
    /**
     * @Route("/admin/app_overzicht", name="app_overzicht")
     * @IsGranted("ROLE_USER")
     */
    public function app_show()
    {
        $app1 = $this->getDoctrine()->getRepository(App::class)->findAll();
        return $this->render('app/app_show.html.twig', [
            'app1' => $app1
        ]);
    }

    /**
     * @Route("/admin/delete_app/{id}", name="delete_app")
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

        return $this->render('app/show_app.html.twig', [
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
        return $this->render('app/add_app.html.twig', [
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
        return $this->render('app/edit_app.html.twig', [
            'form' => $form->createView()
        ]);
    }

    //admin
    //appinformatie
    /**
     * @Route("/admin/appinformatie_overzicht", name="appinformatie_overzicht")
     * @IsGranted("ROLE_USER")
     */
    public function appinformatie_show()
    {
        $appinformatie = $this->getDoctrine()->getRepository(Appinformatie::class)->findAll();
        return $this->render('app/appinformatie_show.html.twig', [
            'appinformatie' => $appinformatie
        ]);
    }

    /**
     * @Route("/admin/delete_appinformatie/{id}", name="delete_appinformatie")
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
     * @Route("/admin/appinformatie_overzicht/show/{slug}", name="show_appinformatie")
     * @IsGranted("ROLE_USER")
     */
    public function show_appinformatie($slug)
    {
        $appinformatie = $this->getDoctrine()->getRepository(Appinformatie::class)->findBy([
            'title' => $slug
        ]);

        return $this->render('app/show_appinformatie.html.twig', [
            'appinformatie' => $appinformatie
        ]);
    }

    /**
     * @Route("/admin/appinformatie_overzicht/add_appinformatie", name="add_appinformatie")
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
        return $this->render('app/add_appinformatie.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/appinformatie_overzicht/edit_appinformatie/{id}", name="edit_appinformatie", methods={"GET","POST"})
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
        return $this->render('app/edit_appinformatie.html.twig', [
            'form' => $form->createView()
        ]);
    }

    //admin
    //appinfo
    /**
     * @Route("/admin/appinfo_overzicht", name="appinfo_overzicht")
     * @IsGranted("ROLE_USER")
     */
    public function appinfo_show()
    {
        $appinfo = $this->getDoctrine()->getRepository(Appinfo::class)->findAll();
        return $this->render('app/appinfo_show.html.twig', [
            'appinfo' => $appinfo
        ]);
    }

    /**
     * @Route("/admin/delete_appinfo/{id}", name="delete_appinfo")
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
     * @Route("/admin/appinfo_overzicht/show/{slug}", name="show_appinfo")
     * @IsGranted("ROLE_USER")
     */
    public function show_appinfo($slug)
    {
        $appinfo = $this->getDoctrine()->getRepository(Appinfo::class)->findBy([
            'naam' => $slug
        ]);

        return $this->render('app/show_appinfo.html.twig', [
            'appinfo' => $appinfo
        ]);
    }

    /**
     * @Route("/admin/appinfo_overzicht/add_appinfo", name="add_appinfo")
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
        return $this->render('app/add_appinfo.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/appinfo_overzicht/edit_appinfo/{id}", name="edit_appinfo", methods={"GET","POST"})
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
        return $this->render('app/edit_appinfo.html.twig', [
            'form' => $form->createView()
        ]);
    }











    //apps
    /**
     * @Route("/admin/apps/add_apps", name="add_apps")
     * @IsGranted("ROLE_USER")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $imageEn = new Apps();

        $form = $this->createForm(AppsType::class, $imageEn);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */

            $file = $form->get('image')->getData();
            ($imageEn->getImage());
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('apps'), $fileName);


            $imageEn->setImage($fileName);
            $em->persist($imageEn);
            $em->flush();


            $this->addFlash(
                'info',
                'Card Succesvol Aangemaakt!'
            );

            return $this->redirectToRoute('add_apps');

        }

        return $this->render('app/add_apps.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
