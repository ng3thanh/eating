@extends('admin.layout')

@section('title', 'Dashboard')

@section('css')

@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <div id="menu">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
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
                            $count = ($parent['child']) ? count($parent['child']) : 1;
                        @endphp
                        @if($parent['child'])
                            @foreach($parent['child'] as $child)
                                <tr>
                                    @if($i == 1)
                                        <td rowspan="{{ $count }}">{{ $parent['id'] }}</td>
                                        <td rowspan="{{ $count }}">{{ $parent['name'] }}</td>
                                    @endif
                                    <td>{{ $child['name'] }}</td>
                                    <td>{{ $parent['created_at'] }}</td>
                                    <td>A</td>
                                </tr>
                                @php($i++)
                            @endforeach
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <div id="food"></div>
        <div id="location"></div>
    </section>
    <!-- /.content -->

@endsection

@section('script')
@endsection