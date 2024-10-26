<div class="container p-4">
    <div class="row">
    <h1>Search Results for "{{ $query }}"</h1>

    @if($events->isEmpty())
        <p>No events found.</p>
    @else
        <ul>
            @foreach($events as $event)
                <li>
                    <a href="{{ route('event.show', $event->id) }}">{{ $event->name }}</a>
                    <p>{{ $event->description }}</p>
                </li>
            @endforeach
        </ul>
    @endif
    </div>
</div>