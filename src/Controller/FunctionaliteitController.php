<?php

namespace App\Controller;

use App\Entity\Functionaliteit;
use App\Form\FunctionaliteitType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
class FunctionaliteitController extends AbstractController
{
    /**
     * @Route("/{_locale}/functionaliteit", name="functionaliteit")
     */
    public function index()
    {
        $functionaliteit = $this->getDoctrine()->getRepository(Functionaliteit::class)->findBy([
            'parent' => 1
        ]);

        $functionaliteitinfo = $this->getDoctrine()->getRepository(Functionaliteit::class)->findBy([
            'parent' => NULL
        ]);

        return $this->render('functionaliteit/functionaliteit.html.twig', [
            'functionaliteit' => $functionaliteit,
            'functionaliteitinfo' => $functionaliteitinfo
        ]);

    }

    /**
     * @Route("/{_locale}/functies/{slug}", name="functionaliteitinfo")
     */
    public function functionaliteitinfo($slug)
    {
        $functionaliteit = $this->getDoctrine()->getRepository(Functionaliteit::class)->findBy([
            'slug' => $slug
        ]);

        $functionaliteitinfo = $this->getDoctrine()->getRepository(Functionaliteit::class)->findBy([
            'parent' => $functionaliteit[0]->getId()
        ]);

        return $this->render('functionaliteit/functionaliteitinfo.html.twig', [
            'functionaliteit' => $functionaliteit,
            'functionaliteitinfo' => $functionaliteitinfo

        ]);
    }


    /**
     * @Route("/{_locale}/admin/functionaliteit", name="functionaliteitadmin")
     */
    public function adminfunctionaliteit(Request $request)
    {
        $functionaliteit = $this->getDoctrine()->getRepository(Functionaliteit::class)->findBy([
            'parent' => NULL
        ]);

        return $this->render('admin/functionaliteit/functionaliteit.html.twig', array(
            'functionaliteit' => $functionaliteit
        ));
    }

    /**
     * @Route("/{_locale}/admin/functionaliteit/delete/{id}", name="delete_functionaliteit")
     * @IsGranted("ROLE_USER")
     */
    public function delete_functionaliteit($id)
    {
        $em = $this->getDoctrine()->getManager();

        $dell = $this->getDoctrine()->getRepository(Functionaliteit::class)->findOneBy([
            'id' => $id,
        ]);

        $em->remove($dell);
        $em->flush();

        return $this->redirectToRoute('functionaliteitadmin');
    }


    /**
     * @Route("/{_locale}/admin/functionaliteit_toevoegen", name="functionaliteit_toevoegen")
     * @IsGranted("ROLE_USER")
     */
    public function functionaliteit_toevoegen(EntityManagerInterface $manager, Request $request)
    {
        $form = $this->createForm(FunctionaliteitType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $functionaliteit = $form->getData();

            $manager->persist($functionaliteit);
            $manager->flush();

            return $this->redirectToRoute('functionaliteitadmin');

        }
        return $this->render('admin/functionaliteit/functionaliteit_toevoegen.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{_locale}/admin/functionaliteit/{slug}", name="functionaliteit_slug_admin")
     * @IsGranted("ROLE_USER")
     */
    public function functionaliteit_slug_admin($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $name = $em->getRepository(functionaliteit::class);

        $info = $name->createQueryBuilder('naam')
            ->select('naam')
            ->where('naam.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getResult();

        $functie = $this->getDoctrine()->getRepository(functionaliteit::class)->findBy([
            'slug'  => $slug
        ]);

        $functionaliteit = $this->getDoctrine()->getRepository(functionaliteit::class)->findBy([
            'parent'  => $functie[0]->getId()
        ]);

        return $this->render('admin/functionaliteit/functionaliteit_slug_admin.html.twig', [
            'functionaliteit' => $functionaliteit,
            'info' => $info[0]
        ]);
    }

    /**
     * @Route("/{_locale}/admin/functionaliteit/edit/{id}", name="edit_functionaliteit", methods={"GET","POST"})
     */
    public function edit_functionaliteit(Request $request, $id)
    {
        $functionaliteit = $this->getDoctrine()->getRepository(functionaliteit::class)->findOneBy([
            'id' => $id,
        ]);

        $form = $this->createForm(FunctionaliteitType::class, $functionaliteit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $functionaliteit = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($functionaliteit);
            $em->flush();

            return $this->redirectToRoute('functionaliteitadmin',[
                'id' => $functionaliteit->getId(),
            ]);
        }
        return $this->render('admin/functionaliteit/edit_functionaliteit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
