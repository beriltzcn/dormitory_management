<?php

namespace App\Controller;

use App\Entity\Dormitory;
use App\Form\Dormitory1Type;
use App\Repository\DormitoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user/dormitory')]
class DormitoryController extends AbstractController
{
    #[Route('/', name: 'app_dormitory_index', methods: ['GET'])]
    public function index(DormitoryRepository $dormitoryRepository): Response
    {
        return $this->render('dormitory/index.html.twig', [
            'dormitories' => $dormitoryRepository->findAll(),
        ]);
    }

    #[Route('/user/new', name: 'app_dormitory_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $dormitory = new Dormitory();
        $form = $this->createForm(Dormitory1Type::class, $dormitory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($dormitory);
            $entityManager->flush();

            return $this->redirectToRoute('app_dormitory_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('dormitory/new.html.twig', [
            'dormitory' => $dormitory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dormitory_show', methods: ['GET'])]
    public function show(Dormitory $dormitory): Response
    {
        return $this->render('dormitory/show.html.twig', [
            'dormitory' => $dormitory,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_dormitory_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Dormitory $dormitory, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Dormitory1Type::class, $dormitory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_dormitory_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('dormitory/edit.html.twig', [
            'dormitory' => $dormitory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dormitory_delete', methods: ['POST'])]
    public function delete(Request $request, Dormitory $dormitory, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dormitory->getId(), $request->request->get('_token'))) {
            $entityManager->remove($dormitory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_dormitory_index', [], Response::HTTP_SEE_OTHER);
    }
}
