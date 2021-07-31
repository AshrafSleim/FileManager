@extends('admin.index')
@section('title', 'FileManager | Home')
@section('content')
        <div class="container mywithd">
            <div class="row">
                @foreach($userFolders as $folder)
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h2>{{$folder->name}}</h2>
                            </div>
                            <div class="icon">
                                <i class="fa fa-list-alt"></i>
                            </div>
                            <a href="{{route('viewFolder',$folder->id)}}" class="small-box-footer">Open This Folder <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
@endsection


