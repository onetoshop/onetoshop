<?php

namespace App\Controller;

use App\Entity\App;
use App\Entity\Appinfo;
use App\Entity\Appinformatie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/app/{slug}/{title}", name="apps")
     */
    public function apps($slug, $title)
    {
        return $this->render('app/appsinfo.html.twig',[

        ]);
    }

}
