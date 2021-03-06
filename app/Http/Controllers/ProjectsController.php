<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller {

    public function index() {
        //index
        //$projects = Project::all();
        $projects = auth()->user()->projects;
        
        return view('projects.index', compact('projects'));
    }

    public function store() {
        //validate
        $attribiutes = request()->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        //$attribiutes['owner_id'] = auth()->id();
      
        
        auth()->user()->projects()->create($attribiutes);
        //persist
        //Project::create($attribiutes);
        //redirect
        return redirect('/projects');
    }

    public function show(Project $project) {
        //show
        //$project = Project::findOrfail(request('project'));
        if(auth()->id() !== $project->owner_id) {
            abort(403);
        }
        return view('projects.show', compact('project'));
    }

}
