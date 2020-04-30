@extends('admin.layout.main')
@section('title','Create Product')
@section('content')
<div class="page-header">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="">Admin</a></li>
		<li class="breadcrumb-item" ><a href="{{route('product.index')}}" title="Sản phẩm">Product</a></li>
		<li class="breadcrumb-item active">Create</li>
	</ol>
</div>
<div class="card">
	<div class="card-body">
		{{ Form::open(['url' => 'admin/product', 'method' => 'post','enctype '=>'multipart/form-data']) }}
		<div class="row form-group">
			<div class="col-md-8">
				<div class="form-group">
					<h3 class="text-center">Product</h3>
				</div>
				<div class="form-group">
					{{ Form::label('Product Code : ')}}
					{{ Form::text('product_code',uniqid(),['class'=>'form-control', 'readonly'=>'readonly'])}}
					<span class="text-danger">{{ $errors->first('product_code')}}</span>
				</div>
				<div class="form-group">
					{{ Form::label('Product name : ')}}
					{{ Form::text('name','',['class'=>'form-control'])}}
					<span class="text-danger">{{ $errors->first('name')}}</span>
				</div>
				<div class="form-group">
					{{ Form::label('Descriptione : ')}}
						<br>
						{{ Form::textarea('description','',['id'=>'editor'])}}
						<br>
					<span class="text-danger">{{ $errors->first('description')}}</span>
				</div>
				<div class="form-group">
					{{ Form::label('Image:') }} <br/>
					{{ Form::file('image[]',['class' => 'form-control', 'id' => 'filename','multiple']) }}
					<span class="text-danger">{{ $errors->first('image')}}<br> </span>
				</div>	
				<div class="form-group">
					{{ Form::label('Price : ')}}
					{{ Form::number('price','',['class'=>'form-control'])}}
					<span class="text-danger">{{ $errors->first('price')}}</span>
				</div>
				<div class="form-group">
					{{ Form::label('Promotion(%) : ')}}
					{{ Form::number('promotion',0,['class'=>'form-control', 'min'=>'0', 'max'=>'99'])}}
					<span class="text-danger">{{ $errors->first('promotion')}}</span>
				</div>
				<div class="form-group">
					{{Form::label('Brand:')}}
					{{Form::select('brand_id',$brand,null,['class' => 'form-control','placeholder'=>'Choose a brand'])}}
					@if ($errors->has('brand_id'))
					<div class="text-danger">{{ $errors->first('brand_id') }}</div>
					@endif
				</div>
				<div class="form-group">
					{{Form::label('Category:')}}
					{{Form::select('category_id',$category,null,['class' => 'form-control','placeholder'=>'Choose a category'])}}
					@if ($errors->has('category_id'))
					<div class="text-danger">{{ $errors->first('category_id') }}</div>
					@endif
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<h3 class="text-center">Size & Color</h3>
				</div>
				<div class="form-group row ">
					<div class="col-md-12">
						{{ Form::label('Size: ')}}
						{{ Form::select('size[]', array('36' => '36','37' => '37','38' => '38','39' => '39','40' => '40','41' => '41','42' => '42','43' => '43'),null, ['class'=>'form-control size','multiple']) }}
						@if ($errors->has('selectsize'))	
						<div class="text-danger">{{ $errors->first('selectsize') }}</div>
						@endif
					</div>
					<div class="col-md-12">
						<button type="button" class="btn btn-success col-md-12" id="choosecolor" style="margin-top: 5px;"><b>Click to Choose Color</b></button>
						<span id="colorerr" class="text-danger"></span>
					</div>
					<input type="hidden" name="selectsize" id="selectsize" >
				</div>
				<div class="form-group row sizebox">
					<h4 class="text-center">Choose Color:</h4>
					<span id="selectcolor"></span>
				</div>
			</div>
		</div>
		<div class="form-group row">
			{{ Form::submit('Save',['class'=>'btn btn-success','id'=>'save']) }}
			<a class="btn btn-danger" href="{{route('product.index')}}">Back</a>
		</div>
		{{ Form::close() }}
	</div>
</div> 
<script type="text/javascript">
	$('#selectsize').val($('.size').val());
	$(".size").change(function(){
		$('#selectsize').val($(this).val());
	});
	$("#choosecolor").click(function(){
		$('.sizebox').html('<h4 class="text-center">Choose Color:</h4><span id="selectcolor"></span>');
		var sizes = $(".size").val();
		if (!sizes) {
			alert('Please choose a size!');
		}else{
			for (var i = 0; i < sizes.length; i++) { 
			    $('#selectcolor').append('<div class="col-md-12 form-group"><div class="col-md-3"><input type="text" value="'+sizes[i]+'" class=" form-control col-md-12" readonly></div>	<div class="col-md-9"><select id="color'+i+'" name="color'+i+'[]" class="form-control col-md-12 color" multiple><option value="black">BLACK</option><option value="white">WHITE</option><option value="blue">BLUE</option><option value="yellow">YELLOW</option><option value="gray">GRAY</option><option value="green">GREEN</option><option value="red">RED</option><option value="pink">PINK</option></select></div></div>');  
			}
			$('.color').select2();
		}
	});
	$(document).ready(function() {
	    $('.size').select2();
	    $('.color').select2();
	});
	$("#save").click(function(){
		var sizes = $(".size").val();
		var filenames = document.getElementById('filename'); 
		var result = true;
		if (sizes) {
			for (var i = 0; i < sizes.length; i++) {
				var changecolor = $('#color'+i).val()
				if (!changecolor) {
					$('#colorerr').html("Please choose color.");
					result = false;
				}
			}
		}
		if (!filenames) {
			result = false;
		}
		return result;
	});
</script>
@endsection