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
          $count = [];    
          if($data->shortList){
            foreach ($data->shortList as $list ){
              if ($list->category_id == 1){
                array_push($count, $list->file_name);
              }
            }
          }
        @endphp
        @if(!empty($count))
            @foreach ($count as $img)
              <a href="{{ route('contestant_details', ['id'=>$data->id]) }}"> <img src="/upload/gallery/{{ $img }}" style=" height: 20px;width: 30px; " /></a>
            @endforeach
        @endif
      </td>
      <td>
        @php
        $count2 = [];    
        if($data->shortList){
          foreach ($data->shortList as $list ){
            if ($list->category_id == 2){
                array_push($count2, $list->file_name);
            }
          }
        }
      @endphp
        @if(!empty($count2))
            @foreach ($count2 as $img)
               <a href="{{ route('contestant_details', ['id'=>$data->id]) }}"> <img src="/upload/gallery/{{ $img }}" style=" height: 20px;width: 30px; " /></a>
            @endforeach
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