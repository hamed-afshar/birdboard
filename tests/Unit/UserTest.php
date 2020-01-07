<?php

namespace Tests\Unit;


use Test\TestCase;
use Illuminate\Database\Eloquent\Collection;
class UserTest extends TestCase
{
    use RefreshDatabase;
  /** @test */
    public function a_user_has_project()
    {
        $user = factory('App\User')->create();
        $this->assertInstanceOf(Collection::class, $user->projects);
    }
    
}
