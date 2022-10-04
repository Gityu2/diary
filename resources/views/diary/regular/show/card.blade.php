@extends('layouts.app')

@section('titel', 'Regular Review Card')

@section('style')
    <link href="{{ mix('css/card.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="px-5 mt-5">
        <div class="row justify-content-between">
            <div class="col-auto">
                <h1 class="h2">Days</h1>
            </div>
            <div class="col-auto">
                <a href="{{ route('diary.day.show.regular.list') }}" class="btn btn-primary my-2 btn-sm">List style</a>
                <a href="{{ route('diary.day.show.regular.card') }}" class="btn btn-primary btn-sm">Card style</a>
            </div>
        </div>
        <div class="row mt-3">
            @foreach ($days as $index => $day)
                <div class="col-6 col-md-4 col-lg-3">
                    <p class="text-center mb-1 fs-5">{{ $index }} ago</p>
                    <div class="card mb-5">
                        <div class="card-header">
                            <div class="row justify-content-between">
                                @if ($index == '1 year')
                                    <div class="col-auto">{{ date('Y/n/j(D)', strtotime($day->date)) }}</div>
                                @else  
                                    <div class="col-auto">{{ date('n/j(D)', strtotime($day->date)) }}</div>
                                                                    
                                    @endif
                                    <div class="col-auto px-0">
                                        @include('diary.days.contents.menu')              
                                    </div>
                            </div>
                        </div>
                        <div class="card-image">
                            @if ($day->image)
                                <img src="{{ asset('storage/images/' . $day->image) }}" alt="Image" class="card-image-size">
                            @else
                                <img src="{{ asset('images/no_image.png') }}" alt="No image" class="card-image-size">
                            @endif
                        </div>
                        <div class="card-body feature_body">
                            {{ $day->fact }}
                        </div>
                    </div>
                </div>  
            @endforeach
        </div>
    </div>
@endsection