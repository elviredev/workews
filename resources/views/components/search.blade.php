<form
  method="GET"
  action="{{ route('jobs.search') }}"
  class="block mx-5 space-y-2 md:mx-auto lg:space-x-2"
>
  <input
    type="text"
    name="keywords"
    placeholder="Mots Clés"
    class="w-full lg:w-72 px-4 py-3 focus:outline-none"
    value="{{ request('keywords') }}"
  />
  <input
    type="text"
    name="location"
    placeholder="Lieu"
    class="w-full lg:w-72 px-4 py-3 focus:outline-none"
    value="{{ request('location') }}"
  />
  <button
    class="w-full lg:w-auto bg-blue-700 hover:bg-blue-600 text-white px-4 py-3 focus:outline-none"
  >
    <i class="fa fa-search mr-1"></i> Rechercher
  </button>
</form>
