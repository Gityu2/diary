<form action="{{ route('diary.year.show') }}" method="get" class="input-group mt-3 ms-auto" style="width:180px;">      
        
    <select name="year_info" id="" class="form-select py-1 search-width-year search-font-size">
        <option value="" >Select Year</option>
        @foreach ($years as $year)
        <option value="{{ date('Y', strtotime($year->date)) }}">{{ date('Y', strtotime($year->date)) }}</option>
        @endforeach
    </select>
        <button type="submit" class="btn btn-secondary p-1 search-width-button search-font-size">Show</button> 

</form>