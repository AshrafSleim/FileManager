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
        <form action="{{route('addMainFolder',$IdParentFolder)}}"  method="post" class="mb-3 pb-2" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Folder Name</label>
                <input type="text" class="form-control" id="name" name="name" value="" required>
            </div>
            <div class="row ">
                <div class="form-group col-md-12 ">
                    <button type="submit" class="btn btn-primary" style="background-color: #26b1b0">Save</button >
                </div>
            </div>
        </form>

    </div>
@endsection
