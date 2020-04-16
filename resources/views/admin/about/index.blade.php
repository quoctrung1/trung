@extends('admin.layout.main')
@section('title','Index')
@section('content')
<div class="page-header">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="">Admin</a></li>
		<li class="breadcrumb-item active">About</li>
	</ol>
	<!-- <h1 style=" font-family: 'Open Sans', sans-serif; font-size: 50px; font-weight: 300; text-transform: uppercase;">About</h1> -->
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
				<a href="{{route('about.create')}}" class="btn btn-outline-success mb-2 mt-2">Create New</a>
			</div>
			<div class="col-md-3">
				<form action="">
					<div class="form-group">
						{{Form::text('name','',['class'=>'form-control','placeholder'=>'Search ...'])}}
					</div>
				</form>
			</div>
		</div>
		<table class="table table-striped table-sm">
			<thead>
				<tr>
					<th >STT</th>
					<th >Title</th>
					<th >Phone Number</th>
					<th >Content</th>
					<th >Email</th>
					<th >Logo</th>
					<th colspan="5">Action</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					@foreach($abouts as $key => $about)
					<tr>
						<td >{{ ++$key }}</td>
						<td><a href="{{route('about.show',$about->id)}}" style="text-decoration: none;color: black;">{{$about->title}}</td>
						<td>{{$about->phone}}</td>
						<td>{{$about->content}}</td>
						<td>{{$about->email}}</td>
						<td><img src="{{ asset('images/'.$about->logo) }}" width="80" height=></img>
						</td>
						<td colspan="5">
							{{Form::open(['route' => ['about.destroy', $about->id], 'method' => 'DELETE'])}}
							{{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'text-danger border-0 btn-link float-left'] )  }} 
							{{ Form::close() }}
							<a href="{{route('about.edit',$about->id)}}" class="ml-1"><i class="fa fa-edit "></i></a>
						</td>
					</tr>
					@endforeach
				</tr>
			</tbody>
		</table>
	</div>
</div>
@endsection