<?php

namespace App\Tests\Repository;

use App\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TagRepositoryTest extends KernelTestCase
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
        $categoryRepository = $this->em->getRepository(Tag::class);
        $this->assertNotEmpty($categoryRepository);
    }
}
