<?php

namespace App\Tests;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class CleanDatabaseTestCase extends WebTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $client = static::createClient();

        $em = static::getContainer()->get(EntityManagerInterface::class);

        $metadata = $em->getMetadataFactory()->getAllMetadata();
        if (!empty($metadata)) {
            $schemaTool = new SchemaTool($em);
            $schemaTool->dropDatabase();
            $schemaTool->createSchema($metadata);
        }
        self::ensureKernelShutdown();
    }
}
