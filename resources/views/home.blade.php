@extends('layouts.main')

@section('styles')
    <style>
        body {
            background-color: #d6e3e0;
        }

        [data-upload=csv] {
            float: right;
        }
        
        .jumbotron {
            background-color: white;
            margin-top: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">File Processor 5000</h1>
            <p class="lead">This is a simple file processor script.</p>
            <hr class="my-4">
            <form action="{{ route("process.csv") }}" method="post" enctype="multipart/form-data"> @csrf
                <p class="text-center font-italic">Please upload a CSV file only!</p>
                <input type="file" name="csv-upload">
                <button class="btn btn-primary btn-lg" type="submit" data-upload="csv">Process</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
          $("[data-upload=csv]").click(function () {
            $(this).css("opacity", .5);
            $(this).html("Processing <i class='fa fa-spinner fa-spin spinning-icon'></i>");
          });
        })
    </script>
@endsection
