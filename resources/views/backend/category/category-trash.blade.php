@extends('backend.admin-master')
@section('ca_active')
    active
@endsection
@section('ca_subactive_trash')
    active
@endsection
@section('content')
<section class="content">
    <div class="row">
        <div class="col-12">

            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">All Category Trash</h3>
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
                               <th width="100" class="text-center">Thumbnail</th>
                               <th>Created</th>
                               <th width="200" style="text-align: center">Action</th>
                           </tr>
                       </thead>
                       <tbody>
                            @foreach ( $categories as $key => $item )
                                <tr>
                                    <td>{{ $categories->firstitem() + $key }}</td>
                                    <td>{{ $item->name ?? '' }}</td>
                                    <td>{{ $item->slug ?? '' }}</td>
                                    <td class="text-center"><img style="width: 50px" src="{{ !is_null($item->image) ? asset($item->image) :  asset('backend-assets/upload-images/default_img.png') }}" alt=""></td>
                                    <td>{{ $item->created_at->diffForHumans() }}</td>
                                    <td class="text-center">
                                        <a href="{{  route('category.restore', $item->id ) }}" class="btn btn-success">Restore</a>
                                        <a href="{{ route('category.delete', $item->id) }}" class="btn btn-danger" id="delete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                       </tbody>
                   </table>
                  {{ $categories->links() }}
                   </div>
               </div>

               <!-- /.box-body -->
             </div>
             <!-- /.box -->
           </div>
    </div>
</section>
@endsection
