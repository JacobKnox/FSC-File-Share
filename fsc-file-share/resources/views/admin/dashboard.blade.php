<x-template pageName="Admin Dashboard">
    <p class="h5 text-center">Bug Reports</p>
    <div class="container">
        @foreach($bugs as $bug)
            <div class="row row-cols-3">
                <div class="col gx-3">
                    <div class="card mx-auto h-100">
                        <div class="card-body">
                            <p>{{implode(" ", $bug->getInfo())}}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <p class="h5 text-center">Auto Mod Alerts</p>
    <div class="container">
        @foreach($automod as $report)
            <p>{{$report->category}}</p>
        @endforeach
    </div>
    <p class="h5 text-center">User Reports</p>
    <div class="container">
        @foreach($reports as $report)
            <p>{{$report->category}}</p>
        @endforeach
    </div>
</x-template>