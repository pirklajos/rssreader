<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RSSReaderController extends AbstractController
{
    #[Route('rss_reader', name: 'app_r_s_s_reader')]
    public function index(): Response
    {
        $user = $this->getUser();
        $rssObjectList = $user->getRSSObjectList();

        $rssList = [];
        foreach ( $rssObjectList as $rss){
            if($rss->isActive()){
                $rssList[] = simplexml_load_file($rss->getUrl());
            }
        }

        //dd( $rssList );

        return $this->render('rss_reader/index.html.twig', [
            'rssList' => $rssList,
        ]);
    }
}
