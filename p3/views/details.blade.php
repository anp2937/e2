@extends('templates/master')

@section('title')
    {{ $welcome }}
@endsection

@section('body')
    <h1>Round {{ $roundNumber }}</h1>

    <div>
        <table>
            @for ($i = 1; $i < 4; $i++)
                <tr>
                    @for ($j = 1; $j < 4; $j++)
                        <td>
                            <button type="submit" name="cell" value="{{ $i . '_' . $j }}" disabled>
                                {{ $board['cell' . $i . '_' . $j] }}
                            </button>
                        </td>
                    @endfor
                </tr>
            @endfor
        </table>
    </div>

    <h3>Winner - {{ $winner }}</h3>

    <a class="position-absolute top-0 end-0" href='/history'>&larr; Back to Game History</a>
@endsection
