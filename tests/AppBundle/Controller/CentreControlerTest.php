<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CentreControlerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/centre');

        $this->assertEquals(301, $client->getResponse()->getStatusCode());
        //$this->assertContains('Centre list', $crawler->filter('h1')->text());
    }
}
