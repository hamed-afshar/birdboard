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
        $attribiutes = request()->validate([
            'title' => 'required',
            'description' => 'required'
            ]);
        //persist
        Project::create($attribiutes);
        //redirect
        return redirect('/projects');
        
    }
    public function show(Project $project){
        //show
        //$project = Project::findOrfail(request('project'));
        return view('projects.show', compact('project'));
    }

}
