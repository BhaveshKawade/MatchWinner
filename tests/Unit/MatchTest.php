<?php
namespace Tests\Unit;

use Tests\TestCase;
// use Illuminate\Console\Command;

class MatchTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_with_invalid_number_drain()
    {
        $this->artisan('play:game')
        ->expectsQuestion('Enter A team players:', '18,20,50,40')
        ->expectsQuestion('Enter B team players:', '35, 10, 30, 20, 90')
        ->expectsOutput("Match can not play 5 players allowed each team")
        ->assertExitCode(0);
    }

    public function test_with_valid_drain_win()
    {
        $this->artisan('play:game')
        ->expectsQuestion('Enter A team players:', '35,100,20,50,40')
        ->expectsQuestion('Enter B team players:', '35, 10, 30, 20, 90')
        ->expectsOutput("Win")
        ->assertExitCode(0);
    }

    public function test_with_valid_drain_lose()
    {
        $this->artisan('play:game')
        ->expectsQuestion('Enter A team players:', '35,18,20,10,40')
        ->expectsQuestion('Enter B team players:', '35, 10, 30, 20, 90')
        ->expectsOutput("Lose")
        ->assertExitCode(0);
    }
}
