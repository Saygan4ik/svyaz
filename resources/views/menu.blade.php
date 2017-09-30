<ul>
    <a href="/"><li>Main</li></a>
    @foreach($groups as $group)

        <a href="/group/{{ $group->id }}/orderBy"><li>{{ $group->nameRU }}</li></a>

    @endforeach
</ul>