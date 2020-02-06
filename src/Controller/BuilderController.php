<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BuilderController extends AbstractController
{
    /**
     * @Route("/{_locale}/sitebuilder", name="sitebuilder")
     * @IsGranted("ROLE_USER")
     */
    public function index()
    {
        return $this->render('admin/builder/index.html.twig', [
            'controller_name' => 'BuilderController',
        ]);
    }
}
