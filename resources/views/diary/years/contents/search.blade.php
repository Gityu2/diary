<form action="{{ route('diary.year.show') }}" method="get" class="input-group w-25 ms-auto mt-3">      
      
  <select name="year_info" id="" class="form-control" style="font-size:12px;">
      <option value="" >Select Year</option>
    @foreach ($years as $year)
      <option value="{{ date('Y', strtotime($year->date)) }}">{{ date('Y', strtotime($year->date)) }}</option>
    @endforeach
  </select>
    <button type="submit" class="btn btn-secondary">Show</button> 

</form>