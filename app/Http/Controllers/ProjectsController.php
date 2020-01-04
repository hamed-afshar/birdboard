<?php

namespace App\Http\Controllers;

use App\Project;

use Illuminate\Http\Request;

class ProjectsController extends Controller {

    public function index() {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    public function store() {
        //validate
        $attribiutes = request()->validate(['title' => 'required', 'description' => 'required']);
        //persist
        Project::create($attribiutes);
        //redirect
        return redirect('/projects');
        
    }
    public function show(){
        //show
        $project = Project::find(request('project'));
        return view('projects.show', compact('projects'));
    }

}
