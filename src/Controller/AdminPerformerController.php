<?php

namespace App\Controller;

use App\Entity\Performers;
use App\Form\PerformerType;
use App\Repository\PerformersRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminPerformerController extends AbstractController
{
    /**
     * @Route("/admin/performer", name="admin_performer")
     * @param PerformersRepository $repo
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function index(PerformersRepository $repo)
    {
        return $this->render('admin/performers/index.html.twig', [
            'performers' => $repo->findAll()
        ]);
    }

    /**
     * @Route("/admin/performer/new", name="admin_performer_new")
     * @param Request $request
     * @param ObjectManager $manager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request, ObjectManager $manager)
    {
        $performer = new Performers();
        $form = $this->createForm(PerformerType::class, $performer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($performer);
            $manager->flush();
            $this->addFlash(
                'success',
                "Le performer a bien été créé !"
            );
            return $this->redirectToRoute('admin_performer');
        }

        return $this->render('admin/performers/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/performer/{id}/edit", name="admin_performer_edit")
     * @param Performers $performers
     * @param Request $request
     * @param ObjectManager $manager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function edit(Performers $performers, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(PerformerType::class, $performers);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($performers);
            $manager->flush();
            $this->addFlash(
                'success',
                "Le performer a bien été édité !"
            );
            return $this->redirectToRoute('admin_performer');
        }

        return $this->render('admin/performers/edit.html.twig', [
            'form' => $form->createView(),
            'performers' => $performers
        ]);
    }

    /**
     * @Route("/admin/performer/{id}/delete", name="admin_performer_delete")
     * @param Performers $performers
     * @param ObjectManager $manager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Performers $performers, ObjectManager $manager)
    {
        $manager->remove($performers);
        $manager->flush();
        $this->addFlash(
            'success',
            "Le performer a bien été supprimé !"
        );

        return $this->redirectToRoute("admin_performer");
    }
}
