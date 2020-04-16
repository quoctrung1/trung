@extends('admin.layout.main')
@section('title','Category')
@section('content')
<div class="page-header">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="">Admin</a></li>
		<li class="breadcrumb-item active" >Category</li>
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
				<a href="{{route('category.create')}}" class="btn btn-outline-success mb-2 mt-2">Create New</a>
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
					<th >Name</th>
					<th>Slug</th>
					<th colspan="5">#</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					@foreach($categories as $key => $category)
					<tr>
						<td >{{ ++$key }}</td>
						<td ><a href="{{route('category.show',$category->id)}}" style="text-decoration: none;color: black;">{{ $category->name }}</a> </td>
						
						<td>{{$category->slug}}</td>
						<td colspan="5">
							{{Form::open(['route' => ['category.destroy', $category->id], 'method' => 'DELETE'])}}
							{{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'text-danger border-0 btn-link float-left'] )  }} 
							{{ Form::close() }}
							<a href="{{route('category.edit',$category->id)}}" class="ml-1"><i class="fa fa-edit "></i></a>
						</td>
					</tr>
					@endforeach
				</tr>
			</tbody>
		</table>
	</div>
</div>
@endsection