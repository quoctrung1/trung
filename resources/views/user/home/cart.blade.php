@extends('user.layout.main')
@section('title','Cart')
@section('content')
<div id="sidr">
	<nav>
		<ul>
			<li>
				<a href="/">HOME</a>
			</li>
			<li>
				<a href="/products">Products</i></a>
			</li>
			<li>
				<a href="">About</a>
			</li>
			<li>
				<a href="">Contact</a>
			</li>
			<li>
				<a href="">Sale</a>
			</li>
		</ul>						
	</nav>
</div>
<!--MOBILE MENU END -->
<!--MAIN MENU AREA  START-->
<div class="main_menu_area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 ">
				<!--DESKTOP MENU START -->
				<div class="mainmenu">
					<nav>
						<ul id="nav">
							<li>
								<a href="/">HOME </a>
							</li>
							<li>
								<a href="/products">Products</a>
							</li>
							<li>
								<a href="">About</a>
							</li>
							<li>
								<a href="">Contact</a>
							</li>
							<li >
								<a href="">Sale</a>
							</li>
						</ul>						
					</nav>
				</div>
				<!--DESKTOP MENU END -->
			</div>
		</div>
	</div>
</div>
<!--BREADCRUMB AREA START -->
<div class="breadcrumb_area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">	
				<div class="breadcrumb-row">
					<h3 class="breadcrumb"><a href="/" class="home">Home</a><span>/</span>Shopping cart</h3>
				</div>
			</div>
		</div>
	</div>
</div>
<!--BREADCRUMB AREA END -->
<!--page-checkout AREA START -->
<div class="page-checkout_area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="checkout-breadcrumb">
					<a href="shopping-cart.html">
						<div class="title-cart">
							<span>1</span>
							<p>Shopping Cart</p>
						</div>
					</a>
					<a href="checkout.html">
						<div class="title-checkout">
							<span>2</span>
							<p>Checkout details</p>
						</div>
					</a>
					<div class="title-thankyou">
						<span>3</span>
						<p>Order Complete</p>
					</div>
				</div>
				<div class="cart-wrapper table-responsive">
					@if(session('success'))
					<div class="alert alert-success">
						{{ session('success') }}
					</div>
					@endif
					<table class="shop_table cart ">
						<thead>
							<tr>
								<th colspan="3" class="product-name">Product</th>
								<th class="product-price">Price</th>
								<th class="product-quantity">Quantity</th>
								<th class="product-subtotal">Total</th>
							</tr>
						</thead>
						<tbody>
							<?php $total = 0 ?>
							@if(session('cart'))
							@foreach(session('cart') as $id => $details)
							<?php $total += $details['price'] * $details['quantity'] ?>
							<tr class="cart_item">
								<td class="remove-product col-md-1">
									<button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><span class="icon-close"></span></button>
									<button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"><i class="fa fa-refresh"></i></button>
								</td>
								<td class="product-thumbnail col-md-3">
									<?php  $image = explode(',',$details['image']);	?>
									<a href="{{route('products.show',$details['id'])}}"><img width="114" height="130" alt="04" class="attachment-shop_thumbnail wp-post-image" src="{{asset('images/'.$image[0])}}"></a>
								</td>
								<td class="product-name">
									<a href="#">{{ $details['name'] }}</a>					
								</td>
								<td class="product-price col-md-1">
									<span class="amount">{{ $details['price'] }}$</span>					
								</td>
								<td class="product-quantity col-md-1">
									<div class="quantity"><input type="number" min="1" max="20" class=" form-control" title="Qty" value="{{$details['quantity']}}" id="product_quantity" style="width: 50px;"></div>
								</td>
								<td class="product-subtotal col-md-1">
									<span class="amount">{{$details['price'] * $details['quantity']}}$</span>					
								</td>
							</tr>
							@endforeach
							@endif
						</tbody>
					</table>
				</div>
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 ">
						<div class="cart_totals">
							<h2>Cart Totals</h2>
							<div class="total_table">
								<table class="table-responsive">
									<tbody>
										<tr class="cart-subtotal">
											<th>Subtotal</th>
											<td><span class="amount">{{$total}}</span></td>
										</tr>
										<tr class="shipping">
											<th>Shipping</th>
											<td>Free Shipping</td>
										</tr>
										<tr class="order-total">
											<th>Total</th>
											<td><strong><span class="amount">$80.00</span></strong> </td>
										</tr>
									</tbody>
								</table>
								<div class="submit_crt">
									<input type="submit" class="proceed_chack" value="Proceed to Checkout" />	
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<!--page-checkout AREA END -->
@foreach($abouts as $key => $about)
<input type="hidden" value="{{$about->title}}" id="titlevalue">
<input type="hidden" value="{{$about->name}}" id="namevalue">
<input type="hidden" value="{{$about->address}}" id="addressvalue">
<input type="hidden" value="{{$about->email}}" id="emailvalue">
<input type="hidden" value="{{$about->phone}}" id="phonevalue">
<input type="hidden" value="{{asset('images/'.$about->logo)}}" id="logovalue">
@endforeach
<script src="{{asset('client/js/setabout.js')}}"></script>
<script type="text/javascript">
	$(".update-cart").click(function (e) {
		e.preventDefault();
		var ele = $(this);
		var quantity = $("#product_quantity").val();
		$.ajax({
			url: '{{ url('update-cart') }}',
			method: "patch",
			data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: quantity},
			success: function (response) {
				window.location.reload();
			}
		});
	});
	$(".remove-from-cart").click(function (e) {
		e.preventDefault();
		var ele = $(this);
		if(confirm("Are you sure")) {
			$.ajax({
				url: '{{ url('remove-from-cart') }}',
				method: "DELETE",
				data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
				success: function (response) {
					window.location.reload();
				}
			});
		}
	});
</script>
@endsection