@extends('backend.admin-master')
@section('ecom_active')
    active
@endsection
@section('product_active')
    active
@endsection
@section('content')
<section class="content">
    <div class="row">
        <div class="col-12">

            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">All Products</h3>
                 <a href="{{ route('product.create') }}" class="btn btn-primary float-right">Add Product</a>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">
                     <table id="example5" class="table table-bordered table-striped" style="width:100%">
                       <thead>
                           <tr>
                               <th width="5">Sl</th>
                               <th>Code</th>
                               <th>Name</th>
                               <th>Category</th>
                               <th>Price</th>
                               <th>Qty</th>
                               <th>Thumbnail</th>
                               <th>Created</th>
                               <th width="190" style="text-align: center">Action</th>
                           </tr>
                       </thead>
                       <tbody>
                            @foreach ( $products as $key => $item )
                                <tr>
                                    <td>{{ $products->firstitem() + $key }}</td>
                                    <td>{{ $item->product_code ?? '' }}</td>
                                    <td>{{ $item->product_name ?? '' }}</td>
                                    <td>{{ $item->category->name ?? '' }}</td>
                                    <td>{{ $item->selling_price ?? '' }}</td>
                                    <td>{{ $item->product_qty ?? '' }}</td>
                                    <td><img src="{{ asset($item->thmbnail) }}" alt="" width="80px"></td>
                                    <td>{{ $item->created_at->diffForHumans() }}</td>
                                    <td class="text-center">
                                        <a href="{{  route('product.edit', $item->id ) }}" class="btn btn-primary">Edit</a>
                                        <form action="{{ route('product.destroy', $item->id) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Trash</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                       </tbody>
                   </table>
                  {{ $products->links() }}
                   </div>
               </div>

               <!-- /.box-body -->
             </div>
             <!-- /.box -->
           </div>
    </div>
</section>
@endsection
