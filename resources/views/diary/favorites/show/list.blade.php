@extends('layouts.app')

@section('title', 'Favorite show list')

@section('style')
    <link href="{{ mix('css/table.css') }}" rel="stylesheet">
@endsection

@section('content')
    @if ($month_days->isNotEmpty())
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
            @include('diary.days.contents.list')
        </div>
    @else
        <div class="text-center mt-5">
            <h1 class="h2">We're sorry, your diary doesn't have any favorites.</h1>
            <p class="fs-4">Please add your favorite.</p>
        </div>
    @endif

@endsection

