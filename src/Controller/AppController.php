<?php

namespace App\Controller;

use App\Entity\Apps;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AppController extends AbstractController
{
    /**
     * @Route("/{_locale}/apps/{slug}", name="apps_slug")
     */
    public function app($slug)
    {

        $app = $this->getDoctrine()->getRepository(Apps::class)->findBy([
            'slug'  => $slug
        ]);

        $apps = $this->getDoctrine()->getRepository(Apps::class)->findBy([
            'apps'  => $app[0]->getId()
        ]);

        return $this->render('app/app.html.twig', [
            'apps' => $apps,
            'app' => $app
        ]);
    }



    /**
     * @Route("/{_locale}/apps", name="apps")
     */
    public function appinfo(){
        $apps = $this->getDoctrine()->getRepository(Apps::class)->findBy([
            'apps' => NULL
        ]);

        return $this->render('app/apps.html.twig',[
            'apps' => $apps
        ]);
    }

    /**
     * @Route("/{_locale}/app/{slug}", name="app")
     */
    public function apps($slug)
    {
        $apps = $this->getDoctrine()->getRepository(Apps::class)->findBy([
            'slug'  => $slug
        ]);

        return $this->render('app/appsinfo.html.twig',[
            'apps' => $apps
        ]);
    }

}
