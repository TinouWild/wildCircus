<?php

namespace App\Controller;

use App\Entity\About;
use App\Form\AboutType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminAboutController extends AbstractController
{
    /**
     * @Route("/admin/about/{id<\d+>?1}", name="admin_about")
     * @param About $about
     * @param Request $request
     * @param ObjectManager $manager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(About $about, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(AboutType::class, $about);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($about);
            $manager->flush();
            $this->addFlash(
                'success',
                "Votre page d'accueil a été modifiée !"
            );
            return $this->redirectToRoute('admin_about');
        }
        return $this->render('admin/about/index.html.twig', [
            'form' => $form->createView(),
            'about' => $about
        ]);
    }
}
