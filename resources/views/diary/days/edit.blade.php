@extends('layouts.app')

@section('title', 'Edit day')

@section('content')
    <div class="container w-50" style="height:93vh" >
        <h1 class="text-center">Edit Entry(Day)</h1>
        <form action="{{ route('diary.day.update', $day->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <input type="hidden" name="url" value="{{ url()->previous() }}">
        <label for="date" class="label-form small">Date</label>
        <input type="date" name="date" id="date" class="form-control" value="{{ old('date',$day->date) }}">
    
        <label for="fact" class="label-form mt-3 small">Fact</label>
        <textarea name="fact" id="fact"  rows="2" class="form-control">{{ old('fact',$day->fact) }}</textarea>
    
    
        <label for="discovery" class="label-form mt-3 small">Discovery</label>
        <textarea name="discovery" id="discovery"  rows="2" class="form-control">{{ old('discovery',$day->discovery) }}</textarea>
    
    
        <label for="lesson" class="label-form mt-3 small">Lesson</label>
        <textarea name="lesson" id="lesson"  rows="2" class="form-control">{{ old('lesson',$day->lesson) }}</textarea>
    
    
        <label for="next-action" class="label-form mt-3 small">Next Action</label>
        <textarea name="next_action" id="next_action"  rows="2" class="form-control">{{ old('next_action',$day->next_action) }}</textarea>
    
    
        <label for="image" class="label-form mt-3 small">Image</label>
        <img src="{{ asset('storage/images/' . $day->image ) }}" alt="{{ $day->image }}" class="w-100">
        <input type="file" name="image" id="image" class="form-control">
    
        <button type="submit" class="btn btn-warning w-100 mt-3 py-2">Update</button>
        </form>
    </div>
@endsection