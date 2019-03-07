@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">控制台</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ Auth::user()->name }} 歡迎您，以下為今日星座說明
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="table-responsive">
            @if ($records->first())
                <h3 class="col text-center my-5">{{ $records[0]->date }}</h3>
                <table class="table table-striped table-rwd">
                    <tr class="tr-only-hide">
                        <th width="80px">星座名稱</th>
                        <th width="200px">整體運勢</th>
                        <th width="200px">愛情運勢</th>
                        <th width="200px">事業運勢</th>
                        <th width="200px">財運運勢</th>
                    </tr>
                    @foreach ($records as $record)
                        <tr>
                            <td data-th="星座名稱">{{ $record->name }}</td>
                            <td data-th="整體運勢">{{ $record->overall_fortune }}</td>
                            <td data-th="愛情運勢">{{ $record->love_fortune }}</td>
                            <td data-th="事業運勢">{{ $record->career_fortune }}</td>
                            <td data-th="財運運勢">{{ $record->wealth_fortune }}</td>
                        </tr>
                    @endforeach
                </table>
            @else
                <h3 class="col text-center my-5">沒有符合的紀錄！</h3>
            @endif
        </div>
    </div>
</div>
@endsection
