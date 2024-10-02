<x-layout>
    <x-slot name="title">Créer un emploi</x-slot>
    <h1>Create New job</h1>

    <form action="/jobs" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Titre du Job">
        <input type="text" name="description" placeholder="Description du Job">
        <button type="submit">Soumettre</button>
    </form>
</x-layout>
