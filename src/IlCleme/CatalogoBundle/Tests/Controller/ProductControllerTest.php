<?php
/**
 * Created by PhpStorm.
 * User: Daniele
 * Date: 03/02/2016
 * Time: 15:05
 */

namespace QwebCMS\CatalogoBundle\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductControllerTest extends WebTestCase
{
    public function testUpdateInfoAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/product/update/info/58?apikey=qwebadm');

        $this->assertGreaterThan(
            0,
            $crawler->filter('input#product_edit_title')->count()
        );
    }

    public function testUpdateFeatureAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/product/update/feature/58?apikey=qwebadm');

        $this->assertGreaterThan(
            0,
            $crawler->filter('select#product_edit_featurevalues_1')->count()
        );
    }

    public function testUpdateImagesAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/product/update/immagini/58?apikey=qwebadm');

        $this->assertGreaterThan(
            0,
            $crawler->filter('table#table-immagini')->count()
        );
    }
}