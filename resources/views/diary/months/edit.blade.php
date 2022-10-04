@extends('layouts.app')

@section('title', 'Edit Month')

@section('style')
    <link href="{{ mix('css/create.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container w-50">
        <h1 class="text-center mt-3">Edit Entry(Month)</h1>
        <form action="{{ route('diary.month.update', $month->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <input type="hidden" name="url" value="{{ url()->previous() }}">

    
        <label for="date" class="label-form small">■Month</label>
        <input type="text" name="date" id="date" class="form-control" value="{{ date('M', strtotime($month->date)) }}" readonly>
    
        <label for="fact" class="label-form mt-4 small">■Fact</label>
        <textarea name="fact" id="fact"  rows="2" class="form-control">{{ old('fact',$month->fact) }}</textarea>
    
    
        <label for="discovery" class="label-form mt-4 small">■Discovery</label>
        <textarea name="discovery" id="discovery"  rows="2" class="form-control">{{ old('discovery',$month->discovery) }}</textarea>
    
    
        <label for="lesson" class="label-form mt-4 small">■Lesson</label>
        <textarea name="lesson" id="lesson"  rows="2" class="form-control">{{ old('lesson',$month->lesson) }}</textarea>
    
    
        <label for="next-action" class="label-form mt-4 small">■Next Action</label>
        <textarea name="next_action" id="next_action"  rows="2" class="form-control">{{ old('next_action',$month->next_action) }}</textarea>
        
        <button type="submit" class="btn btn-warning w-100 mt-5 py-2">Update</button>
        </form>
    </div>
@endsection