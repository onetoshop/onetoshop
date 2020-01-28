<?php

namespace App\Controller;

use App\Entity\Images;
use App\Entity\Image;
use App\Entity\Media;
use App\Form\BlogType;
use App\Form\ImageType;
use App\Form\MediaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class MediaController extends AbstractController
{
    /**
     * @Route("/{_locale}/admin/media", name="media")
     * @IsGranted("ROLE_USER")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        $media = $this->getDoctrine()->getRepository(Images::class)->findAll();

        return $this->render('admin/media/media.html.twig', [
            'media' => $media
        ]);

    }

    /**
     * @Route("/{_locale}/admin/media/delete/{id}", name="media_delete")
     * @IsGranted("ROLE_USER")
     */
    public function edit(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $image = $em->getRepository(Images::class)->find($id);

        $em->remove($image);
        $em->flush();



        return $this->redirectToRoute('media');
    }
    /**
     * @Route("/{_locale}/admin/media/add", name="media_add")
     * @IsGranted("ROLE_USER")
     */
    public function add_blog(EntityManagerInterface $manager, Request $request)
    {
        $form = $this->createForm(ImageType::Class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $files = $request->files->get('image')['file'];


            foreach ($files as $file) {

                $fileName = md5(uniqid()) . '.' . $file->guessExtension();

                $file->move($this->getParameter('images'), $fileName);
                $images = new Images();

                $images->setName($fileName);
                $manager->persist($images);

            }


            $manager->flush();

            return $this->redirectToRoute('media');
        }
        return $this->render('admin/media/addmedia.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
