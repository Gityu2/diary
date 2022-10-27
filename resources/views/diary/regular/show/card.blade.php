@extends('layouts.app')

@section('title', 'Regular review card')

@section('style')
    <link href="{{ mix('css/card.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container mt-5">
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
                @if ($day !== null)
                    <div class="col-6 col-md-4 col-lg-3">
                        <p class="text-center mb-1 fs-5">{{ $index }} ago</p>
                        <div class="card mb-5">
                            <div class="card-header">
                                <div class="row justify-content-between">
                                    <div class="col-auto">{{ date('n/j(D)', strtotime($day->date)) }}</div>
                                    <div class="col-auto px-0">
                                        @if ($day->fact == null  && $day->discovery == null  && $day->lesson == null  && $day->next_action == null)
                                        <p class="m-0 p-0 me-1 data-size">※No data</p>   
                                        @else
                                        @include('diary.days.contents.menu')       
                                        @endif                                 
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
                                @if ($day !== null)
                                    {{ $day->fact }}
                                @endif
                            </div>
                        </div>
                    </div>                     
                @else
                    <div class="col-6 col-md-4 col-lg-3">
                        <p class="text-center mb-1 fs-5">1 year ago</p>
                        <div class="card mb-5">
                            <div class="card-header">
                                <div class="row justify-content-between">
                                    <div class="col-auto">{{ date('Y/n/j(D)', strtotime('-1 year')) }}</div>
                                    <div class="col-auto px-0">
                                        <p class="m-0 p-0 data-size">※No data</p>       
                                    </div>
                                </div>
                            </div>
                            <div class="card-image">
                                    <img src="{{ asset('images/no_image.png') }}" alt="No image" class="card-image-size">
                            <div class="card-body feature_body"></div>
                            </div>
                        </div>
                    </div>  
                    
                @endif
            @endforeach
        </div>
    </div>
@endsection