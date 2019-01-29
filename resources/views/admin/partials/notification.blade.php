@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session()->has('error'))
    <div class="box-body">
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4>
                <i class="icon fa fa-ban"></i> Alert!
            </h4>
            {{ session()->get('error') }}
        </div>
    </div>
@endif

@if(session()->has('info'))
    <div class="box-body">
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4>
                <i class="icon fa fa-info"></i> Alert!
            </h4>
            {{ session()->get('info') }}
        </div>
    </div>
@endif

@if(session()->has('warning'))
    <div class="box-body">
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4>
                <i class="icon fa fa-warning"></i> Alert!
            </h4>
            {{ session()->get('warning') }}
        </div>
    </div>
@endif

@if(session()->has('success'))
    <div class="box-body">
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4>
                <i class="icon fa fa-check"></i> Alert!
            </h4>
            {{ session()->get('success') }}
        </div>
    </div>
@endif