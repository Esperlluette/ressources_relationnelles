<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Tests\CleanDatabaseTestCase;


final class DocsControllerTest extends CleanDatabaseTestCase
{

    public function testIndex(): void
    {
        $client = static::createClient();
        $client->followRedirects(true);
        $client->request('GET', uri:"/");
        self::assertResponseIsSuccessful();
    }


    public function testGetDocs(): void {
        $client = static::createClient();
        $client->followRedirects(true);
        $client->request('GET', '/api/docs');
        self::assertResponseIsSuccessful();
    }

    public function testRegister(): void
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/register',
            [],
            [],
            ['CONTENT_TYPE' => 'application/ld+json'],
            json_encode([
                'name' => 'test',
                'roles' => ['ROLE_USER'],
                'email' => 'testAPI@test.com',
                'plainPassword' => 'string'
            ])
        );
        self::assertResponseIsSuccessful(201);
    }
}
