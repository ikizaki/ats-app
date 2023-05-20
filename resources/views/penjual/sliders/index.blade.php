@extends('layouts.penjual')

@section('content')
    <div class="row">
        <div class="col-md-12">

            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3>Home Sliders
                        <a href="{{ url('penjual/sliders/create') }}" class="btn btn-primary float-end btn-sm">Add
                            Sliders</a>
                    </h3>
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($sliders as $slider)
                                <tr>
                                    <td>{{ $slider->id }}</td>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->description }}</td>
                                    <td><img src="{{ asset($slider->image) }}" style="width: 70px;height: 70px;"
                                            alt="slider image"></td>
                                    <td>{{ $slider->status == '0' ? 'Visible' : 'Hidden' }}</td>
                                    <td>
                                        <a href="{{ url('penjual/sliders/'.$slider->id.'/edit') }}" class="btn button-sm btn-success">Edit</a>
                                        <a href="{{ url('penjual/sliders/'.$slider->id.'/delete') }}" onclick="return confirm('Are you sure delete this data')" class="btn button-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>Sliders not found</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
@endsection
