<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Room;
use App\Form\Admin\RoomType;
use App\Repository\Admin\RoomRepository;
use App\Repository\DormitoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/room')]
class RoomController extends AbstractController
{
    #[Route('/', name: 'app_admin_room_index', methods: ['GET'])]
    public function index(RoomRepository $roomRepository): Response
    {
        return $this->render('admin/room/index.html.twig', [
            'rooms' => $roomRepository->findAll(),
        ]);
    }

    #[Route('/new/{id}', name: 'app_admin_room_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, $id, DormitoryRepository $dormitoryRepository, RoomRepository $roomRepository ): Response
    {
        $rooms= $roomRepository->findOneBy(['dormitoryid'=>$id]);
        $dormitory= $dormitoryRepository->findOneBy(['id'=>$id]);
        // echo $dormitory->getTitle();
        // dump($dormitory);
        // die();

        $room = new Room();
        $form = $this->createForm(RoomType::class, $room);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $room->setDormitoryid($id);
            $entityManager->persist($room);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_room_new', ['id'=>$id], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/room/new.html.twig', [
            'dormitory' => $dormitory,
            'room' => $room,
            'rooms' => $rooms,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_admin_room_show', methods: ['GET'])]
    public function show(Room $room): Response
    {
        return $this->render('admin/room/show.html.twig', [
            'room' => $room,
        ]);
    }

    #[Route('/{id}/edit/{did}', name: 'app_admin_room_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Room $room, $did, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RoomType::class, $room);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_room_new', ['id'=>$did], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/room/edit.html.twig', [
            'room' => $room,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/{did}', name: 'app_admin_room_delete', methods: ['POST'])]
    public function delete(Request $request, Room $room, $did ,EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$room->getId(), $request->request->get('_token'))) {
            $entityManager->remove($room);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_room_new', ['id'=>$did], Response::HTTP_SEE_OTHER);
    }
}
