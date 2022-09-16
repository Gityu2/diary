@extends('layouts.app')

@section('title', 'Edit Month')


@section('content')
    <div class="container" style="width:50%;" >
    
        <h1 class="text-center">Edit Entry(Year)</h1>
        <form action="{{ route('diary.year.update', $year->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
    
        <label for="date" class="label-form">Year</label>
        <input type="text" name="date" id="date" class="form-control" value="{{ date('Y', strtotime($year->date)) }}" readonly>
    
        <label for="fact" class="label-form mt-4">Fact</label>
        <textarea name="fact" id="fact"  rows="2" class="form-control">{{ old('fact',$year->fact) }}</textarea>
    
    
        <label for="discovery" class="label-form mt-4">Discovery</label>
        <textarea name="discovery" id="discovery"  rows="2" class="form-control">{{ old('discovery',$year->discovery) }}</textarea>
    
    
        <label for="lesson" class="label-form mt-4">Lesson</label>
        <textarea name="lesson" id="lesson"  rows="2" class="form-control">{{ old('lesson',$year->lesson) }}</textarea>
    
    
        <label for="next-action" class="label-form mt-4">Next Action</label>
        <textarea name="next_action" id="next_action"  rows="2" class="form-control">{{ old('next_action',$year->next_action) }}</textarea>
        
        <button type="submit" class="btn btn-warning w-100 mt-5 py-2">Update</button>
        </form>
    </div>
@endsection