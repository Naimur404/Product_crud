@extends('admin.app')
@section('product','active')
@section('add_product','active')
@section('content')

<section class="section">
    <div class="section-header">
        <h1>Form</h1>
        <div class="ml-auto">
            <a href="" class="btn btn-primary"><i class="fas fa-plus"></i> Button</a>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="" enctype="multipart/form-data" id="frmaddproduct">
                            {{-- using ajax --}}
                           @csrf
                            <div class="form-group mb-3">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>



                            <div class="form-group mb-3">
                                <label>Desc</label>
                                <textarea name="desc" class="form-control h_100" cols="30" rows="10"></textarea>
                                @error('desc')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label>Price</label>
                                <input type="number" class="form-control" name="price" value="">
                                @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label>Qty</label>
                                <input type="number" class="form-control" name="qty" value="">
                                @error('qty')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label>Photo</label>
                                <div>
                                    <input type="file" name="image">
                                    @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="btnaddproduct">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
