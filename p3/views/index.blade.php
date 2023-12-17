@extends('templates/master')



@section('content')
    {{--
    <div>
        @include('message', [])
    </div>
--}}
    <div class="container">
        <div class="row">
            {{-- message --}}
            @if ($error)
                <div class='alert alert-info'>{{ $error }}</div>
            @endif

            <div class="col-md-6">

                {{-- Display game board --}}
                @if (!$newGame)
                    <form method="POST" action="/move">
                        <table>
                            @for ($i = 1; $i < 4; $i++)
                                <tr>
                                    @for ($j = 1; $j < 4; $j++)
                                        <td>
                                            <button type="submit" name="cell" value="{{ $i . '_' . $j }}"
                                                {{ $newGame ? 'disabled' : '' }}>
                                                {{ $board['cell' . $i . '_' . $j] }}
                                            </button>
                                        </td>
                                    @endfor
                                </tr>
                            @endfor
                        </table>
                    </form>
                    <br>
                    <br>
                @endif

                <form method="POST" action="/game">
                    <button class="clean" type="submit" name="game" value=1>Start New Game</button>
                </form>
            </div>

            <div class="col-md-6">
                <h2>Game Rules</h2>
                <p class="border border-secondary">The game is played on a 3x3 grid
                    Players take turns marking an X or an O on the board.
                    The first player to get three of their marks in a row, horizontally, vertically, or diagonally, wins.
                    If both players use an optimal strategy, the game will always end in a draw. <br>
                    The game is over when all 9 squares are full.
                    If there is no winner, it is a draw. <br>
                    Play the best of three alternating who takes the first turn.
                </p>
            </div>
        </div>


        <a class="position-absolute top-0 end-0" href='/history'>Game History</a>
    @endsection
