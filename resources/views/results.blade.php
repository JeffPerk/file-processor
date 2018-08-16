@extends('layouts.main')

@section('styles')
    <style>
        .card {
            margin-top: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <h5 class="card-header">Results</h5>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <th>SKU</th>
                        <th>Cost</th>
                        <th>Price</th>
                        <th>QTY</th>
                        <th>Profit Margin</th>
                        <th>Total Profit (USD)</th>
                        <th>Total Profit (CAD)</th>
                    </thead>
                    <tbody>
                        @foreach($products as $index => $product)
                            <tr>
                                <td>{{ $product->getSku() }}</td>
                                <td>{{ $product->getCost() }}</td>
                                <td>{{ $product->getPrice() }}</td>
                                <td>{{ $product->getQuantity() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{--@foreach($products as $index => $product)--}}
            {{--{{ $product->getSku() }}--}}
        {{--@endforeach--}}
    </div>
@endsection