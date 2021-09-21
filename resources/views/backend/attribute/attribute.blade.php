@extends('backend.admin-master')
@section('ecom_active')
    active
@endsection
@section('attribute_active')
    active
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">All Attribute Name</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example5" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="5">SL</th>
                                        <th>Name</th>
                                        <th>Created</th>
                                        <th width="130" style="text-align: center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attributes as $key => $item)
                                        <tr>
                                            <td>{{ $attributes->firstItem() + $key }}</td>
                                            <td>{{ $item->attribute_name }}</td>
                                            <td>{{ $item->created_at->diffForHumans() }}</td>
                                            <td>
                                                <a href="{{ route('attribute.delete', $item->id) }}"
                                                    class="btn btn-primary" id="delete">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $attributes->links() }}
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create Attribtue</h3>
                    </div>

                    <div class="box-body">
                        <form action="{{ route('attribute.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <h5>Attribute Name <span class="text-danger">*</span></h5>
                                <input type="text" id="attribute_name" name="attribute_name" class="form-control"
                                    value="{{ old('attribute_name') }}">
                                @error('attribute_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info" value="Save Attribute">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
