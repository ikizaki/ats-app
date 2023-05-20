@extends('layouts.penjual')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Add Products
                        <a href="{{ url('penjual/products') }}" class="btn btn-primary float-end btn-sm">Back</a>
                    </h3>
                </div>
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-warning">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ url('penjual/products') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                    type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="seotag-tab" data-bs-toggle="tab" data-bs-target="#seotag"
                                    type="button" role="tab" aria-controls="seotag" aria-selected="false">SEO
                                    tags</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details"
                                    type="button" role="tab" aria-controls="details"
                                    aria-selected="false">Details</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image"
                                    type="button" role="tab" aria-controls="image" aria-selected="false">Product
                                    Image</button>
                            </li>
                        </ul>
                        <div class="tab-content mt-3" id="myTabContent">

                            <div class="border p-3 tab-pane fade show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <div class="mb-3">
                                    <label>Category</label>
                                    <select name="category_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>Product Name</label>
                                    <input type="text" name="name" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label>Product Slug</label>
                                    <input type="text" name="slug" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label>Small Description (500 word)</label>
                                    <textarea name="small_description" class="form-control" rows="4"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" rows="4"></textarea>
                                </div>
                            </div>

                            <div class="border p-3 tab-pane fade" id="seotag" role="tabpanel"
                                aria-labelledby="seotag-tab">
                                <div class="mb-3">
                                    <label>Meta Title</label>
                                    <input type="text" name="meta_title" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label>Meta Keyword</label>
                                    <input type="text" name="meta_keyword" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label>Meta Description</label>
                                    <textarea name="meta_description" class="form-control" rows="4"></textarea>
                                </div>
                            </div>

                            <div class="border p-3 tab-pane fade" id="details" role="tabpanel"
                                aria-labelledby="details-tab">
                                <div class="row">
                                    <div class="col-md-4">

                                        <div class="mb-3">
                                            <label>Original Price</label>
                                            <input type="number" name="original_price" class="form-control" />
                                        </div>
                                        <div class="mb-3">
                                            <label>Selling Price</label>
                                            <input type="number" name="selling_price" class="form-control" />
                                        </div>
                                        <div class="mb-3">
                                            <label>Quantity</label>
                                            <input type="number" name="quantity" class="form-control" />
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Status</label><br>
                                            <input type="checkbox" name="status" />
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Trending</label><br>
                                            <input type="checkbox" name="trending" />
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <div class="border p-3 tab-pane fade" id="image" role="tabpanel"
                                aria-labelledby="image-tab">
                                <div class="mb-3">
                                    <label>Upload Product Images</label>
                                    <input name="image[]" type="file" multiple class="form-control" />
                                </div>
                            </div>

                        </div>
                        <div>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
