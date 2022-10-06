<div class="row mt-3">
    @foreach ($month_days as $day)
        <div class="col-6 col-md-4 col-xl-3">
        <div class="card mb-5">
            <div class="card-header">
                <div class="row justify-content-between">
                    <div class="col-auto">{{ date('n/j(D)', strtotime($day->date)) }}</div>
                    <div class="col-auto px-0">
                        @include('diary.days.contents.menu')
                        @include('diary.days.modal.status')              
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
            <div class="card-body feature-body">
                {{ $day->fact }}
            </div>
        </div>
        </div>
    @endforeach
</div>
