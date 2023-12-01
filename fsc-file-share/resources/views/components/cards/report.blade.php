<div class="col gx-3 mb-3">
    <div class="card mx-auto mb-2 h-100">
        <div class="card-body">
            <p><a href="/{{$report->type}}/{{$report->reported}}">Link to Reported</a></p>
            <p><strong>Category:</strong> {{$report->category}}</p>
            <p><strong>Info:</strong> {{$report->info}}</p>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#resolveModal">
                Resolve
            </button>
        </div>
    </div>
</div>


<div class="modal fade" id="resolveModal" tabindex="-1" aria-labelledby="resolveModalLabel" aria-hidden="true">
    <form action="/reports/{{$report->id}}" method="POST">
        @method("PUT")
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resolveModalLabel">Resolve Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <x-formrow>
                        <input type="checkbox" name="warn" id="warn">
                        <label for="warn" class="form-label">Issue warning to user</label>
                    </x-formrow>
                    <x-formrow>
                        <label for="duration">Duration of Warning in Days (if applicable)</label>
                        <input type="number" name="duration" id="duration", min="1">
                    </x-formrow>
                    <x-formrow>
                        <label for="reason">Reason for Warning (if applicable)</label>
                        <input type="text" name="reason" id="reason">
                    </x-formrow>
                    <x-formrow>
                        <label for="action" class="form-label"><x-asterisk></x-asterisk> Action</label>
                        <select name="action" id="action" class="form-control" required>
                            <option value="keep">Keep</option>
                            <option value="delete">Delete</option>
                        </select>
                    </x-formrow>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Resolve</button>
                </div>
            </div>
        </div>
    </form>
</div>