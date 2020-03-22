<?php

namespace App\Tests\Repository;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CategoryRepositoryTest extends KernelTestCase
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
        $categoryRepository = $this->em->getRepository(Category::class);
        $this->assertNotEmpty($categoryRepository);
    }
}
