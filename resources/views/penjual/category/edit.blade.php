@extends('layouts.penjual')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Category
                        <a href="{{ url('penjual/category') }}" class="btn btn-primary float-end btn-sm">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('penjual/category/'.$category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Name</label>
                                <input type="text" name="name" value="{{ $category->name }}" class="form-control" />
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Slug</label>
                                <input type="text" name="slug" value="{{ $category->slug }}" class="form-control" />
                                @error('slug')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Description</label>
                                <textarea name="description" class="form-control" rows="3">{{ $category->description }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Image</label><br>
                                <img src="{{ asset('uploads/category/'.$category->image) }}" width="60px" height="60px" alt="img">
                                <input type="file" name="image" class="form-control" />
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Status</label><br>
                                <input type="checkbox" {{ $category->status == '1' ? "checked" : "" }} name="status" />
                            </div>

                            <div class="col-md-12 mb-3">
                                <h4>SEO Tags</h4>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Meta title</label>
                                <input type="text" name="meta_title" value="{{ $category->meta_title }}" class="form-control" />
                                @error('meta_title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Meta keyword</label>
                                <textarea name="meta_keyword" class="form-control" rows="3">{{ $category->meta_keyword }}</textarea>
                                @error('meta_keyword')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Meta description</label>
                                <textarea name="meta_description" class="form-control" rows="3">{{ $category->meta_description }}</textarea>
                                @error('meta_description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-primary float-end">Update</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
