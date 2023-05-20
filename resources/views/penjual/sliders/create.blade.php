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
                    <h3>Add Sliders
                        <a href="{{ url('penjual/sliders') }}" class="btn btn-primary float-end btn-sm">back</a>
                    </h3>
                </div>
                <div class="card-body">

                    <form action="{{ url('penjual/sliders/create') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea type="text" name="description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                          <label>Image</label>
                          <input type="file" name="image" class="form-control"/>
                      </div>
                        <div class="mb-3">
                            <label>Status</label>
                            <input type="checkbox" name="status"> Hidden ?
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
