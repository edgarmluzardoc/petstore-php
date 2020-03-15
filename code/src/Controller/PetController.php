<?php

namespace App\Controller;

use App\Entity\Pet;
use App\Helpers\PetHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PetController extends AbstractController
{
    /**
     * @Route("/pets", name="pet_all", methods={"GET"})
     */
    public function all()
    {
        $pets = $this->getDoctrine()->getRepository(Pet::class)
            ->findAll();

        $results = [];
        foreach ($pets as $pet) {
            $results[] = PetHelper::getModel($pet);;
        }

        return $this->json($results);
    }

    /**
     * @Route("/pet/{id}", name="pet_one", methods={"GET"})
     */
    public function one(string $id)
    {
        $pet = $this->getDoctrine()->getRepository(Pet::class)
            ->find($id);

        if (!$pet) {
            return $this->json(
                'Pet not found',
                Response::HTTP_NOT_FOUND
            );
        }

        $result = PetHelper::getModel($pet);

        return $this->json($result);
    }
}
