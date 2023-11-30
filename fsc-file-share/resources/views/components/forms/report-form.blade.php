@php($types = config('mod.report_types'))

<form action="/report/{{$id}}" method="POST">
    @csrf
    <div class="d-none">
        <x-formrow>
            <label for="type" class="form-label"><x-asterisk></x-asterisk> Type</label>
            <select name="type" id="type" class="form-control">
                @foreach(array_keys($types) as $option)
                    <option value={{$option}} {{$option == intval($type) ? 'selected' : ''}}>{{ucwords($types[$option])}}</option>
                @endforeach
            </select>
        </x-formrow>
    </div>
    <x-formrow>
        <label for="category" class="form-label"><x-asterisk></x-asterisk> Category</label>
        <select name="category" id="category" class="form-control">
            <option selected disabled>Select a category</option>
            @foreach(config('mod.report_categories') as $category)
                <option value="{{$category}}">{{ucwords($category)}}</option>
            @endforeach
        </select>
    </x-formrow>
    <x-formrow>
        <label for="info" class="form-label">Extra Information</label>
        <input type="text" class="form-control">
    </x-formrow>
    <button type="submit" class="btn btn-danger">Report</button>
</form>