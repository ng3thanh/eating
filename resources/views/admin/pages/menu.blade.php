@extends('admin.layout')

@section('title', 'Menu')

@section('css')

@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <div id="menu">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="header-table">
                        <tr>
                            <th>

                            </th>
                            <th>Name</th>
                            <th>Child</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($menus as $key => $parent)
                        @php
                            $i = 1;
                            $count = ($parent['child']) ? count($parent['child']) + 1 : 1;
                        @endphp
                        <tr>
                            @if($i == 1)
                                <td class="parent_row" rowspan="{{ $count }}">{{ $parent['id'] }}</td>
                                <td class="parent_row" rowspan="{{ $count }}">{{ $parent['name'] }}</td>
                            @endif
                            <td class="parent_row">{{ $parent['name'] }}</td>
                            <td class="parent_row text-center">{{ $parent['created_at'] }}</td>
                            <td class="parent_row text-center">
                                <button type="button" class="btn btn-xs btn-primary edit-menu" data-url="{{ route('detail.menu', $parent['id']) }}" data-toggle="modal">
                                    <span class="fa fa-edit"></span>
                                </button>
                                |
                                <button type="button" class="btn btn-xs btn-danger delete-menu" data-id="{{ $parent['id'] }}" data-toggle="modal">
                                    <span class="fa fa-trash-o"></span>
                                </button>
                            </td>
                        </tr>
                        @if($parent['child'])
                            @foreach($parent['child'] as $child)
                                <tr>
                                    <td>{{ $child['name'] }}</td>
                                    <td class="text-center">{{ $child['created_at'] }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-xs btn-primary edit-menu" data-url="{{ route('detail.menu', $child['id']) }}" data-toggle="modal">
                                            <span class="fa fa-edit"></span>
                                        </button>
                                        |
                                        <button type="button" class="btn btn-xs btn-danger delete-menu" data-id="{{ $child['id'] }}" data-toggle="modal">
                                            <span class="fa fa-trash-o"></span>
                                        </button>
                                    </td>
                                </tr>
                                @php($i++)
                            @endforeach
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- /.content -->

    <div class="modal fade" id="detailMenu" tabindex="-1" role="dialog" aria-labelledby="detailMenu" data-keyboard="false"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h4 class="mb-0 center"><strong>Edit menu</strong> | <span id="menuNam"></span></h4>
                </div>
                <div class="modal-body">
                    <form role="form" class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="parent">Parent</label>
                                <select id="parent" class="form-control" name="parent_id">
                                    @foreach($listMenu as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn--gradient-default col-12" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $( document ).ready(function() {
            $(document).on('click', '.edit-menu', function () {
                var urlEdit = $(this).data('url');
                getEditData(urlEdit);
            });

            function getEditData(urlEdit) {
                $.ajax({
                    type: "GET",
                    url: urlEdit,
                    cache: false,
                    success: function (json) {
                        $('#menuNam').html(json.name);
                        $('#name').val(json.name);
                        $('#parent').val(json.parent_id);
                    }
                }).done(function () {
                    $('#detailMenu').modal({
                        show: 'false'
                    });
                }).fail(function (jXHR) {
                    console.log(jXHR);
                });
            }
        });
    </script>
@endsection