@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Destination</th>
                                <th>active</th>
                                <th>delayed</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($flights as $flight)
                            <tr>
                                <th scope="row">{{ $flight->id }}</th>
                                <td>{{ $flight->name }}</td>
                                <td>{{ $flight->destination }}</td>
                                <td>{{ $flight->active }}</td>
                                <td>{{ $flight->delayed }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $flights->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
