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
   
   public function a_user_can_create_a_project (){
       $this->withoutExceptionHandling();
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
       $atributes = factory('App\Project')->raw(['title' => '']);
       $this->post('/projects', $atributes)->assertSessionHasErrors('title');
   }
   
   /** @test */
   public function a_project_requires_a_description (){
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
