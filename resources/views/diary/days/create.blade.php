@extends('layouts.app')

@section('title', 'Create day')

@section('content')
  
<div class="" style="min-height:93vh; ">
    <div class="container w-50">
        <h1 class="text-center mt-3">New Entry</h1>
        <form action="{{ route('diary.day.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <label for="date" class="label-form small">Date</label>
        <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}">
        @error('date')
            <p class="text-danger small m-0 p-0">{{ $message }}</p>
        @enderror

        <label for="fact" class="label-form mt-3 small">Fact</label>
        <textarea name="fact" id="fact"  rows="2" class="form-control" placeholder="What happend today?">{{ old('fact') }}</textarea>


        <label for="discovery" class="label-form mt-3 small">Discovery</label>
        <textarea name="discovery" id="discovery"  rows="2" class="form-control" placeholder="What did you feel?">{{ old('discovery') }}</textarea>


        <label for="lesson" class="label-form mt-3 small">Lesson</label>
        <textarea name="lesson" id="lesson"  rows="2" class="form-control" placeholder="What did you learn form the fact?">{{ old('lesson') }}</textarea>


        <label for="next-action" class="label-form mt-3 small">Next Action</label>
        <textarea name="next_action" id="next_action"  rows="2" class="form-control" placeholder="What are you going to do next?">{{ old('next_action') }}</textarea>


        <label for="image" class="label-form mt-3 small">Image</label>
        <input type="file" name="image" id="image" class="form-control">

        <button type="submit" class="btn btn-primary w-100 mt-3 py-2">Save</button>
        </form>
    </div>
</div>
@endsection