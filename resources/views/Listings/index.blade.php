<x-layout>
@include('partials._hero')
@include ('partials._search')

<div
class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4"
>

    {{-- @if(count($listings) == 0)
        <p>No listings found</p>
    @endif

    @foreach ($listings as $item)
        <h2>{{$item['title']}}</h2>
        <p>{{$item['description']}}</p>
    @endforeach --}}

    @unless(count($listings)==0)
        @foreach ($listings as $item)
            <x-listing-card :item="$item"/>
        @endforeach

        @else
        <p>No listings found</p>
    @endunless


</div>
<div class="mt-6 p-4">
    {{$listings->links()}}
  </div>
</x-layout>