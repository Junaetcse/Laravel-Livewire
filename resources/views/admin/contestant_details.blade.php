@extends('admin.layout')
@section('content')

<section class="about-section text-center" style="padding-top: 25px;">
    <div class="container">
        <h2 class="my-0">GIFT OF SIGHT 2020 </h2>
        <h3 class="mt-0 mb-4" style="color: black;font-size: 20px;">ART AND PHOTOGRAPHY COMPETITION</h3>
        <div  class="mt-0" >
         <h3 style="color: black; "><span><b>Contestant:</b></span>  {{ $contestant->contestant_name }} </h3>
        </div>
        <div  class="mt-0 mb-4" >
         <h3 style="color: black; "><b>Email:</b>   <span>{{ $contestant->contestant_email }}</span></h3>
        </div>
        <section class="entry-showcase" style="padding: 2vh 0;">
            <div class="container">
                <h3 style="margin-bottom: 20px; color: black;">Art Entry</h3>
                <div class="row">
                    @php
                    $count = [];    
                    if($contestant->photoGallery){
                        foreach ($contestant->photoGallery as $list ){
                            if ($list->category_id == 1){
                                array_push($count, [$list->shortlist => $list->file_name]);
                            }
                        }
                    }
                    @endphp
                    @if(!empty($count))
                        @foreach ($count as $data)
                           @foreach($data as $k=>$v)
                                <div class="col-lg-6 mb-4">
                                    <div class="card p-2 mx-auto" style="max-width: 25rem;">
                                        <a href="/upload/gallery/{{$v}}" target="_blank"><img class="img-fluid" src="/upload/gallery/{{$v}}" class="card-img-top" alt="Art-Entry Image" style="height: 270px;width: 370px;"> </a>
                                        <div class="card-body text-center" style="padding: 10px;">
                                            <a href="{{ route('update_photo_gallery', array('shortlist' => $k,'image_file'=>$v)) }}" class="menu_list @if($k) shoertlisted_btn @endif">SHORTLIST</a> @if(!$k) | @endif 
                                            <a class="menu_list delete_modal" href="#" data-fime_name={{$v}} data-toggle="modal" data-target="#exampleModalCenter">DELETE</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    @endif
                </div>
                <h3 style="margin-bottom: 20px;color: black;">Photography Entry</h3>
                <div class="row">
                    @php
                    $count2 = [];    
                    if($contestant->photoGallery){
                        foreach ($contestant->photoGallery as $list ){
                            if ($list->category_id == 2){
                                array_push($count2,[$list->shortlist => $list->file_name]);
                            }
                        }
                    }
                    @endphp

                    @if(!empty($count2))
                        @foreach ($count2 as $data2)
                            @foreach($data2 as $k=>$v)
                                <div class="col-lg-6 mb-4">
                                    <div class="card p-2 mx-auto" style="max-width: 25rem;">
                                        <a href="/upload/gallery/{{$v}}" target="_blank"><img class="img-fluid" src="/upload/gallery/{{ $v }}" class="card-img-top" alt="Art-Entry Image" style="height: 270px;width: 370px;"> </a>
                                        <div class="card-body text-center" style="padding: 10px;">
                                            <a href="{{ route('update_photo_gallery', array('shortlist' => $k,'image_file'=>$v)) }}" class="menu_list @if($k) shoertlisted_btn @endif">SHORTLIST</a> 
                                            @if(!$k) | @endif <a class="menu_list delete_modal" href="#" data-fime_name={{$v}} data-toggle="modal" data-target="#exampleModalCenter">DELETE</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    @endif
                </div>

            </div>
        </section>
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary" style="margin-bottom: 20px;margin-top: 20px;color: black;"><i class="fa fa-chevron-left" style="margin-right: 8px;" aria-hidden="true"></i>Back</a>

        <div class="modal fade " id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <form action="{{route('delete.photo_gallery')}}" method="POST">
                    @csrf
                    <div class="modal-body" style="height: 200px; background: red;">
                        <p style="padding: 35px; color:white;"> <b>Are you sure you want to delete <span id="image_value"></span>? </b></p>
                        <input type="hidden" name="file_name" id="file_name_id" value="">
                        <button type="submit" class="btn btn-primary" style=" background: red; border: none; ">YES</button> |
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background: red; border: none; ">NO</button> 
                    </div>
                </form>
              </div>
            </div>
          </div>
    </div>
  </section>
  
  @stop