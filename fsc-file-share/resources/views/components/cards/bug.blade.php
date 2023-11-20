<div class="col gx-3 mb-3">
    <div class="card mx-auto h-100">
        <div class="card-body">
            <pre>{{implode(PHP_EOL, $bug->info())}}</pre>
            <a href="/bugs/{{$bug->id}}/push" class="btn btn-success">Push</a>
            <a href="/bugs/{{$bug->id}}/delete" class="btn btn-danger">Delete</a>
        </div>
    </div>
</div>