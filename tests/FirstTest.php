<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\ApiResource\Form\CreateForm;

class FirstTest extends ApiTestCase {
    public function testSomething(): void {

        $response = static::createClient()->request('GET', '/api/create_forms/entity');

        $this->assertResponseIsSuccessful();
        // Asserts that the returned content type is JSON-LD (the default)
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        // Asserts that the returned JSON is a superset of this one
        // $this->assertJsonContains([
        //     '@context' => '/contexts/create_forms',
        //     '@id' => '/api/create_forms/entity',
        //     '@type' => 'hydra:Collection',
        //     'hydra:totalItems' => 1
        // ]);

        // Because test fixtures are automatically loaded between each test, you can assert on them
        $this->assertCount(1, $response->toArray()['hydra:member']);

        // Asserts that the returned JSON is validated by the JSON Schema generated for this resource by API Platform
        // This generated JSON Schema is also used in the OpenAPI spec!
        $this->assertMatchesResourceCollectionJsonSchema(CreateForm::class);

        // dd($response->toArray());
    }
}
