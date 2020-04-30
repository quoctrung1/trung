@extends('admin.layout.main')
@section('title','Brand')
@section('content')
<div class="page-header">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="">Admin</a></li>
		<li class="breadcrumb-item active" >Brand</li>
	</ol>
</div>
<div class="row ml-1 col-md-12">
	@if (Session::has('message'))
	<p class="alert alert-success">{{ Session::get('message')}}</p> 
	@elseif(Session::has('err'))    
	<p class="alert alert-danger">{{ Session::get('err')}}</p>
	@endif
</div>
<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-md-9">
				<a href="{{route('brand.create')}}" class="btn btn-outline-success mb-2 mt-2">Create New</a>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					{{ Form::open(['route' => ['brand.index' ],'method' => 'get']) }}
					{{ Form::text('seachname','',['class'=>'form-control ','style'=>'float: left','placeholder'=>'Search Name']) }}
				</div>
				{{ Form::close() }}	
			</div>
		</div>
		<table class="table table-striped table-sm">
			<thead>
				<tr>
					<th >STT</th>
					<th >Name</th>
					<th>Slug</th>
					<th colspan="5">#</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					@foreach($brands as $key => $brand)
					<tr>
						<td >{{ ++$key }}</td>
						<td ><a href="{{route('brand.show',$brand->id)}}" style="text-decoration: none;color: black;">{{ $brand->name }}</a> </td>
						<td>{{$brand->slug}}</td>
						<td colspan="5">
							<!-- Button trigger modal -->
							<!-- Tạo data-id để chưa giá trị id -->
							<button type="button" class="fa fa-trash deleteUser text-danger btn" data-id="{{$brand->id}}" data-toggle="modal" data-target="#Modal" style="width: 40px; padding: 7px 5px;">
							</button>
							<a href="{{route('brand.edit',$brand->id)}}" class="ml-1 btn" style="width:40px; padding: 5px;"><i class="fa fa-edit "></i></a>
						</td>
					</tr>
					@endforeach
				</tr>
			</tbody>
		</table>
	</div>
</div>
{{Form::open(['route' => 'brand_delete_modal', 'method' => 'POST', 'class'=>'col-md-5'])}}
{{ method_field('DELETE') }}
{{ csrf_field() }}
<!-- Modal -->
@include('admin.Modal.delete')
{{ Form::close() }}
@endsection