<!-- Page Footer-->
<footer class="main-footer">
    <div class="container">
        @if(checkLanguage('en', 'boolean'))
            <div class="row">
            <div class="col-md-4">
                <div class="logo">
                    <h6 class="text-white">{{ $logo->name }}</h6>
                </div>
                <div class="contact-details">
                    @foreach($footer[1] as $key => $value)
                        <p>{{ $value->value }}</p>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4">
                <div class="menus d-flex">
                    <ul class="list-unstyled">
                        @foreach($footer[2] as $key => $value)
                            <li class="list-inline-item info-footer">
                                <i class="fa fa-{{ $value->icon }}"></i> &nbsp;&nbsp;
                                <span class="text-capitalize">{{ $value->name }}: </span>
                                &nbsp;
                                {{ $value->value }}
                                <br>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <ul class="list-unstyled">
                    @foreach($footer[3] as $key => $value)
                        <li class="list-unstyled">
                            <i class="fa fa-{{ $value->icon }}"></i> &nbsp;&nbsp;<a href="{{ $value->value }}" class="text-capitalize">{{ $value->name }}</a><br>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @else
            <div class="row">
                <div class="col-md-4">
                    <div class="logo">
                        <h6 class="text-white">{{ $logo->name }}</h6>
                    </div>
                    <div class="contact-details">
                        @foreach($footer[1] as $key => $value)
                            <p>{{ $value->value_vn }}</p>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="menus d-flex">
                        <ul class="list-unstyled">
                            @foreach($footer[2] as $key => $value)
                                <li class="list-inline-item info-footer">
                                    <i class="fa fa-{{ $value->icon }}"></i> &nbsp;&nbsp;
                                    <span class="text-capitalize">{{ $value->name_vn }}: </span>
                                    &nbsp;
                                    {{ $value->value_vn }}
                                    <br>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="list-unstyled">
                        @foreach($footer[3] as $key => $value)
                            <li class="list-unstyled">
                                <i class="fa fa-{{ $value->icon }}"></i> &nbsp;&nbsp;<a href="{{ $value->value_vn }}" class="text-capitalize">{{ $value->name_vn }}</a><br>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>
    <div class="copyrights">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>&copy; 2017. All rights reserved. Your great site.</p>
                </div>
            </div>
        </div>
    </div>
</footer>