<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TemporarayTest extends TestCase
{

    /** @test */
    public function it_should_not_panic()
    {
        $response = $this->get(route('panic-if-launched'));
        $response->assertSuccessful();
    }
}
