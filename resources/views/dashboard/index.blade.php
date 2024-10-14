<x-layout>
  <section class="flex flex-col md:flex-row gap-4">
    {{-- Form Infos Profil --}}
    <div class="bg-white p-8 rounded-lg shadow-md w-full">
      <h3 class="text-3xl text-center font-bold mb-4">Info Profil</h3>
      <div class="mt-2 flex justify-center">
        <x-avatar withClass="w-32" heightClass="h-32" />
      </div>

      <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-inputs.text id="name" name="name" label="Nom" value="{{ $user->name }}" />
        <x-inputs.text id="email" name="email" label="Email" type="email" value="{{ $user->email }}" />
        <x-inputs.file id="avatar" name="avatar" label="Télécharger Avatar" />

        <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 border rounded focus:outline-none">Enregistrer</button>
      </form>
    </div>

    {{-- Offres d'emploi --}}
    <div class="bg-white p-8 rounded-lg shadow-md w-full">
    <h3 class="text-3xl text-center font-bold mb-4">Mes Offres d'Emploi</h3>
    @forelse($jobs as $job)
    <div class="flex justify-between items-center border-b-2 border-gray-200 py-2">
      <div>
        <h3 class="text-blue-800 text-lg md:text-xl font-semibold">{{ $job->title }}</h3>
        <p class="text-gray-700">{{ $job->job_type }}</p>
      </div>
      <div class="flex space-x-3">
        <a href="{{ route('jobs.edit', $job->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded text-sm">Modifier</a>
        <!-- Delete Form -->
        <form
          method="POST"
          action="{{ route('jobs.destroy', $job->id) }}?from=dashboard"
          onsubmit="return confirm('Etes-vous sûr de vouloir supprimer ce poste ?')"
        >
          @csrf
          @method('DELETE')
          <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded text-sm">
            Supprimer
          </button>
        </form>
        <!-- End Delete Form -->
      </div>
    </div>
    {{-- Candidats --}}
    <div class="mt-4 bg-gray-100 p-2">
      <h4 class="text-lg font-semibold mb-2">Candidats</h4>
      @forelse($job->candidats as $candidat)
        <div class="py-2">
          <p class="text-gray-800">
            <strong>Nom:</strong> {{ $candidat->full_name }}
          </p>
          <p class="text-gray-800">
            <strong>Tél.:</strong> {{ $candidat->contact_phone }}
          </p>
          <p class="text-gray-800">
            <strong>Email:</strong> {{ $candidat->contact_email }}
          </p>
          <p class="text-gray-800">
            <strong>Message:</strong> {{ $candidat->message }}
          </p>
          <p class="test-gray-800 mt-2">
            <a
              href="{{ asset('storage/' . $candidat->resume_path) }}"
              class="text-blue-500 text-sm hover:underline"
              download
            >
              <i class="fas fa-download"></i> Télécharger CV
            </a>
          </p>
          {{-- Supprimer Candidat --}}
          <form
            method="POST"
            action="{{ route('candidat.destroy', $candidat->id) }}"
            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce candidat ?')"
          >
          @csrf
          @method('DELETE')
            <button type="submit" class="text-red-500 hover:text-red-700 text-sm">
              <i class="fas fa-trash"></i> Supprimer le candidat
            </button>
          </form>
        </div>
      @empty
        <p class="text-gray-700 mb-5">Pas de candidat(s) pour ce poste.</p>
      @endforelse
    </div>
    @empty
    <p class="text-gray-700">Vous n'avez aucune offre d'emploi.</p>
    @endforelse
  </div>
  </section>
  <x-bottom-banner />
</x-layout>
