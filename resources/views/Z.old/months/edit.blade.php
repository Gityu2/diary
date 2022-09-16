@extends('layouts.app')

@section('title', 'Edit Month')
  

@section('content')
  
<div class="bg-light">

  <div class="container" style="width:50%;" >
  
    <h1 class="text-center">Edit Entry(Month)</h1>
    <form action="{{ route('month.update', $month->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('PATCH')
  
      <label for="date" class="label-form">Date</label>
      <input type="date" name="date" id="date" class="form-control" value="{{ old('date',$month->date) }}">
  
      <label for="fact" class="label-form mt-4">Fact</label>
      <textarea name="fact" id="fact"  rows="3" class="form-control">{{ old('fact',$month->fact) }}</textarea>
  
  
      <label for="discovery" class="label-form mt-4">Discovery</label>
      <textarea name="discovery" id="discovery"  rows="3" class="form-control">{{ old('discovery',$month->discovery) }}</textarea>
  
  
      <label for="lesson" class="label-form mt-4">Lesson</label>
      <textarea name="lesson" id="lesson"  rows="3" class="form-control">{{ old('lesson',$month->lesson) }}</textarea>
  
  
      <label for="next-action" class="label-form mt-4">Next Action</label>
      <textarea name="next_action" id="next_action"  rows="3" class="form-control">{{ old('next_action',$month->next_action) }}</textarea>
    
      <button type="submit" class="btn btn-warning w-100 mt-5 py-2">Update</button>
    </form>
  </div>
</div>
@endsection