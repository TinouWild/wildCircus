<?php

namespace App\Controller;

use App\Entity\Performance;
use App\Form\PerformanceType;
use App\Repository\PerformanceRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminPerformanceController extends AbstractController
{
    /**
     * @Route("/admin/performance", name="admin_performance")
     */
    public function index(PerformanceRepository $repository)
    {
        return $this->render('admin/performance/index.html.twig', [
            'performances' => $repository->findAll()
        ]);
    }

    /**
     * @Route("/admin/performance/new", name="admin_performance_new")
     * @param Request $request
     * @param ObjectManager $manager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request, ObjectManager $manager)
    {
        $performance = new Performance();
        $form = $this->createForm(PerformanceType::class, $performance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($performance);
            $manager->flush();
            $this->addFlash(
                'succes',
                "Le spectacle a bien été créé !"
            );
            return $this->redirectToRoute('admin_performance');
        }
        return $this->render('admin/performance/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/performance/{id}/edit", name="admin_performance_edit")
     * @param Performance $performance
     * @param Request $request
     * @param ObjectManager $manager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function edit(Performance $performance, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(PerformanceType::class, $performance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($performance);
            $manager->flush();
            $this->addFlash(
                'succes',
                "Le spectacle a bien été modifié !"
            );
            return $this->redirectToRoute('admin_performance');
        }
        return $this->render('admin/performance/edit.html.twig', [
            'form' => $form->createView(),
            'performance' => $performance
        ]);
    }

    /**
     * @Route("/admin/performance/{id}/delete", name="admin_performance_delete")
     * @param Performance $performance
     * @param ObjectManager $manager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Performance $performance, ObjectManager $manager)
    {
        $manager->remove($performance);
        $manager->flush();
        $this->addFlash(
            'succes',
            "Le spectacle a bien été supprimé !"
        );
        return $this->redirectToRoute('admin_performance');
    }
}
