@extends('layouts.app')

@section('content')

<div class="px-5 mt-2"   style="">
    @include('diary.years.contents.search')

    @include('diary.years.contents.current')

    @include('diary.months.contents.all')

    @include('diary.weeks.contents.all')
</div>
@endsection
