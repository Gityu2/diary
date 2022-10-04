@extends('layouts.app')

@section('title', 'Edit day')

@section('style')
    <link href="{{ mix('css/create.css') }}" rel="stylesheet">
@endsection

@section('content')
    @include('diary.days.contents.create')
@endsection