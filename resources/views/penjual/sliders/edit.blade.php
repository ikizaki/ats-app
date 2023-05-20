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
                    <h3>Update Sliders
                        <a href="{{ url('penjual/sliders') }}" class="btn btn-primary float-end btn-sm">back</a>
                    </h3>
                </div>
                <div class="card-body">

                    <form action="{{ url('penjual/sliders/' . $slider->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="title" value="{{ $slider->title }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea type="text" name="description" class="form-control" rows="3">{{ $slider->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control" />
                            <img src="{{ asset($slider->image) }}" style="width: 50px; height: 50px;" alt="">
                        </div>
                        <div class="mb-3">
                            <label>Status</label>
                            <input type="checkbox" {{ $slider->status == '1' ? 'checked' : '' }} name="status"> Hidden ?
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
