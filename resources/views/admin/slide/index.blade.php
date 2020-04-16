@extends('admin.layout.main')
@section('title'.'Slide')
@section('content')
<div class="page-header">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="">Admin</a></li>
		<li class="breadcrumb-item active">Slide</li>
	</ol>
</div>
<div class="row ml-1">
	@if (Session::has('message'))
	<p class="alert alert-success">{{ Session::get('message')}}</p> 
	@elseif(Session::has('err'))    
	<p class="alert alert-danger">{{ Session::get('err')}}</p>
	@endif
</div>
<div class="card">
	
	<div class="card-body ">
		<div class="row">
			<div class="col-md-9">
				<a href="{{route('slide.create')}}" class="btn btn-outline-success mb-2 mt-2">Create New</a>
			</div>
			<div class="col-md-3">
				<form action="">
					<div class="form-group">
						{{Form::text('name','',['class'=>'form-control','placeholder'=>'Search ... '])}}
					</div>
				</form>
			</div>
		</div>
		<table class="table table-striped table-sm">
		<thead>
			<tr>
				<th >STT</th>
				<th >Link</th>
				<th >Url img</th>
				<th >Display order</th>
				<th colspan="5">Action</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				@foreach($slides as $key => $slides)
				<tr>
					<td >{{ ++$key }}</td>
					<td>{{$slides->link}}</td>
					<td><img src="{{ asset('images/'.$slides->url_img) }}" width="80" height=></img>
						</td>
					<td>{{$slides->display_order}}</td>
					<td colspan="5">
						{{Form::open(['route' => ['slide.destroy', $slides->id], 'method' => 'DELETE'])}}
						{{ Form::button('<i class="fa fa-trash text-danger " ></i>', ['type' => 'submit', 'class' => 'text-danger border-0 btn-link float-left'] )  }} 
						{{ Form::close() }}
						<a href="{{route('slide.edit',$slides->id)}}" class="ml-1"><i class="fa fa-edit "></i></a></a>
					</td>
				</tr>
				@endforeach
			</tr>
		</tbody>
	</table>
	</div>
</div>
@endsection