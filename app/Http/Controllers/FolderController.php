<?php

namespace App\Http\Controllers;

use App\Models\UserFolder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use File;

class FolderController extends Controller
{
    public function viewAddFolder($IdParentFolder){

        session()->forget('menu');
        session()->put('menu', 'addMainFolder');
        return view('admin.addFolder',compact('IdParentFolder'));

    }
    public function submitAddfolder(Request $request,$IdParentFolder){
        $validator = Validator::make($request->all(), [
            'name'=>'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        }else{
            $userId=Auth::id();
            $folderName=$request->name;
            if ($IdParentFolder == 0){
                $path = public_path().'/' . $folderName;
                File::makeDirectory($path, $mode = 0777, true, true);
                UserFolder::create([
                    'name' => $folderName,
                    'user_id' => $userId,
                    'path' => $path,
                ]);
                return redirect(route('home'));

            }else{
                $parentFolder=UserFolder::findOrFail($IdParentFolder);
                $path=$parentFolder->path.'/' . $folderName;
                File::makeDirectory($path, $mode = 0777, true, true);
                UserFolder::create([
                    'name' => $folderName,
                    'user_id' => $userId,
                    'path' => $path,
                    'idParentFolder' => $IdParentFolder,
                ]);
                return redirect(route('viewFolder',$IdParentFolder));

            }
        }
    }

    public function viewFolder($idFolder){
        $folderData=UserFolder::findOrFail($idFolder);
        $allFoldersInThisFolder=UserFolder::where('idParentFolder',$idFolder)->paginate(5);

        $allFiles=\App\Models\File::where('folder_id',$idFolder)->paginate(5);
        return view('admin.folderData',compact('allFoldersInThisFolder','folderData','allFiles'));
    }

    public function addNewFile($IdParentFolder){
        return view('admin.addFile',compact('IdParentFolder'));
    }
    public function submitAddNewFile(Request $request,$IdParentFolder){
        $validator = Validator::make($request->all(), [
            'file'=>'required | file',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        }else{
            $folderData=UserFolder::findOrFail($IdParentFolder);
            $folderPath=$folderData->path;
            $userId=Auth::id();
            $file   = $request->file('file');
            $fileMime=$file->getClientMimeType();
            $fileExtension=$file->getClientOriginalExtension();
            $fileName=$file->getClientOriginalName();
            $fileName = pathinfo($fileName,PATHINFO_FILENAME);
            $new_name =$fileName."(".rand().")";
            $fileSize = $file->getSize();
            $filePath=$folderPath.'/'.$new_name.'.'.$fileExtension;
            $file->move($folderPath, $new_name.'.'.$fileExtension);
            \App\Models\File::create([
                'user_id'=>$userId,
                'folder_id'=>$IdParentFolder,
                'name'=>$new_name,
                'size'=>$fileSize,
                'path'=>$filePath,
                'extension'=>$fileExtension,
                'mimeType'=>$fileMime,
            ]);
            return redirect(route('viewFolder',$IdParentFolder));
        }
    }

    public function downloadFile($idFile){
        $file=\App\Models\File::findOrFail($idFile);
        $filePath=$file->path;
        $fileMime=$file->mimeType;
        $fileName=$file->name.'.'.$file->extension;
        $headers = array(
            'Content-Type: '.$fileMime,
        );
        return Response::download($filePath, $fileName, $headers);
    }

}
