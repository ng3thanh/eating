@extends('admin.layout')

@section('title', 'Food')

@section('css')

@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Search foods</h3>
                    </div>
                    <div class="box-body">
                        <form id="search-form" action="{{ route('get.food') }}" method="get">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" id="name" class="form-control" name="name" placeholder="Name of food" value="{{ app('request')->input('name') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Menu</label>
                                        <select id="parent" class="form-control" name="menu_id">
                                            @if($listMenu)
                                                @foreach($listMenu as $key => $value)
                                                    <optgroup label="{{ $value['name']  }}">
                                                        @if(isset($value['child']))
                                                            @foreach($value['child'] as $k => $v)
                                                                <option @if(app('request')->input('menu_id') == $k) selected @endif value="{{ $v['id'] }}">{{ $v['name'] }}</option>
                                                            @endforeach
                                                        @endif
                                                    </optgroup>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" value="1" name="search">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-sm">Search</button>
                                &nbsp;&nbsp;&nbsp
                                <button type="button" class="btn btn-sm" id="button-reset">Reset</button>
                                &nbsp;&nbsp;&nbsp
                                <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#createModal">Create</button>
                            </div>
                        </form>
                    </div>

                    <div class="box-footer">
                        <div id="food">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="header-table">
                                    <tr>
                                        <th></th>
                                        <th>Menu</th>
                                        <th>Food</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Location</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($foods as $key => $food)
                                        <tr>
                                            <td class="">{{ $food['id'] }}</td>
                                            <td class="">{{ $food['menu_name'] }}</td>
                                            <td class="">{{ $food['name'] }}</td>
                                            <td class="">{{ $food['description'] }}</td>
                                            <td class="text-center">
                                                @if(isset($food['image_name']))
                                                    <img class="img-thumbnail" alt="{{ $food['alt']  }}" width="50px" src="{{ asset(config('upload.food'). $food['id']. '/' . $food['image_name']) }}">
                                                @else
                                                    <img class="img-thumbnail" alt="{{ $food['name']  }}" width="50px" src="{{ asset(config('upload.food'). 'default.png') }}">
                                                @endif
                                            </td>
                                            <td class="">{{ $food['address']  }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-xs btn-primary edit-food" data-url="{{ route('detail.food', $food['id']) }}" data-url-update="{{ route('update.food', $food['id']) }}">
                                                    <span class="fa fa-edit"></span>
                                                </button>
                                                |
                                                <button type="button" class="btn btn-xs btn-danger delete-food" data-url="{{ route('delete.food', $food['id']) }}" data-name="{{ $food['name'] }}">
                                                    <span class="fa fa-trash-o"></span>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="text-center">
                                    {{
                                        $foods->appends([
                                            "name" => app('request')->input('name'),
                                            "menu_id" => app('request')->input('menu_id'),
                                            "search" => app('request')->input('search')
                                        ])->links()
                                    }}
                                </div>
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
                    <h4 class="mb-0 center"><strong>Create food</strong></h4>
                </div>
                <div class="modal-body">
                    <form role="form" class="form-horizontal" method="post" action="{{ route('create.food') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="menu">Menu</label>
                                <select id="menu" class="form-control" name="menu_id">
                                    @if($listMenu)
                                        @foreach($listMenu as $key => $value)
                                            <optgroup label="{{ $value['name']  }}">
                                                @if(isset($value['child']))
                                                    @foreach($value['child'] as $k => $v)
                                                        <option value="{{ $v['id'] }}">{{ $v['name'] }}</option>
                                                    @endforeach
                                                @endif
                                            </optgroup>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="createName" required name="name">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="createDescription" required name="description">
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <textarea type="text" class="form-control" id="createLocation" name="location"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image"> Food image</label>
                                <input type="file" class="form-control" data-rule-required="true" name="image">
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
    <div class="modal fade" id="detailFood" tabindex="-1" role="dialog" aria-labelledby="detailFood" data-keyboard="false" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h4 class="mb-0 center"><strong>Edit food</strong> | <span id="foodName"></span></h4>
                </div>
                <div class="modal-body">
                    <form role="form" class="form-horizontal" method="post" id="foodUpdate" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="menu">Menu</label>
                                <select id="updateMenu" class="form-control" name="menu_id">
                                    @if($listMenu)
                                        @foreach($listMenu as $key => $value)
                                            <optgroup label="{{ $value['name']  }}">
                                                @if(isset($value['child']))
                                                    @foreach($value['child'] as $k => $v)
                                                        <option value="{{ $v['id'] }}">{{ $v['name'] }}</option>
                                                    @endforeach
                                                @endif
                                            </optgroup>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="updateName" required name="name">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="updateDescription" required name="description">
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <textarea type="text" class="form-control" id="updateLocation" name="location"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image"> Change image</label>
                                <input type="file" class="form-control" data-rule-required="true" name="image">
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
    <div class="modal fade" id="deleteFood" tabindex="-1" role="dialog" aria-labelledby="deleteFood" data-keyboard="false" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h4 class="mb-0 center">
                        <strong>Delete food</strong>
                    </h4>
                </div>
                <div class="modal-body">
                    <form role="form" class="form-horizontal" method="post" id="foodDelete">
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
            $(document).on('click', '.edit-food', function () {
                var urlEdit = $(this).data('url');
                var urlUpdate = $(this).data('url-update');
                getEditData(urlEdit, urlUpdate);
            });

            $(document).on('click', '.delete-food', function () {
                var urlDelete = $(this).data('url');
                var name = $(this).data('name');

                $('#deleteButton').show();
                $('#deleteText').html('Do you want to delete food ' + name + '? If deleted, it will not be able to recover.');
                $('#foodDelete').attr('action', urlDelete);

                $('#deleteFood').modal({
                    show: 'false'
                });
            });

            function getEditData(urlEdit, urlUpdate) {
                $.ajax({
                    type: "GET",
                    url: urlEdit,
                    cache: false,
                    success: function (json) {
                        console.log(json.name);
                        $('#foodName').html(json.name);
                        $('#updateName').val(json.name);
                        $('#updateDescription').val(json.description);
                        $('#updateLocation').val(json.address);
                        $('#updateMenu option').removeAttr('selected').filter('[value=' + json.menu_id + ']').attr('selected', true);
                        $('#foodUpdate').attr('action', urlUpdate);
                    }
                }).done(function () {
                    $('#detailFood').modal({
                        show: 'false'
                    });
                }).fail(function (jXHR) {
                    console.log(jXHR);
                });
            }
        });
    </script>
@endsection