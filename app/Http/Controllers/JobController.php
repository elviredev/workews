<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JobController extends Controller
{
  use AuthorizesRequests;

  /**
   * @desc Show all jobs.
   * @route GET /Jobs
   */
  public function index(): View
  {
    $jobs = Job::latest()->paginate(9);
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

    // Add the user ID of the current user
    $validatedData['user_id'] = auth()->user()->id;

    // Vérifier s'il existe un fichier téléchargé
    if ($request->hasFile('company_logo')) {
      // Stocker le fichier et obtenir le path pour le sauvegarder en bdd (storage/app/public/logos)
      $path = $request->file('company_logo')->store('logos', 'public');
      // Ajouter le path aux données validées
      $validatedData['company_logo'] = $path;
    }

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
  public function edit(Job $job): View
  {
    // Vérifiez si l'utilisateur est autorisé
    $this->authorize('update', $job);

    return view('jobs.edit')->with('job', $job);
  }

  /**
   * @desc Update a job.
   * @route PUT /jobs/{id}
   */
  public function update(Request $request, Job $job): RedirectResponse
  {
    // Vérifiez si l'utilisateur est autorisé
    $this->authorize('update', $job);

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

    // Vérifier s'il existe un fichier téléchargé
    if ($request->hasFile('company_logo')) {
      if ($job->company_logo) {
        // Delete the old company logo from storage
        Storage::disk('public')->delete($job->company_logo);
      }
      // Stocker le fichier et obtenir le path pour le sauvegarder en bdd (storage/app/public/logos)
      $path = $request->file('company_logo')->store('logos', 'public');
      // Ajouter le path aux données validées
      $validatedData['company_logo'] = $path;
    }

    // Update with the validated data
    $job->update($validatedData);

    return redirect()->route('jobs.index')->with('success', 'Poste modifié avec succès !');
  }

  /**
   * @desc Delete a job.
   * @route DELETE /jobs/{id}
   */
  public function destroy(Job $job): RedirectResponse
  {
    // Vérifiez si l'utilisateur est autorisé
    $this->authorize('delete', $job);

    // Si une image existe, la supprimer
    if ($job->company_logo) {
      Storage::disk('public')->delete($job->company_logo);
    }
    // Supprimer le poste
    $job->delete();

    // Vérifiez si la requête provient de la page dashboard
    if (request()->query('from') == 'dashboard') {
      return redirect()->route('dashboard')->with('success', 'Poste supprimé avec succès !');
    }

    return redirect()->route('jobs.index')->with('success', 'Poste supprimé avec succès !');
  }

  /**
   * @desc Search job listings
   * @route GET /jobs/search
   * @param Request $request
   * @return View
   */
  public function search(Request $request): View
  {
    // Obtenir les données du formulaire
    $keywords = strtolower($request->input('keywords'));
    $location = strtolower($request->input('location'));

    // Générateur de requêtes
    $query = Job::query();

    // Vérifier qu'on recherche réellement des mots-clés
    if ($keywords) {
      $query->where(function ($q) use ($keywords) {
        // Faire correspondre $keywords à n'importe quoi dans le titre
        $q->whereRaw('LOWER(title) like ?', ['%' . $keywords . '%'])
          ->orWhereRaw('LOWER(description) like ?', ['%' . $keywords . '%'])
          ->orWhereRaw('LOWER(tags) like ?', ['%' . $keywords . '%']);
      });
    }
    // Vérifier qu'on recherche réellement un emplacement
    if ($location) {
      $query->where(function ($q) use ($location) {
        // Faire correspondre $keywords à n'importe quoi dans le titre
        $q->whereRaw('LOWER(address) like ?', ['%' . $location . '%'])
          ->orWhereRaw('LOWER(city) like ?', ['%' . $location . '%'])
          ->orWhereRaw('LOWER(state) like ?', ['%' . $location . '%'])
          ->orWhereRaw('LOWER(zipcode) like ?', ['%' . $location . '%']);
      });
    }

    $jobs = $query->paginate(12);

    return view('jobs.index')->with('jobs', $jobs);
  }

}
