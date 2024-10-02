<?php

namespace App\Http\Controllers;

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
        $jobs = [
            'Software Engineer',
            'Web Developer',
            'Data Scientist',
            'Systems Analyst'
        ];

        return view('jobs.index', compact('jobs'));
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
     * @desc Store a new job.
     * @route POST /jobs
     */
    public function store(Request $request): string
    {
        return "Store";
    }

    /**
     * @desc Show a single job.
     * @route GET /jobs/{id}
     */
    public function show(string $id): View
    {
        return view('jobs.show', compact('id'));
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
