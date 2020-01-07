<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTests extends TestCase
{
    /** @test */
   use WithFaker;
   use RefreshDatabase;
   
   /** @test */
   public function only_authenticated_users_can_create_projects() {
       //$this->withoutExceptionHandling();
       $attributes = factory('App\Project')->raw();
       $this->post('/projects', $attributes)->assertRedirect('login');
   }
   
   /** @test */
   public function a_user_can_create_a_project (){
       $this->withoutExceptionHandling();
       $this->actingAs(factory('App\User')->create());
       $attributes = [
           'title' => $this->faker->sentence,
           'description' => $this->faker->paragraph
       ];
       $this->post('/projects', $attributes)->assertRedirect('projects');
       //$this->assertDatabaseHas('projects', $attributes);
       //$this->get('/projects')->assertSee($attributes['title']);
   }
   /** @test */
   public function a_project_requires_a_title () {
       $this->actingAs(factory('App\User')->create());
       $atributes = factory('App\Project')->raw(['title' => '']);
       $this->post('/projects', $atributes)->assertSessionHasErrors('title');
   }
   
   /** @test */
   public function a_project_requires_a_description (){
       $this->actingAs(factory('App\User')->create());
       $atributes = factory('App\Project')->raw(['description' => '']);
       $this->post('/projects', [])->assertSessionHasErrors('description');
   }
   
   /** @test */
   public function a_user_can_view_a_project() {
       $this->withExceptionHandling();
       $project = factory('App\Project')->create();
       $this->get($project->path())
               ->assertSee($project->title)->assertSee($project->description);
    
   }
   
   
}
