<?php

namespace Skaphandrus\AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SpeciesControllerTest extends WebTestCase
{
    public function testShow()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/show');
    }

}
