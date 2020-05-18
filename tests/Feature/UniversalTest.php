<?php

namespace Tests\Feature;

use App\Dummy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UniversalTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_correct_phpunit_db_configured()
    {
        $dummy = factory(Dummy::class)->create()->toArray();
        $this->assertDatabaseHas('dummies', $dummy);
    }

    /** @test */
    public function it_is_in_a_prelaunch_state_or_the_launch_checklist_is_complete()
    {
        $response = $this->get(route('panic-if-launched'));
        $response->assertSuccessful();
    }
}
