<?php

namespace App\Controller;

use App\Entity\App;
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
     * @Route("/app/{slug}", name="apps")
     */
    public function apps($slug){
        $apps = $this->getDoctrine()->getRepository(App::class)->findBy([
            'naam' => $slug
    ]);

        return $this->render('app/apps.html.twig',[
          'apps' => $apps
        ]);
    }
}
