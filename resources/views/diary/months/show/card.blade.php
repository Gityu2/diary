@extends('layouts.app')

@section('content')
    <div class="px-5 mt-2">
        @include('diary.months.contents.search')

        @include('diary.months.contents.current')

        @include('diary.weeks.contents.current')

        <div class="row justify-content-between mt-5">
            <div class="col-auto">
                <h1 class="h2">Days</h1>
            </div>
            <div class="col-auto">
                <a href="{{ route('diary.month.show.list') }}" class="btn btn-primary my-2 btn-sm">List style</a>
                <a href="{{ route('diary.month.show.card') }}" class="btn btn-primary btn-sm">Card style</a>
            </div>
        </div>
        @include('diary.days.contents.card')
    </div>
@endsection