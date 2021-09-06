@extends('backend.admin-master')
@section('subsubca_active')
    active
@endsection
@section('subsubca_subactive')
    active
@endsection
@section('content')
<section class="content">
    <div class="row">
        <div class="col-12">

            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">All Sub-Subcategory</h3>
                 <a href="{{ route('subsubcategory.create') }}" class="btn btn-primary float-right">Create</a>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">
                     <table id="example5" class="table table-bordered table-striped" style="width:100%">
                       <thead>
                           <tr>
                               <th width="5">SL</th>
                               <th>Name</th>
                               <th>Subategory</th>
                               <th>Slug</th>
                               <th>Created</th>
                               <th width="190" style="text-align: center">Action</th>
                           </tr>
                       </thead>
                       <tbody>
                            @foreach ( $subsubcategories as $key => $item )
                                <tr>
                                    <td>{{ $subsubcategories->firstitem() + $key }}</td>
                                    <td>{{ $item->name ?? '' }}</td>
                                    <td>{{ $item->subcategory->name ?? '' }}</td>
                                    <td>{{ $item->slug ?? '' }}</td>
                                    <td>{{ $item->created_at->diffForHumans() }}</td>
                                    <td class="text-center">
                                        <a href="{{  route('subsubcategory.edit', $item->id ) }}" class="btn btn-primary">Edit</a>
                                        <form action="{{ route('subsubcategory.destroy', $item->id) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                       </tbody>
                   </table>
                  {{ $subsubcategories->links() }}
                   </div>
               </div>

               <!-- /.box-body -->
             </div>
             <!-- /.box -->
           </div>
    </div>
</section>
@endsection
