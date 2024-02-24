<?php

namespace App\Controller;

use App\Entity\RSSObject;
use App\Form\RSSObjectType;
use App\Repository\RSSObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/rss')]
class RSSObjectController extends AbstractController
{
    #[Route('/', name: 'app_r_s_s_object_index', methods: ['GET'])]
    public function index(RSSObjectRepository $rSSObjectRepository): Response
    {
        $user = $this->getUser();
        return $this->render('rss_object/index.html.twig', [
            'rss_objects' => $user->getRSSObjectList(),
        ]);
    }

    #[Route('/new', name: 'app_r_s_s_object_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $rSSObject = new RSSObject();
        $rSSObject->setUserId($this->getUser());
        $form = $this->createForm(RSSObjectType::class, $rSSObject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($rSSObject);
            $entityManager->flush();

            return $this->redirectToRoute('app_r_s_s_object_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('rss_object/new.html.twig', [
            'r_s_s_object' => $rSSObject,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_r_s_s_object_show', methods: ['GET'])]
    public function show(RSSObject $rSSObject): Response
    {
        return $this->render('rss_object/show.html.twig', [
            'r_s_s_object' => $rSSObject,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_r_s_s_object_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RSSObject $rSSObject, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RSSObjectType::class, $rSSObject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_r_s_s_object_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('rss_object/edit.html.twig', [
            'r_s_s_object' => $rSSObject,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_r_s_s_object_delete', methods: ['POST'])]
    public function delete(Request $request, RSSObject $rSSObject, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rSSObject->getId(), $request->request->get('_token'))) {
            $entityManager->remove($rSSObject);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_r_s_s_object_index', [], Response::HTTP_SEE_OTHER);
    }
}
