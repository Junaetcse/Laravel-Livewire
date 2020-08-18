<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contestant;
use App\Models\User;
use App\Models\Payment;
use App\Models\PhotoGallery;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    //
    public function contestantList(Request $request)
    {
        $list_type = $request->get('list');
        if($list_type){
            $datas = Contestant::with('shortList')->get();
            return \view('admin.short_list',\compact('datas','list_type'));
        }else{
            $datas = Contestant::with('fullList')->get();
            return \view('admin.full_list',\compact('datas','list_type'));
        }
    }

    public function contestantDetails($id)
    {
        $contestant  = Contestant::with('photoGallery')->find($id);
        return \view('admin.contestant_details',\compact('contestant'));
    }

    public function updatePhotoGallery(Request $request)
    {
        $Photo_gallery = PhotoGallery::where('file_name',$request->get('image_file'))->first();
        if($Photo_gallery){
            $Photo_gallery->shortlist = $request->get('shortlist') == "1" ? 0 : 1;
            $Photo_gallery->save();
        }
        return Redirect::back();
    }

    public function deletePhotoGallery(Request $request)
    {
        $Photo_gallery = PhotoGallery::where('file_name',$request->get('file_name'))->first();
        if($Photo_gallery){
            $Photo_gallery->delete();
        }
        return Redirect::back();
    }

    public function loginFrom(Request $request)
    {
        return \view('admin.login-from');
    }


    

    public function removedContestant(Request $request)
    {
        $contestant= Contestant::findOrFail($request->get('contestent_id'));
        if( $contestant){
            $payments = Payment::where('contestant_id',$contestant->id)->get();    
            if($payments){
                foreach($payments as $payment){
                    $payment->delete();
                }
            }
            
            $photoGallerys = PhotoGallery::where('contestant_id',$contestant->id)->get();    
            if($photoGallerys){
                foreach($photoGallerys as $photoGallery){
                    $photoGallery->delete();
                }
            }
            $name = $contestant->contestant_name;
           if($contestant->delete()){
               return Redirect::back()->with('message',"You have successfully removed ".$name." from contestant list");
           }
        }
    }


}
