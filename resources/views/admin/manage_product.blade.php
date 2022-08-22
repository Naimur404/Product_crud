@extends('admin.app')

@section('product','active')
@section('manage_product','active')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Table</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="example1">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Desc</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Photo</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                  @foreach ($products as $data)


                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->desc }}</td>
                                    <td>{{ $data->price }}</td>
                                    <td>{{ $data->qty }}</td>
                                    <td>@if($data->img != '')
                                        <img width="70px" src="{{ asset('storage/media/' . $data->img ) }}"/>
                                        @endif
                                    </td>
                                    <td class="pt_10 pb_10">
                                        <a href="{{ route('product.edit',$data->id) }}" class="btn btn-primary">Edit</a>
                                        <form action="{{ route('product.destroy',$data->id) }}" method="POST" >
                                            @method('delete')
                                            @csrf

                                            <button type="submit" class="btn btn-danger mt-2" onClick="return confirm('Are you sure?');">Detele</button>

                                        </form>
                                    </td>

                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
