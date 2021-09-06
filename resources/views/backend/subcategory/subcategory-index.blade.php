@extends('backend.admin-master')
@section('subca_active')
    active
@endsection
@section('subca_subactive')
    active
@endsection
@section('content')
<section class="content">
    <div class="row">
        <div class="col-12">

            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">All Subcategory</h3>
                 <a href="{{ route('subcategory.create') }}" class="btn btn-primary float-right">Create Subcategory</a>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">
                     <table id="example5" class="table table-bordered table-striped" style="width:100%">
                       <thead>
                           <tr>
                               <th width="5">SL</th>
                               <th>Name</th>
                               <th>Category</th>
                               <th>Slug</th>
                               <th>Created</th>
                               <th width="190" style="text-align: center">Action</th>
                           </tr>
                       </thead>
                       <tbody>
                            @foreach ( $subcategories as $key => $item )
                                <tr>
                                    <td>{{ $subcategories->firstitem() + $key }}</td>
                                    <td>{{ $item->name ?? '' }}</td>
                                    <td>{{ $item->category->name ?? '' }}</td>
                                    <td>{{ $item->slug ?? '' }}</td>
                                    <td>{{ $item->created_at->diffForHumans() }}</td>
                                    <td class="text-center">
                                        <a href="{{  route('subcategory.edit', $item->id ) }}" class="btn btn-primary">Edit</a>
                                        <form action="{{ route('subcategory.destroy', $item->id) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" value="Trash" class="btn btn-danger">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                       </tbody>
                   </table>
                  {{ $subcategories->links() }}
                   </div>
               </div>

               <!-- /.box-body -->
             </div>
             <!-- /.box -->
           </div>
    </div>
</section>
@endsection
