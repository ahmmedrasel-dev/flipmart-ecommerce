@extends('backend.admin-master')
@section('ca_active')
    active
@endsection
@section('ca_subactive')
    active
@endsection
@section('content')
<section class="content">
    <div class="row">
        <div class="col-12">

            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">All Category</h3>
                 <a href="{{ route('category.create') }}" class="btn btn-primary float-right">Create Category</a>
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
                               <th width="190" style="text-align: center">Action</th>
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
                                        @if ($item->id == 1)
                                            <button disabled="disabled" class="btn btn-info">Not Allow</button>
                                        @else
                                            <a href="{{  route('category.edit', $item->id ) }}" class="btn btn-primary">Edit</a>
                                            <form action="{{ route('category.destroy', $item->id) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <input type="submit" value="Delete" class="btn btn-danger">
                                            </form>
                                        @endif
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
