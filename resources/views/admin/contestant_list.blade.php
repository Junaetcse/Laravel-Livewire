@extends('admin.layout')
@section('content')

<section class="about-section text-center" style="padding-top: 25px;">
    <div class="container">
        <h2 class="my-0">GIFT OF SIGHT 2020 </h2>
        <h3 class="mt-0 mb-4">ART AND PHOTOGRAPHY COMPETITION</h3>
        <div  class="mt-0 mb-4" >
          @if ($list_type == 1)
            <a href="{{ route('contestant_list', array('list' => 0)) }}" class="menu_list">Full List</a> | <a class="menu_list" href="{{ route('contestant_list', array('list' => 1)) }}"><b><u>Short List</u></b></a>
          @else 
            <a href="{{ route('contestant_list', array('list' => 0)) }}" class="menu_list"><b><u>Full List</u></b></a> | <a href="{{ route('contestant_list', array('list' => 1)) }}" class="menu_list">Short List</a>
          @endif
        </div>
        <div class="row" style="margin: auto; width: 50%;">

          @if(Session::has('message'))
          <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
          @endif
        </div>
        <div class="table-responsive">
        @yield('contestant_list')  
        </div>
    </div>
    <div class="modal fade " id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <form action="{{route('removed_contestant')}}" method="POST">
              @csrf
              <div class="modal-body" style="height: 200px; background: red;">
                  <p style="padding: 35px; color:white;"> <b>Are you sure ? </b></p>
                  <input type="hidden" name="contestent_id" id="js_contestent_id" value="">
                  <button type="submit" class="btn btn-primary" style=" background: red; border: none; ">YES</button> |
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background: red; border: none; ">NO</button> 
              </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  
  @stop