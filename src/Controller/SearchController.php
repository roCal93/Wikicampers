<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\SearchFormType;
use App\Repository\AvailabilityRepository;

class SearchController extends AbstractController
{
    
    #[Route('/search', name:'search')]
    

public function search(Request $request, AvailabilityRepository $availabilityRepository): Response
{
    $form = $this->createForm(SearchFormType::class);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $data = $form->getData();
        $availabilities = $availabilityRepository->findByCriteria($data['startDate'], $data['endDate'], $data['maxPrice']);

        // Si aucune disponibilité, cherchez avec tolérance
        if (empty($availabilities)) {
            $availabilities = $availabilityRepository->findByDateRangeWithTolerance($data['startDate'], $data['endDate'], $data['maxPrice']);

            if (empty($availabilities)) {
                $this->addFlash('warning', 'Aucun véhicule disponible aux dates spécifiées. Voici les options avec une flexibilité de +/- 1 jour.');
            }
        }

        return $this->render('search/results.html.twig', [
            'availabilities' => $availabilities,
            'search' => $data
        ]);
    }

    return $this->render('search/form.html.twig', [
        'form' => $form->createView(),
    ]);
}

}
