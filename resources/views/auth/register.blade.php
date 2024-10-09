<x-layout>
  <div class="bg-white rounded-lg shadow-md w-full md:max-w-xl mx-auto mt-12 p-8 py-12">
    <h2 class="text-2xl text-center font-bold mb-4">Inscription</h2>
    <form action="{{ route('register.store') }}" method="POST">
      @csrf
      <x-inputs.text id="name" name="name" placeholder="Prénom et Nom" />
      <x-inputs.text id="email" name="email" type="email" placeholder="Adresse email" />
      <x-inputs.text id="password" name="password" type="password" placeholder="Mot de passe" />
      <x-inputs.text id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirmer mot de passe" />

      <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded focus:outline-none">S'inscrire</button>

      <p class="mt-4 text-gray-500">
        Vous avez déja un compte ?
        <a href="{{ route('login') }}" class="text-blue-700">Connexion</a>
      </p>
    </form>
  </div>
</x-layout>
