@extends('admin.index')
@section('title', 'FileManager | Add Folder')
@section('style')
    <style>
        .btn{
            border: none;
        }
    </style>
@endsection
@section('content')
    <br>
    <div class="form-content">
        <form action="{{route('addNewFile',$IdParentFolder)}}"  method="post" class="mb-3 pb-2" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="file">File</label>
                <input type="file" class="form-control" id="file" name="file"  >
            </div>
            <div class="row ">
                <div class="form-group col-md-12 ">
                    <button type="submit" class="btn btn-primary" style="background-color: #26b1b0">Save</button >
                </div>
            </div>
        </form>

    </div>
@endsection
