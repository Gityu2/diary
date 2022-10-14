@extends('layouts.app')

@section('title', 'Edit week')

@section('style')
    <link href="{{ mix('css/create.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container w-50">

        <h1 class="text-center mt-3">Edit Entry(Week)</h1>
        <form action="{{ route('diary.week.update', $week->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <input type="hidden" name="url" value="{{ url()->previous() }}">

        <label for="date" class="label-form small">■Week</label>
        <input type="text" name="date" id="date" class="form-control" value="{{ $week->week }}week ({{ date('n/j',strtotime('last monday', strtotime($week->date))) }}- {{ date('n/j',strtotime('sunday', strtotime($week->date))) }})" readonly>

        <label for="fact" class="label-form mt-4 small">■Fact</label>
        <textarea name="fact" id="fact"  rows="2" class="form-control">{{ old('fact',$week->fact) }}</textarea>


        <label for="discovery" class="label-form mt-4 small">■Discovery</label>
        <textarea name="discovery" id="discovery"  rows="2" class="form-control">{{ old('discovery',$week->discovery) }}</textarea>


        <label for="lesson" class="label-form mt-4 small">■Lesson</label>
        <textarea name="lesson" id="lesson"  rows="2" class="form-control">{{ old('lesson',$week->lesson) }}</textarea>


        <label for="next-action" class="label-form mt-4">■Next Action</label>
        <textarea name="next_action" id="next_action"  rows="2" class="form-control">{{ old('next_action',$week->next_action) }}</textarea>
        
        <button type="submit" class="btn btn-warning w-100 mt-5 py-2">Update</button>
        </form>
    </div>
@endsection