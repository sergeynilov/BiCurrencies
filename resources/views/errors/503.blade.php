
     <div class="dark-mode">
        <div class="wrapper">

            <div class="content-wrapper">

                <div class="card card-danger">

                    <div class="card-header">
                        <h3 class="card-title">
                            {{ config('app.name', 'Laravel') }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <p class="text-lg text-warning p-2 pl-4">
                                <i :class="getHeaderIcon('info')" class="mr-1"></i>
                                Site is not available now.<br>
                                Try later.
                            </p>
                        </div>
                    </div>

                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
