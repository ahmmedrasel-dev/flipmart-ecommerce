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
                        <h3 class="box-title">All Attribute Value</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example5" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="5">SL</th>
                                        <th>Name</th>
                                        <th>Value</th>
                                        <th>Created</th>
                                        <th width="130" style="text-align: center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attributevalue as $key => $item)
                                        <tr>
                                            <td>{{ $attributevalue->firstItem() + $key }}</td>
                                            <td>{{ $item->attributeName->attribute_name }}</td>
                                            <td>{{ $item->value }}</td>
                                            <td>{{ $item->created_at->diffForHumans() }}</td>
                                            <td>
                                                <a href="#"
                                                    class="btn btn-primary" id="delete">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $attributevalue->links() }}
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create Attribtue Value</h3>
                    </div>

                    <div class="box-body">
                        <form action="{{ route('attributeValue.store') }}" method="POST">
                            @csrf
                            <div class="from-group">
                                <h5>Attribute Name <span class="text-danger">*</span></h5>
                                <select name="attributeName_id" id="attributeName_id" class="form-control">
                                    <option value="" selected disabled>Select Name</option>
                                    @foreach ($attributeName as $item )
                                        <option value="{{ $item->id }}">{{ $item->attribute_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mt-5">
                                <h5>Attribute Value <span class="text-danger">*</span></h5>
                                <input type="text" id="attribute_value" name="attribute_value" class="form-control"
                                    value="{{ old('attribute_value') }}">
                                @error('attribute_value')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info" value="Save Value">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
