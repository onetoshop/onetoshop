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
     * @Route("/{_locale}/apps", name="apps")
     */
    public function app()
    {
        $apps = $this->getDoctrine()->getRepository(App::class)->findAll();

        return $this->render('app/app.html.twig', [
            'apps' => $apps
        ]);
    }

    /**
     * @Route("/{_locale}/apps/{slug}", name="appinfo")
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
     * @Route("/{_locale}/app/{naam}", name="app")
     */
    public function apps($naam)
    {
        $apps = $this->getDoctrine()->getRepository(Apps::class)->findBy([
            'naam'  => $naam
        ]);

        return $this->render('app/appsinfo.html.twig',[
            'apps' => $apps
        ]);
    }

}
