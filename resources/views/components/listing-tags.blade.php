@props(['tagsCvs'])
@php
        $tags = explode(',', $tagsCvs); // separate string in $tagsCsv by tags and assign each to a the new array.

@endphp

<ul class="flex">
    @foreach($tags as $tag)
        <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
            <a href="/?tag={{$tag}}">{{$tag}}</a>
        </li>
    @endforeach
</ul>