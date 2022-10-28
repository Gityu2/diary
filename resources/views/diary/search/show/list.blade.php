@extends('layouts.app')

@section('title', ' - Search')

@section('style')
    <link href="{{ mix('css/table.css') }}" rel="stylesheet">
@endsection
    
@section('content')
    <div class="container mt-3">
        <h2 class="fs-4 fw-light mb-3">Search for <u>{{ $keyword }}</u></h2>
        @if ($keyword)
            @if ($years->isNotEmpty())
                @include('diary.years.contents.all')
            @endif

            @if ($year_months->isNotEmpty())
                @include('diary.months.contents.all')
            @endif

            @if ($year_weeks->isNotEmpty())
                @include('diary.weeks.contents.all')
            @endif

            @if ($month_days->isNotEmpty())
            <div class="row justify-content-between mt-5">
                <div class="col-auto">
                    <h1 class="h2">Days</h1>
                </div>
                <div class="col-auto">
                    <div class="mb-1" style="display:inline-flex">
                        <form action="{{ route('diary.search.show.list') }}" method="get" class="d-block me-1">
                            <button type="submit" name="keyword" value="{{ $keyword }}"  class="btn btn-primary form-control btn-sm">List style</button>        
                        </form>
                        
                        <form action="{{ route('diary.search.show.card') }}" method="get" class="">
                            <button type="submit" name="keyword" value="{{ $keyword }}"  class="btn btn-primary form-control btn-sm">Card style</button>        
                        </form>
                    </div>
                </div>
            </div>

                @include('diary.days.contents.list')
            @endif

            @if ($years->isEmpty() && $year_months->isEmpty() && $year_weeks->isEmpty() && $month_days->isEmpty())
                <div class="text-center mt-5">
                    <h1 class="h2">We're sorry, your search did not return any results.</h1>
                    <p class="fs-4">Please serch again with different wording.</p>
                </div>
                
            @endif

        @endif
    </div>

@endsection





