<div class="col gx-3 mb-3">
    <div class="card mx-auto mb-2 h-100">
        <div class="card-body">
            <a href="/{{config('mod.report_types')[$report->type]}}/{{$report->reported}}">Link to Reported</a>
            <p><strong>Category:</strong> {{$report->category}}</p>
            <p><strong>Info:</strong> {{$report->info}}</p>
            <form action="/{{config('mod.report_types')[$report->type]}}/{{$report->reported}}" method="POST">
                @method("DELETE")
                @csrf
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>