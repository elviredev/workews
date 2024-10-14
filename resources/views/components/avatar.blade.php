@props([
  'src' => asset('storage/' . Auth::user()->avatar),
  'alt' => Auth::user()->name,
  'defaultImg' => asset('storage/avatars/default-avatar.png'),
  'withClass' => 'w-10',
  'heightClass' => 'h-10',
])

@if(Auth::user()->avatar)
  <img
    src="{{ $src }}"
    alt="{{ $alt }}"
    class="{{ $withClass }} {{ $heightClass }} rounded-full"
  >
@else
  <img
    src="{{ $defaultImg }}"
    alt="{{ $alt }}"
    class="{{ $withClass }} {{ $heightClass }} rounded-full"
  >
@endif
