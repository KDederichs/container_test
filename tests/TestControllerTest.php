<?php


namespace App\Tests;


use App\Services\SomeTestService;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestControllerTest extends WebTestCase
{
    use MockeryPHPUnitIntegration;

    public function testShouldKeepMockService()
    {
        $client = self::createClient();
        $mockService = \Mockery::mock(SomeTestService::class);
        $mockService->shouldReceive('sayTest')->once()->withNoArgs();
        $client->getContainer()->set(SomeTestService::class, $mockService);
        echo get_class($mockService);
        self::assertEquals(get_class($mockService),  get_class($client->getContainer()->get(SomeTestService::class)));
        $client->request('GET', '/test');
        self::assertTrue($client->getResponse()->isSuccessful());
        self::assertEquals(get_class($mockService),  get_class($client->getContainer()->get(SomeTestService::class)));
        $crawler = $client->getCrawler();
        $formButton = $crawler->selectButton('some_test_submit');
        $form = $formButton->form();
        self::assertEquals(get_class($mockService),  get_class($client->getContainer()->get(SomeTestService::class)));
        $client->submit($form,[
            'some_test[testVal]' => 'test'
        ]);
        echo $client->getResponse()->getContent();
        self::assertEquals(get_class($mockService),  get_class($client->getContainer()->get(SomeTestService::class)), 'Mock service gone after post');
    }
}
