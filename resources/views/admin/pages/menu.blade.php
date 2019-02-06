@extends('admin.layout')

@section('title', 'Menu')

@section('css')

@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-default">
                    <div class="box-body">
                        <div id="menu">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="header-table">
                                    <tr>
                                        <th>
                                            <button type="button" class="btn btn-xs" data-toggle="modal" data-target="#createModal">
                                                <span class="fa fa-plus"></span>
                                            </button>
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
                                            $count = isset($parent['child']) ? count($parent['child']) + 1 : 1;

                                        @endphp
                                        <tr>
                                            @if($i == 1)
                                                <td class="parent_row" rowspan="{{ $count }}">{{ $parent['id'] }}</td>
                                                <td class="parent_row" rowspan="{{ $count }}">{{ $parent['name'] }}</td>
                                            @endif
                                            <td class="parent_row">{{ $parent['name'] }}</td>
                                            <td class="parent_row text-center">{{ $parent['created_at'] }}</td>
                                            <td class="parent_row text-center">
                                                <button type="button" class="btn btn-xs btn-primary edit-menu" data-url="{{ route('detail.menu', $parent['id']) }}" data-url-update="{{ route('update.menu', $parent['id']) }}">
                                                    <span class="fa fa-edit"></span>
                                                </button>
                                                |
                                                <button type="button" class="btn btn-xs btn-danger delete-menu" data-url="{{ route('delete.menu', $parent['id']) }}" data-count="{{ $count }}" data-name="{{ $parent['name'] }}">
                                                    <span class="fa fa-trash-o"></span>
                                                </button>
                                            </td>
                                        </tr>
                                        @if(isset($parent['child']))
                                            @foreach($parent['child'] as $child)
                                                <tr>
                                                    <td>{{ $child['name'] }}</td>
                                                    <td class="text-center">{{ $child['created_at'] }}</td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-xs btn-primary edit-menu" data-url="{{ route('detail.menu', $child['id']) }}" data-url-update="{{ route('update.menu', $child['id']) }}">
                                                            <span class="fa fa-edit"></span>
                                                        </button>
                                                        |
                                                        <button type="button" class="btn btn-xs btn-danger delete-menu" data-url="{{ route('delete.menu', $child['id']) }}" data-count="1" data-name="{{ $child['name'] }}">
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
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

    <!-- Modal Create -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h4 class="mb-0 center"><strong>Create menu</strong></h4>
                </div>
                <div class="modal-body">
                    <form role="form" class="form-horizontal" method="post" action="{{ route('create.menu') }}">
                        @csrf
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
                                <input type="text" class="form-control" id="createName" name="name">
                            </div>
                        </div>
                        <div class="box-footer text-center">
                            <button type="submit" class="btn btn-success">Create</button>
                            <button class="btn btn--gradient-default col-12" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update -->
    <div class="modal fade" id="detailMenu" tabindex="-1" role="dialog" aria-labelledby="detailMenu" data-keyboard="false" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h4 class="mb-0 center"><strong>Edit menu</strong> | <span id="menuName"></span></h4>
                </div>
                <div class="modal-body">
                    <form role="form" class="form-horizontal" method="post" id="menuUpdate">
                        @csrf
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
                                <input type="text" class="form-control" id="editName" name="name">
                            </div>
                        </div>
                        <div class="box-footer text-center">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button class="btn btn--gradient-default col-12" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="deleteMenu" tabindex="-1" role="dialog" aria-labelledby="deleteMenu" data-keyboard="false" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h4 class="mb-0 center">
                        <strong>Delete menu</strong>
                    </h4>
                </div>
                <div class="modal-body">
                    <form role="form" class="form-horizontal" method="post" id="menuDelete">
                        @csrf
                        <div class="box-body">
                            <p id="deleteText"></p>
                        </div>
                        <div class="box-footer text-center">
                            <button type="submit" id="deleteButton" class="btn btn-warning">Delete</button>
                            <button class="btn btn--gradient-default col-12" data-dismiss="modal">Close</button>
                        </div>
                    </form>
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
                var urlUpdate = $(this).data('url-update');
                getEditData(urlEdit, urlUpdate);
            });

            $(document).on('click', '.delete-menu', function () {
                var urlDelete = $(this).data('url');
                var count = $(this).data('count');
                var name = $(this).data('name');
                if (count === 1) {
                    $('#deleteButton').show();
                    $('#deleteText').html('Do you want to delete menu ' + name + '? If deleted, it will not be able to recover.');
                    $('#menuDelete').attr('action', urlDelete);
                } else {
                    $('#deleteButton').hide();
                    $('#deleteText').html('You must delete the submenu before deleting the parent menu');
                }

                $('#deleteMenu').modal({
                    show: 'false'
                });
            });

            function getEditData(urlEdit, urlUpdate) {
                $.ajax({
                    type: "GET",
                    url: urlEdit,
                    cache: false,
                    success: function (json) {
                        $('#menuName').html(json.name);
                        $('#editName').val(json.name);
                        $('#parent option').removeAttr('selected').filter('[value=' + json.parent_id + ']').attr('selected', true)
                        $('#menuUpdate').attr('action', urlUpdate);
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