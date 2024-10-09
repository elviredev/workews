<x-layout>
  <div class="bg-white rounded-lg shadow-md w-full md:max-w-xl mx-auto mt-12 p-8 py-12">
    <h2 class="text-2xl text-center font-bold mb-4">Connexion</h2>
    <form action="{{ route('login.authenticate') }}" method="POST">
      @csrf
      <x-inputs.text id="email" name="email" type="email" placeholder="Adresse email" />
      <x-inputs.text id="password" name="password" type="password" placeholder="Mot de passe" />

      <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded focus:outline-none">Se Connecter</button>

      <p class="mt-4 text-gray-500">
        Vous n'avez pas encore de compte ?
        <a href="{{ route('register') }}" class="text-blue-700">S'inscrire</a>
      </p>
    </form>
  </div>
</x-layout>
