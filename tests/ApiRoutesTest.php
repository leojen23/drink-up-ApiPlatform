<?php 
namespace App;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\GardenerPlant;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

class ApiRoutesTest extends ApiTestCase
{
     //This trait provided by AliceBundle will take care of refreshing the database content to a known state before each test
    //  use RefreshDatabaseTrait;

    public function testGetGardenerPlantCollection() {

        // The client implements Symfony HttpClient's `HttpClientInterface`, and the response `ResponseInterface`
        $response = static::createClient()->request('GET', 'http://drink-up-apiplatform.test:8080/api/gardener_plants');
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertResponseStatusCodeSame(200);
        $this->assertCount(3, $response->toArray()['hydra:member']);
    }
    public function testGetGardenerPlantitem() {

        $response = static::createClient()->request('GET', 'http://drink-up-apiplatform.test:8080/api/gardener_plants/61');
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertResponseStatusCodeSame(200);
    }

    public function testGetPlantsCollection() {

        $response = static::createClient()->request('GET', 'http://drink-up-apiplatform.test:8080/api/plants');
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertResponseStatusCodeSame(200);
    }
    public function testGetPlantitem() {

        $response = static::createClient()->request('GET', 'http://drink-up-apiplatform.test:8080/api/plants/1');
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertResponseStatusCodeSame(200);
    }
    public function testLogin(): void
    {
        static::createClient()->request('POST', 'http://drink-up-apiplatform.test:8080/api/login_check', ['json' => [
            'username' => 'test@test.com',
            'password' => 'passwor',
        ]]);
        
        $this->assertResponseIsSuccessful();
    }

  

}
