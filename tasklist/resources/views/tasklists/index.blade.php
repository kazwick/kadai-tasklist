@extends('layouts.app')

@section('content')

<h1>タスクリスト一覧</h1>
@if(count($tasklists)>0)
    <table class="table table-striped">
        <thead>
            <tr>
                <th>id</th>
                <th>タスク</th>
                <th>ステータス</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasklists as $tasklist)
                <tr>
                    <td>{!! link_to_route('tasklists.show', $tasklist->id, ['id'=>$tasklist->id])!!}</td>
                    <td>{{ $tasklist->content }}</td>
                    <td>{{ $tasklist->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

{!! link_to_route('tasklists.create', 'タスクを追加', null, ['class' => 'btn btn-primary'])  !!}

{!! Form::close() !!}

@endsection