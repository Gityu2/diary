<form action="{{ route('diary.month.show.list') }}" method="get" class="input-group ms-auto mt-3 search-width">      
    
    <select name="year_info" id="" class="form-select py-1 search-width-year search-font-size" required>
        <option value="" >Select Year</option>
        @foreach ($years as $year)
        <option value="{{ date('Y', strtotime($year->date)) }}">{{ date('Y', strtotime($year->date)) }}</option>
        @endforeach
    </select>

    <select name="month_info" id="" class="form-select py-1 search-width-month search-font-size" required>
        <option value="">Select Month</option>
        <option value="1">Jan</option>
        <option value="2">Feb</option>
        <option value="3">Mar</option>
        <option value="4">Apr</option>
        <option value="5">May</option>
        <option value="6">Jun</option>
        <option value="7">Jul</option>
        <option value="8">Aug</option>
        <option value="9">Sep</option>
        <option value="10">Oct</option>
        <option value="11">Nov</option>
        <option value="12">Dec</option>
    </select>
    <button type="submit" class="btn btn-secondary p-1 search-width-button search-font-size">Show</button> 

</form>
