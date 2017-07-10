@extends('layouts.app')

@section('content')

    <h1>タスクリスト新規作成ページ</h1>

    {!! Form::model($tasklist, ['route' => 'tasklists.store']) !!}

        {!! Form::label('content', 'タスク:') !!}
        {!! Form::text('content') !!}

        {!! Form::submit('送信') !!}

    {!! Form::close() !!}

@endsection