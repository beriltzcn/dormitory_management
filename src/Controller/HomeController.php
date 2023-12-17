<?php

namespace App\Controller;

use App\Repository\SettingRepository;
use App\Repository\DormitoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(SettingRepository $settingRepository, DormitoryRepository $dormitoryRepository): Response
    {
        $setting = $settingRepository->findOneBy(['id'=>1]);
        $dormitories = $dormitoryRepository->findBy([],['title'=>'DESC'],4);
        // dump($setting);
        // die();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'setting'=>$setting,
            'dormitories'=>$dormitories,
        ]);
    }
}
