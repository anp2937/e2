@extends('templates/master')



@section('content')
    {{--
    <div>
        @include('message', [])
    </div>
--}}

    <h2>Game Rules</h2>

    {{-- debug --}}
    @php
        dump($board);
        $player = 'X';
        $win = '0';
        dump($cell);
        if ($cell) {
            $board[$cell[0]][$cell[2]] = $player;
        }

    @endphp

    {{-- end debug --}}

    {{-- Display game board --}}
    <form method="POST" action="/move">
        <table>
            @for ($i = 0; $i < 3; $i++)
                <tr>
                    @for ($j = 0; $j < 3; $j++)
                        <td>
                            <button type="submit" name="cell" value="{{ $i . '.' . $j }}" {{ $win ? 'disabled' : '' }}>
                                {{ $board[$i][$j] }}
                            </button>
                        </td>
                    @endfor
                </tr>
            @endfor
        </table>

        {{-- Hidden input fields --}}
        <input type="hidden" name="board" value='{{ json_encode($board) }}'>
        <input type="hidden" name="player" value='{{ $player }}'>

        <br>
        <br>

        {{-- Restart button --}}
        @if ($win)
            <button type="submit" class="clean" name="clean" value="clean">Restart</button>
        @endif
    </form>


    <a href='/history'>Game History</a>
@endsection
