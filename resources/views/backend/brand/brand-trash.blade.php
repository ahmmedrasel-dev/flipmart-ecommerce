@extends('backend.admin-master')
@section('b_active')
    active
@endsection
@section('b_subactive_trash')
    active
@endsection
@section('content')
<section class="content">
    <div class="row">
        <div class="col-12">

            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">All Brand Trashed</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">
                     <table id="example5" class="table table-bordered table-striped" style="width:100%">
                       <thead>
                           <tr>
                               <th width="5">SL</th>
                               <th>Name</th>
                               <th>Slug</th>
                               <th>Thumbnail</th>
                               <th>Created</th>
                               <th width="160" style="text-align: center">Action</th>
                           </tr>
                       </thead>
                       <tbody>
                            @foreach ( $brands_trash as $key => $item )
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->slug }}</td>
                                    <td><img style="width: 100px" src="{{ asset('backend-assets/upload-images/brand/'.$item->image) }}" alt="{{ $item->title }}"></td>
                                    <td>{{ $item->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{  route('brand.restore', $item->id ) }}" class="btn btn-success">Restore</a>
                                        <a href="{{ route('brand.delete', $item->id) }}" class="btn btn-danger" id="delete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                       </tbody>
                   </table>
                   </div>
               </div>
               <!-- /.box-body -->
             </div>
             <!-- /.box -->
           </div>
    </div>
</section>
@endsection
@section('footer_js')
<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('backend-assets/js/pages/data-table.js') }}"></script>
@endsection
