@extends('admin.contestant_list')
@section('contestant_list')
<table id="contestant_table" class="mt-0 mb-4 table">
    <tr>
      <th style="width: 6%">ID</th>
      <th>Contestant</th>
      <th>Email </th>
      <th> Art Entry </th>
      <th> Photography Enty  </th>
      <th> Action</th>
    </tr>
    @foreach ($datas as $data )
    <tr>
      
      <td>{{ $data->id }}</td>
      <td>{{ $data->contestant_name }}</td>
      <td>{{ $data->contestant_email }}</td>
      <td>
        
        @php
          $count = 0;    
          if($data->fullList){
            foreach ($data->fullList as $list ){
              if ($list->category_id == 1){
                $count = $count+1 ;
              }
            }
          }
        @endphp
        @if ($count)
        <a href="{{ route('contestant_details', ['id'=>$data->id]) }}">{{ $count }} out of 5 submitted</a>
        @endif
      </td>
      <td>
        @php
        $count2 = 0;    
        if($data->fullList){
          foreach ($data->fullList as $list ){
            if ($list->category_id == 2){
              $count2 = $count2+1 ;
            }
          }
        }
        @endphp
        @if ($count2)
        <a href="{{ route('contestant_details',['id'=>$data->id]) }}">{{ $count2 }} out of 5 submitted</a>
        @endif
      </td>
      <td>
        <a class="contestant_delete_modal" href="#" data-contestent_id={{$data->id}} data-toggle="modal" 
          data-target="#exampleModalCenter" style="color: red;"><i class="fa fa-trash" style="margin-right: 8px;" aria-hidden="true"></i>Delete</a>
      </td>
    </tr>
    @endforeach
  </table>
@stop