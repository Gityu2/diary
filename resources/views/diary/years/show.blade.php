@extends('layouts.app')

@section('title', 'Year list')

@section('style')
    <link href="{{ mix('css/search.css') }}" rel="stylesheet">
    <link href="{{ mix('css/table.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container px-5 mt-2">
    @include('diary.years.contents.search')

    @include('diary.years.contents.current')

    @include('diary.months.contents.all')

    @include('diary.weeks.contents.all')
</div>
@endsection
