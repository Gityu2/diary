@extends('layouts.app')

@section('title', 'Edit Month')
  

@section('content')
  
  <div class="container" style="width:50%;" >
  
    <h1 class="text-center">Edit Entry(Week)</h1>
    <form action="{{ route('diary.week.update', $week->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('PATCH')
  
      <label for="date" class="label-form">Date</label>
      <input type="date" name="date" id="date" class="form-control" value="{{ old('date',$week->date) }}">
  
      <label for="fact" class="label-form mt-4">Fact</label>
      <textarea name="fact" id="fact"  rows="2" class="form-control">{{ old('fact',$week->fact) }}</textarea>
  
  
      <label for="discovery" class="label-form mt-4">Discovery</label>
      <textarea name="discovery" id="discovery"  rows="2" class="form-control">{{ old('discovery',$week->discovery) }}</textarea>
  
  
      <label for="lesson" class="label-form mt-4">Lesson</label>
      <textarea name="lesson" id="lesson"  rows="2" class="form-control">{{ old('lesson',$week->lesson) }}</textarea>
  
  
      <label for="next-action" class="label-form mt-4">Next Action</label>
      <textarea name="next_action" id="next_action"  rows="2" class="form-control">{{ old('next_action',$week->next_action) }}</textarea>
    
      <button type="submit" class="btn btn-warning w-100 mt-5 py-2">Update</button>
    </form>
  </div>
@endsection