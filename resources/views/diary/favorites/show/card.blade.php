@extends('layouts.app')

@section('title', 'Favorite show card')

@section('style')
    <link href="{{ mix('css/card.css') }}" rel="stylesheet">
@endsection
    
@section('content')
<div class="container px-5 mt-3">
    <div class="row justify-content-between mt-5">
        <div class="col-auto">
            <h1 class="h2">Days</h1>
        </div>
        <div class="col-auto">
            <a href="{{ route('diary.like.show.list') }}" class="btn btn-primary my-2 btn-sm">List style</a>
            <a href="{{ route('diary.like.show.card') }}" class="btn btn-primary btn-sm">Card style</a>
        </div>
    </div>
    @include('diary.days.contents.card')
</div>
@endsection

