@extends('app')

@section('content')
    <table>
        <tr>
            <th>name</th>
            <th>price</th>
            <th>manufactured</th>
            <th>experation</th>
            <th>currency_id</th>
        </tr>
    @foreach ($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->manufactured }}</td>
            <td>{{ $product->experation }}</td>
            <td>{{ $product->currency_id }}</td>
        </tr>
    @endforeach
    </table>
@endsection