<x-layout>
  <h2 class="text-3xl text-center mb4 font-bold border border-gray-300 p-3 mb-4">Bienvenue sur le site Workews</h2>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
    @forelse($jobs as $job)
      <x-job-card :job="$job" />
    @empty
      <p>Pas d'emplois disponibles</p>
    @endforelse
  </div>

  <a href="{{ route('jobs.index') }}" class="block text-xl text-center">
    <i class="fa fa-arrow-alt-circle-right"></i> Voir tous les emplois
  </a>

  <x-bottom-banner />
</x-layout>
