@props(['mobile' => false])

<form method="POST" action="{{ route('logout') }}">
  @csrf
  @if($mobile)
  <button type="submit" class="text-white px-4">
    <i class="fa fa-sign-out mr-1"></i>
    Déconnexion
  </button>
  @else
    <button type="submit" class="text-white">
      <i class="fa fa-sign-out"></i>
      Déconnexion
    </button>
  @endif
</form>
