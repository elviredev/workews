<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JobController extends Controller
{
    /**
     * @desc Show all jobs.
     * @route GET /Jobs
     */
    public function index(): View
    {
        $jobs = Job::all();

        return view('jobs.index')->with('jobs', $jobs);
    }

    /**
     * @desc Show the form for creating a new job.
     * @route GET /jobs/create
     */
    public function create(): View
    {
        return view('jobs.create');
    }

    /**
     * @desc Save job to database.
     * @route POST /jobs
     */
    public function store(Request $request): RedirectResponse
    {
      // Récupérer les données depuis les champs du form et les valider
      $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'salary' => 'required|integer',
        'tags' => 'nullable|string',
        'job_type' => 'required|string',
        'remote' => 'required|boolean',
        'requirements' => 'nullable|string',
        'benefits' => 'nullable|string',
        'address' => 'nullable|string',
        'city' => 'required|string',
        'state' => 'required|string',
        'zipcode' => 'nullable|string',
        'contact_email' => 'required|email',
        'contact_phone' => 'nullable|string',
        'company_name' => 'required|string',
        'company_description' => 'nullable|string',
        'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'company_website' => 'nullable|url',
      ]);

      // user ID codé en dur en attendant l'authentification
      $validatedData['user_id'] = 1;

      // Submit to database
      Job::create($validatedData);

      return redirect()->route('jobs.index')->with('success', 'Poste créé avec succès !');
    }

    /**
     * @desc Show a single job.
     * @route GET /jobs/{id}
     */
    public function show(Job $job): View
    {
        return view('jobs.show')->with('job', $job);
    }

    /**
     * @desc Show the form for editing a job.
     * @route GET /jobs/{id}/edit
     */
    public function edit(string $id): string
    {
        return "Edit";
    }

    /**
     * @desc Update a job.
     * @route PUT /jobs/{id}
     */
    public function update(Request $request, string $id): string
    {
        return "Update";
    }

    /**
     * @desc Delete a job.
     * @route DELETE /jobs/{id}
     */
    public function destroy(string $id): string
    {
        return 'Destroy';
    }

}
