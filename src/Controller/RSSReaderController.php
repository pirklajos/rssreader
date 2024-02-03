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

        //Refresh Parameter from get header request
        //$request  = $this->container->get('request_stack')->getCurrentRequest();
        //dd( $request->query->get('rr') );

        $user = $this->getUser();
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
        ]);
    }
}
