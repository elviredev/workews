@php use Illuminate\Support\Facades\Auth; @endphp
<header
  x-data="{ open: false }"
  class="bg-blue-900 text-white p-4"
>
  <div class="container mx-auto flex justify-between items-center">
    <h1 class="text-3xl font-semibold">
      <a href="{{ url('/') }}">Workews</a>
    </h1>

    <nav class="hidden md:flex items-center space-x-4">
      <x-nav-link url="/" :active="request()->is('/')">Accueil</x-nav-link>
      <x-nav-link url="/jobs" :active="request()->is('jobs')">Jobs</x-nav-link>
      @auth
        <x-nav-link url="/bookmarks" :active="request()->is('bookmarks')">Favoris</x-nav-link>
        <x-logout-button/>
        <div class="flex items-center space-x-2">
          <a href="{{ route('dashboard') }}">
            <x-avatar />
          </a>
          <span class="text-[11px] text-yellow-400 uppercase mt-1 font-extralight">{{ Auth::user()->name }}</span>
        </div>
        <x-button-link url="/jobs/create" icon="edit">Créer Job</x-button-link>
      @else
        <x-nav-link url="/login" :active="request()->is('login')">Connexion</x-nav-link>
        <x-nav-link url="/register" :active="request()->is('register')">Inscription</x-nav-link>
      @endauth
    </nav>
    <button
      @click="open = !open"
      class="text-white md:hidden flex items-center">
      <i class="fa fa-bars text-2xl"></i>
    </button>
  </div>
  <!-- Mobile Menu -->
  <nav
    x-show="open"
    @click.away="open = false"
    class="md:hidden bg-blue-900 text-white mt-5 pb-4 space-y-2"
  >
    <x-nav-link url="/" :active="request()->is('/')" :mobile="true">Accueil</x-nav-link>
    <x-nav-link url="/jobs" :active="request()->is('jobs')" :mobile="true">Jobs</x-nav-link>
    @auth
      <x-nav-link url="/bookmarks" :active="request()->is('bookmarks')" :mobile="true">Favoris</x-nav-link>
      <x-nav-link url="/dashboard" :active="request()->is('dashboard')" icon="gauge" :mobile="true">TdB</x-nav-link>
      <x-logout-button :mobile="true"/>
      <div class="pt-2"></div>
      <x-button-link url="/jobs/create" icon="edit" :block="true">Créer Job</x-button-link>
    @else
      <x-nav-link url="/login" :active="request()->is('login')" :mobile="true">Connexion</x-nav-link>
      <x-nav-link url="/register" :active="request()->is('register')" :mobile="true">Inscription</x-nav-link>
    @endauth
  </nav>
</header>

