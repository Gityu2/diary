<div class="row">
  @foreach ($month_days as $day)
    <div class="col-3">
      <div class="card">
        <div class="card-header">
          {{ date('m-d(D)', strtotime($day->date)) }}
          <i class="fa-solid fa-heart text-danger"></i>
        </div>
        <div class="card-image" class="w-100">
          @if ($day->image)
            <img src="" alt="">
          @else
            <img src="{{ asset('storage/images/no_image.png') }}" alt="a">
          @endif
        </div>
        <div class="card-body">
          {{ $day->fact }}
        </div>
      </div>
    </div>
  @endforeach
</div>