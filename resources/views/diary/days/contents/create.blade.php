    <div class="container width">
        @if (request()->is('diary/day/create'))
            <h1 class="text-center mt-3">New Entry</h1>
            <form action="{{ route('diary.day.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            
        @else
            <h1 class="text-center mt-3">Edit Entry(Day)</h1>
            <form action="{{ route('diary.day.update', $day->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <input type="hidden" name="url" value="{{ url()->previous() }}">
        @endif

        <label for="date" class="label-form small">■Date</label>
        <input type="date" name="date" id="date" class="form-control" value="{{ request()->is('diary/day/create') ? old('date') : old('date', $day->date) }}"  {{ request()->is('diary/day/create') ? "" : "readonly" }}>
        @error('date')
            <p class="text-danger small m-0 p-0">{{ $message }}</p>
        @enderror

        <label for="fact" class="label-form mt-3 small">■Fact</label>
        <textarea name="fact" id="fact"  rows="2" class="form-control textarea-size" placeholder="What happend today?">{{ request()->is('diary/day/create') ? old('fact') : old('fact', $day->fact) }}</textarea>


        <label for="discovery" class="label-form mt-3 small">■Discovery</label>
        <textarea name="discovery" id="discovery"  rows="2" class="form-control textarea-size" placeholder="What did you feel?">{{ request()->is('diary/day/create') ? old('discovery') : old('discovery', $day->discovery) }}</textarea>


        <label for="lesson" class="label-form mt-3 small">■Lesson</label>
        <textarea name="lesson" id="lesson"  rows="2" class="form-control textarea-size" placeholder="What did you learn form the fact?">{{ request()->is('diary/day/create') ? old('lesson') : old('lesson', $day->lesson) }}</textarea>


        <label for="next-action" class="label-form mt-3 small">■Next Action</label>
        <textarea name="next_action" id="next_action"  rows="2" class="form-control textarea-size" placeholder="What are you going to do next?">{{ request()->is('diary/day/create') ? old('next_action') : old('next_action', $day->next_action) }}</textarea>


        <label for="image" class="label-form mt-3 small">■Image</label>
        @if (request()->is('diary/day/create'))
        <input type="file" name="image" id="image" class="form-control textarea-size">
        <button type="submit" class="btn btn-primary w-100 mt-3 py-2">Save</button>
        
        @else
        <img src="{{ asset('storage/images/' . $day->image ) }}" alt="{{ $day->image }}" class="w-100">
        <input type="file" name="image" id="image" class="form-control">
        <button type="submit" class="btn btn-warning w-100 mt-3 py-2">Update</button>
        @endif
        
        </form>
    </div>