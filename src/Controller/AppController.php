<?php

namespace App\Controller;

use App\Entity\App;
use App\Entity\Appinfo;
use App\Entity\Appinformatie;
use App\Entity\Apps;
use App\Form\AppsType;
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


    /**
     * @Route("/admin/app/add_apps", name="add_apps")
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

        return $this->render('app/upload.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
