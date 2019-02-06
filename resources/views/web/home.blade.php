@extends('web.layout')

@section('title', 'T&H | Eating...')
@section('css')
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- iCheck -->
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">Hãy chọn đi đừng ngại ngần (^__^): </h3>
                    </div>
                    <div class="box-body">
                        <!-- Minimal style -->

                        <!-- checkbox -->
                        <div class="form-group">
                            @if($listMenu)
                                @foreach($listMenu as $parent)
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="parent" name="parent_menu[]" value="{{ $parent['id'] }}" id="menu_parent_{{ $parent['id'] }}" data-id="{{ $parent['id'] }}">
                                            <strong>{{ $parent['name'] }}</strong>
                                        </label>
                                    </div>
                                    @if(isset($parent['child']))
                                        @foreach(array_chunk($parent['child'], 3) as $arrayChunk)
                                            @foreach($arrayChunk as $child)
                                            <div class="checkbox col-md-4">
                                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                <label>
                                                    <input type="checkbox"
                                                           name="menu[{{ $parent['id'] }}][]"
                                                           class="child parent_{{ $parent['id'] }}"
                                                           data-parent="{{ $parent['id'] }}"
                                                           value="{{ $child['id'] }}">{{ $child['name'] }}
                                                </label>
                                            </div>
                                            @endforeach
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-center">
                        <button id="eating" class="btn btn-default">Ấn vào đây để xem bây giờ ăn gì?</button>
                        <input id="data" value="{{ $eating }}" type="hidden">
                        <br>
                        <div id="to-day"></div>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script>
        $('.parent').click(function () {
           var id = $(this).data('id');
            if ($(this).is(':checked')) {
                $('.parent_' + id).prop('checked', true);
            } else {
                $('.parent_' + id).prop('checked', false);
            }
        });

        $('.child').click(function () {
            var parent = $(this).data('parent');
            var atLeastOneIsChecked = $('input[name="menu[' + parent + '][]"]:checked').length > 0;
            if (atLeastOneIsChecked) {
                $('#menu_parent_' + parent).prop('checked', true);
            } else {
                $('#menu_parent_' + parent).prop('checked', false);
            }
        });

        $('#eating').click(function () {
            var data = JSON.parse($('#data').val());
            var menu = [];
            $.each($("input[name='parent_menu[]']:checked"), function(){
                $.each($("input[name='menu[" + $(this).val() +"][]']:checked"), function(){
                    menu.push($(this).val());
                });
            });

            var randomData = [];
            $.each(data, function (index, value) {
                $.each(menu, function(i, m){
                    if (m == value.menu_id) {
                        randomData.push(value);
                    }
                });
            });

            if (randomData.length > 0) {
                var eating = array_rand(randomData);
                $('#to-day').html("Yep~! Hôm nay ăn <strong>" + randomData[eating].name + "</strong>");
            } else {
                $('#to-day').html('Hummmm! Không có món gì ăn cả.');
            }
        });

        function array_rand(arrayCheck) {
            var count = Object.keys(arrayCheck).length;
            return Math.floor(Math.random() * count);
        }
    </script>
@endsection