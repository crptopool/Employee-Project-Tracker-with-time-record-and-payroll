<?php

namespace EdgeWeb\Project\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testAlluser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/allUser');
    }

}
