<?php

namespace App\Tests\Repository;

use App\Entity\Pet;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PetRepositoryTest extends KernelTestCase
{
    /** @var \Doctrine\ORM\EntityManager */
    private $em;

    public function setUp()
    {
        self::bootKernel();
        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager()
        ;
    }

    public function testConstruct()
    {
        $categoryRepository = $this->em->getRepository(Pet::class);
        $this->assertNotEmpty($categoryRepository);
    }
}
