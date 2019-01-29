@extends('web.layout')

@section('title', 'Blogs')
@section('css')
    <style>
        section {
            border-radius: 1em;
            padding: 1em;
            position: absolute;
            top: 50%;
            left: 50%;
            margin-right: -50%;
            transform: translate(-50%, -50%) }
    </style>
@endsection
@section('content')
    <section>
        <button id="eating" class="btn btn-default">Ấn vào đây để xem hôm nay ăn gì?</button>
        <input id="data" value="{{ $eating }}" type="hidden">
        <br>
        <div id="to-night"></div>
    </section>

@endsection

@section('script')
    <script>
        $('#eating').click(function () {
            var data = JSON.parse($('#data').val());
            var lo = (Math.random()*100 >= 70) ? data['nha_hang'] : data['an_vat'];
            var type = lo[array_rand(lo)];
            var eating = type[array_rand(type)];
            $('#to-night').html('Yep~! Hôm nay ăn ' + eating);
        })
        
        function array_rand(arrayCheck) {
            var count = Object.keys(arrayCheck).length;
            return num = Math.floor(Math.random() * count);
        }
    </script>
@endsection