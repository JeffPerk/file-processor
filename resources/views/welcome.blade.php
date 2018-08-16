@extends('layouts.main')

@section('styles')
    <style>
        body {
            background-color: #d6e3e0;
        }

        [data-upload=csv] {
            float: right;
        }
        
        .hidden {
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">File Processor 5000</h1>
            <p class="lead">This is a simple file processor script.</p>
            <hr class="my-4">
            <p class="text-center font-italic">Please upload a CSV file only!</p>
            <input type="file" name="csv-upload">
            <button class="btn btn-primary btn-lg" data-upload="csv">Process <i class="fa fa-spinner fa-spin hidden"></i></button>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
          console.log('this is working');
        })
    </script>
@endsection
