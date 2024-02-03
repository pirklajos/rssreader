<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class RSSReaderController extends AbstractController
{
    #[Route('', name: 'app_r_s_s_reader')]
    #[Route('rss_reader', name: 'app_r_s_s_reader')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        $user = $this->getUser();

        if($request->request->get('refresh_rate')){
            $user->setRefreshrate($request->request->get('refresh_rate'));
            $entityManager->persist($user);
            $entityManager->flush();
        }

        $rssObjectList = $user->getRSSObjectList();

        $rssList = [];
        foreach ( $rssObjectList as $rss){
            if($rss->isActive()){
                $rssList[] = simplexml_load_file($rss->getUrl());
                //dd(simplexml_load_file($rss->getUrl()));
            }
        }

        return $this->render('rss_reader/index.html.twig', [
            'rssList' => $rssList,
            'refreshRate' => $user->getRefreshrate(),
        ]);
    }
}
