@extends('layouts.app')

@section('title', 'Regular review list')

@section('style')
    <link href="{{ mix('css/table.css') }}" rel="stylesheet">
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
        <div class="table-responsive">
        <table class="table table-sm align-middle">
            <thead>
                <tr class="table-primary" style="border-bottom: hidden;">
                    <th class="table-width-day">Day</th>
                    <th class="table-width">Fact</th>
                    <th class="table-width">Discovery</th>
                    <th class="table-width">Lesson</th>
                    <th class="table-width">Next Action</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($days as $index => $day)  
                <tr>
                    @if ($index !== '1 year' && $day !== null)
                        <td>{{ $index }} ago<br><span class="small" style="font-size: 0.7rem;">- {{ date('n/j (D)', strtotime($day->date)) }} -</span></td>
                        <td>{{ $day->fact }}</td>
                        <td>{{ $day->discovery }}</td>
                        <td>{{ $day->lesson }}</td>
                        <td>{{ $day->next_action }}</td>
                        @if ($day->fact == null  && $day->discovery == null  && $day->lesson == null  && $day->next_action == null)
                            <td class="table-wrap data-size">※No data</td>        
                        @else
                        <td class="text-center">
                            @include('diary.days.contents.menu')
                            @include('diary.days.modal.status')
                        </td>
                        @endif
                    @else
                        <td> 1 year ago<br><span class="small" style="font-size: 0.7rem;">- {{ date('Y/n/j (D)', strtotime('-1 year')) }} -</span></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="data-size">※No data</td>
                    @endif
                </tr>    
                @endforeach     
            </tbody>
        </table>
    </div>   
    </div>
@endsection