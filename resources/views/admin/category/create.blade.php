@extends('admin.layout.main')
@section('title','Create Category')
@section('content')
<div class="page-header">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="">Admin</a></li>
		<li class="breadcrumb-item" ><a href="{{route('category.index')}}" title="Danh mục">Category</a></li>
		<li class="breadcrumb-item active">Create</li>
	</ol>
</div>
<div class="card mt-3">
	<div class="card-body ">
		{{ Form::open(['url' => 'admin/category', 'method' => 'post']) }}
			<div class="form-group col-md-12">
				{{ Form::label('name','Name : ')}}
				{{ Form::text('name','',['class'=>'form-control col-md-8'])}}
				<span class="text-danger">{{ $errors->first('name')}}</span>
			</div>
			<div class="form-group col-md-12">
				{{ Form::label('description','Description : ')}}
				<br>
				<textarea name=description id="editor" cols="" rows="10" class="col-md-8"></textarea>
				<br>
				<span class="text-danger">{{ $errors->first('description')}}</span>
			</div>	
			<div class="form-group col-md-12">
			{{ Form::submit('Save',['class'=>'btn btn-success']) }}
			<a class="btn btn-danger" href="{{route('category.index')}}">Back</a>
		</div>
		{{ Form::close() }}
	</div>
</div>
@endsection