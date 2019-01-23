<?php

namespace App\Controller;

use App\Entity\Prix;
use App\Form\PriceType;
use App\Repository\PeriodRepository;
use App\Repository\PrixRepository;
use App\Repository\VisitorsRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminPriceController extends AbstractController
{
    /**
     * @Route("/admin/price", name="admin_price")
     * @param PrixRepository $prix
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(PrixRepository $prix, VisitorsRepository $visitors, PeriodRepository $periods)
    {
        return $this->render('admin/price/index.html.twig', [
            'prices' => $prix->findAll(),
            'visitors' => $visitors->findAll(),
            'periods' => $periods->findAll()
        ]);
    }

    /**
     * @Route("/admin/price/{id}/edit", name="admin_price_edit")
     * @param Request $request
     * @param ObjectManager $manager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function edit(Prix $prix, Request $request, ObjectManager $manager)
    {
        $form =$this->createForm(PriceType::class, $prix);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($prix);
            $manager->flush();
            $this->addFlash(
                'success',
                "Le prix a bien été sauvegardé !"
            );
            return $this->redirectToRoute('admin_price');
        }

        return $this->render('admin/price/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
