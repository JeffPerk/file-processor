@extends('layouts.main')

@section('styles')
    <style>
        .card {
            margin-top: 20px;
        }

        .negative {
            color: red;
        }

        .positive {
            color: green;
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
                                <td>{{ $product->getSku() ?: "---" }}</td>
                                <td>{{ $product->getCost() ?: "---" }}</td>
                                <td>{{ $product->getPrice() ?: "---" }}</td>
                                <td class="{{ $product->getQuantity() < 0 ? "negative" : "positive" }}">{{ $product->getQuantity() ?: "---" }}</td>
                                <td class="{{ $product->profit_margin < 0 ? "negative" : "positive" }}">{{ round($product->profit_margin, 2) ?: "---" }}%</td>
                                <td class="{{ $product->profit_total < 0 ? "negative" : "positive" }}">{{ $product->profit_total ? money_format('$%!i', $product->profit_total) : "---" }}</td>
                                <td class="{{ $product->canadian_total_profit < 0 ? "negative" : "positive" }}">{{ $product->canadian_profit_total ? money_format('$%!i', $product->canadian_profit_total) : "---" }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                <tfoot>
                    <tr>
                        <td>Avg Price: </td>
                        <td>${{ $footerData['average_price'] }}</td>
                        <td>---</td>
                        <td>Total QTY: </td>
                        <td>{{ $footerData['total_quantity'] }}</td>
                        <td>---</td>
                        <td>Avg Profit Margin: </td>
                        <td>{{ round($footerData['average_profit_margin'], 2) }}%</td>
                        <td>---</td>
                        <td>Total Profit (USD): </td>
                        <td>{{ money_format("$%!i", $footerData['total_profit_usd']) }}</td>
                        <td>---</td>
                        <td>Total Profit (CAD): </td>
                        <td>{{ money_format("$%!i", $footerData['total_profit_cad']) }}</td>
                    </tr>
                </tfoot>
            </div>
        </div>
    </div>
@endsection