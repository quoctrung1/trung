<!--FOOTER AREA START -->
<div class="footer_area">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 ">	
				<div class="address">
					<a href="#"><img src="{{asset('client/img/logo-footer.png')}}" alt="" /></a>
					<ul>
						<li> 
							<i class="fa fa-paper-plane"></i>
							<div class="contact-text" style="margin-top: 6px;">
								<span id="addressfooter">81268 Bechole Road, Victory Lorem Ispuse, New York</span>
							</div>
						</li>
						<li> 
							<i class="fa fa-phone"></i>
							<div class="contact-text" style="margin-top: 6px;">
								<span>Phone: <span id="phonefooter"> (+80) 123 456 Fax: (+80) 123 456 789</span></span>
							</div>
						</li>
						<li class="flast"> 
							<i class="fa fa-envelope"></i>
							<div class="contact-text" style="margin-top: 6px;">
								<span>Email: <span id="emailfooter">Email: Contact@DevItems.us Website: www.DevItems.us</span></span>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">	
				<div class="block">
					<h2 class="ft_widget_title">CUSTOM BLOCK</h2>
					<ul>
						<li><a href="">About us</a></li>
						<li><a href="">Privacy Policy</a></li>
						<li><a href="">Terms &amp; Condition</a></li>
						<li><a href="">Best Seller</a></li>
						<li><a href="">Manufactures</a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 hidden-sm col-xs-12">	
				<div class="block">
					<h2 class="ft_widget_title">INFORMATION</h2>
					<ul>
						<li><a href="">Delivery Information</a></li>
						<li><a href="">Privacy Policy</a></li>
						<li><a href="">Terms &amp; Condition</a></li>
						<li><a href="">Search Terms</a></li>
						<li><a href="">Order &amp; Return</a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-5 col-xs-12 ">	
				<div class="block">
					<h2 class="ft_widget_title">OPENNING TIME</h2>
					<div class="open_time">
						<ul class="openning-time">
							<li><div class="inner"><i class="fa fa-caret-right"></i>Monday - Friday<span>8.00 AM - 8.00 PM</span></div></li>
							<li><div class="inner"><i class="fa fa-caret-right"></i>Saturday<span>9.00 AM - 9.00 PM</span></div></li>
							<li><div class="inner"><i class="fa fa-caret-right"></i>Sunday<span>10.00 AM - 6.00 PM</span></div></li>
						</ul>
					</div>
				</div>
			</div>
		</div>	
	</div>		
</div>
<!--FOOTER AREA END -->
<!--COPY RIGHT AREA START -->
<div class="copy_right_area">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">	
				<div class="copy_text ">
					<p>Copyright &copy; 2016 by my team.</p>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 hidden-sm hidden-xs ">	
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">	
				<div class="copy_menu">
					<ul>
						<li><a href="/">Shop</a></li>
						<li><a href="">Contact Us</a></li>
						@auth('client')
						<li><a href="{{ url('/profile') }}" style="color: black;">{{ Auth::guard('client')->user()->username}}</a></li>
						<li>
							<a class="dropdown-item" href="{{ url('/') }}"	onclick="event.preventDefault();document.getElementById('logout-form').submit();">
								{{ __('Logout') }}
							</a>
							<form id="logout-form" action="{{ url('/logout') }}" method="GET" style="display: none;">
								@csrf
							</form>
						</li>
						@else
						<li><a href="{{ url('/login') }}">Login</a></li>
						<li><a href="{{ url('/register') }}">Register</a></li>
						@endauth
					</ul>
				</div>
			</div>
		</div>	
	</div>		
</div>
<!--COPY RIGHT AREA END -->