@extends('templates/master')

@section('body')
    <h1>Game history</h1>
    <div class="col-sm-4 text-center">
        <ul class="list-unstyled">
            @foreach ($history as $round)
                <li><a href="/details?boardId={{ $round['board_id'] }}">
                        {{ 'Round ' . $round['id'] . ' - Winner- ' . $round['winner'] . ' ' . $round['date'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <br>
    <br>

    <a class="position-absolute top-0 end-0" href="/">← Back to Game</a>
@endsection
