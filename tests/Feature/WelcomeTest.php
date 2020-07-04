<?php

namespace Tests\Feature;

use Tests\TestCase;

class WelcomeTest extends TestCase
{
    /** @test */
    public function it_can_load_the_page()
    {
        $this->get(route('welcome'))
            ->assertOk()
            ->assertSee('r::welcome');
    }
}
