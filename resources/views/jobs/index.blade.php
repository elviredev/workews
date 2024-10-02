<x-layout>
    <h1>Emplois disponibles</h1>
    <ul>
        @forelse($jobs as $job)
            <li>{{ $job }}</li>
        @empty
            <li>Pas d'emplois disponibles</li>
        @endforelse
    </ul>
</x-layout>
