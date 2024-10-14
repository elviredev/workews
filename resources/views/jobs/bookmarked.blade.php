<x-layout>
  <h2 class="text-3xl text-center font-bold mb-4 border border-gray-300 p-3">Vos emplois en favoris</h2>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-3">
    @forelse($bookmarks as $bookmark)
      <x-job-card :job="$bookmark" />
    @empty
      <p class="text-gray-500 text-center">Vous n'avez pas d'emplois en favoris.</p>
    @endforelse
  </div>
</x-layout>
