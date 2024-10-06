<x-layout>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
    @forelse($jobs as $job)
      <x-job-card :job="$job" />
    @empty
      <p>Pas d'emplois disponibles</p>
    @endforelse
  </div>
</x-layout>
