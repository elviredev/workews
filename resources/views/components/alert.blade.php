@props(['type', 'message', 'timeout' => '3000'])

@if(session()->has($type))
  <div
    x-data="{ show: true }"
    x-init="setTimeout(() => show = false, {{ $timeout}})"
    x-show="show"
    class="p-4 text-sm text-white rounded mb-4 {{ $type == 'success' ? 'bg-green-500' : 'bg-red-500' }}"
  >
    {{ $message }}
  </div>
@endif
