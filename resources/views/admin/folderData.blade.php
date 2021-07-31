@extends('admin.index')
@section('title', 'FileManager | Folder Data')
@section('style')
    <style>
        .rowStyle{
            font-weight: normal;
        }
        .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover{
            background-color: #26b1b0 ;
            border: none;
        }
        .btn{
            border: none;
        }
        .form-group {
            margin-bottom: 10px;
        }

    </style>
@endsection

@section('content')
    <div class="content">
        <div class="box-body">
            <div class="row">
                <div class="col-md-2 col-sm-2 col-xs-12 p-l-0 p-r-0" style="float: left; padding-bottom: 10px;">
                    @if($folderData->idParentFolder != null)
                        <a  class="btn btn-info" style="background-color: #4b646f" href="{{route('viewFolder',$folderData->idParentFolder)}}" >Back</a>

                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-sm-2 col-xs-12 p-l-0 p-r-0" style="float: left; padding-bottom: 10px;">
                    <a  class="btn btn-info" style="background-color: #4b646f" href="{{route('newMainFolder',$folderData->id)}}" >Add New Folder Here</a>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-12 p-l-0 p-r-0" style="float: left; padding-bottom: 10px;">
                    <a  class="btn btn-info" style="background-color: #4b646f" href="{{route('NewFile',$folderData->id)}}" >Add New File Here</a>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 p-l-0 p-r-0" style="float: left; padding-bottom: 8px;">
                <label>folder name: {{$folderData->name}} </label>

                </div>
                <div class="col-md-5 col-sm-5 col-xs-12 p-l-0 p-r-0" style="float: left; padding-bottom: 8px;">
                    <label>folder path: {{$folderData->path}} </label>
                </div>

            </div>
        </div>
        <div class="box table-responsive "style="border: none;">
            <table  class="table table-striped table-hover table-bordered " >
                <thead style="background: #26b1b0">
                <tr style="color: white!important;">
                    <th>Folde Name</th>
                    <th>Open Folder</th>
                </tr>
                </thead>
                <tbody>
                @foreach($allFoldersInThisFolder as $folder)
                    <tr>
                        <th class="rowStyle">{{$folder->name}}</th>
                        <th class="rowStyle"><a href="{{route('viewFolder',$folder->id)}}" style="background-color: #26b1b0" class="btn btn-xs btn-info" ><i class="fa fa-eye"></i> Open Folder</a></th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


        <div class="box-body">
            <div class="row">
                <div class="col-md-8 col-sm-6 col-xs-12 p-l-0 p-r-0" style="float: left; padding:0;padding-left: 6px;">
                  </div>
                <div class="col-md-4 col-sm-6 col-xs-12 p-l-0 p-r-0 " style="float: right;margin-top: -20px;padding-right: 6px;">
                    {!! $allFoldersInThisFolder->links() !!}

                </div>
            </div>
        </div>



        <div class="box table-responsive "style="border: none;">
            <table  class="table table-striped table-hover table-bordered " >
                <thead style="background: #26b1b0">
                <tr style="color: white!important;">
                    <th>File Name</th>
                    <th>File Size</th>
                    <th>File Extension</th>
                    <th>Download</th>
                </tr>
                </thead>
                <tbody>
                @foreach($allFiles as $file)
                    <tr>
                        <th class="rowStyle">{{$file->name}}</th>
                        <th class="rowStyle">{{$file->size}}</th>
                        <th class="rowStyle">{{$file->extension}}</th>
                        <th class="rowStyle"><a href="{{route('downloadFile',$file->id)}}" style="background-color: #26b1b0" class="btn btn-xs btn-info" ><i class="fa fa-eye"></i> Domnload This File</a></th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


        <div class="box-body">
            <div class="row">
                <div class="col-md-8 col-sm-6 col-xs-12 p-l-0 p-r-0" style="float: left; padding:0;padding-left: 6px;">
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12 p-l-0 p-r-0 " style="float: right;margin-top: -20px;padding-right: 6px;">
                    {!! $allFiles->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
