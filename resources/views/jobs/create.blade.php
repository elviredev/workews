<x-layout>
    <x-slot name="title">Créer un emploi</x-slot>
    <h1>Créer un Job</h1>

    <form action="/jobs" method="POST">
      @csrf
      <div class="my-5">
        <input type="text" name="title" placeholder="Titre du Job" value="{{ old('title') }}">
        @error('title')
        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-5">
        <input type="text" name="description" placeholder="Description du Job" value="{{ old('description') }}">
        @error('description')
        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
        @enderror
      </div>

      <button type="submit">Valider</button>
    </form>
</x-layout>
