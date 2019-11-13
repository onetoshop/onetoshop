<?php

namespace App\Controller;

use App\Entity\Aanmeld;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\AanmeldType;
use Symfony\Component\HttpFoundation\Request;

class BackendController extends AbstractController
{

//    /**
//     * @Route("/admin", name="admin")
//     */
//    public function index()
//    {
//        return $this->render('admin/index.html.twig');
//    }
    /**
     * @Route("/admin", name="admin")
     */
    public function show()
    {
        $aanmeld = $this->getDoctrine()->getRepository(Aanmeld::class)->findAll();
        return $this->render('admin/index.html.twig', [
            'aanmeldingen' => $aanmeld
        ]);
    }
}


