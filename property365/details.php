<?php
	include('header.php');
?>

<!-- Titlebar
================================================== -->
<div class=""
	
	data-color="#333333"
	data-color-opacity="0.7"
	data-img-width="800"
	data-img-height="505">

	<div id="titlebar">
		<div class="container">
			<div class="row">
				<div class="col-md-12">

				</div>
			</div>
		</div>
	</div>
</div>


<!-- Content
================================================== -->
<div class="container">
	<div class="row sticky-wrapper">

		<div class="col-md-8">

			<!-- Main Search Input -->
			<div class="main-search-input margin-bottom-35">
				<input type="text" class="ico-01" placeholder="Enter address city and state " value=""/>
				<button class="button">Search</button>
			</div>

			<!-- Sorting / Layout Switcher -->
			<div class="row margin-bottom-15">

				<div class="col-md-6">
					<!-- Sort by -->
					<div class="sort-by">
						<label>Sort by:</label>

						<div class="sort-by-select">
							<select data-placeholder="Sort By" class="chosen-select-no-single" >
								<option>Pricing</option>	
								<option>Price Low to High</option>
								<option>Price High to Low</option>
								
							</select>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<!-- Layout Switcher -->
					<div class="layout-switcher">
						<a href="#" class="list"><i class="fa fa-th-list"></i></a>
						<a href="#" class="grid"><i class="fa fa-th-large"></i></a>
					</div>
				</div>
			</div>

			
			<!-- Listings -->
			<div class="listings-container list-layout">

				<!-- Listing Item -->
				<div class="listing-item">

					<a href="properties.php" class="listing-img-container">

						<div class="listing-badges">
							<span class="featured">Featured</span>
							<span>For Sale</span>
						</div>

						<div class="listing-img-content">
							<span class="listing-price">$275,000 <i>$520 / sq ft</i></span>
							<span class="like-icon with-tip" data-tip-content="Add to Bookmarks"></span>
							<span class="compare-button with-tip" data-tip-content="Add to Compare"></span>
						</div>

						<div class="listing-carousel">
							<div><img src="images/listing-01.jpg" alt=""></div>
							<div><img src="images/listing-01b.jpg" alt=""></div>
							<div><img src="images/listing-01c.jpg" alt=""></div>
						</div>
					</a>
					
					<div class="listing-content">

						<div class="listing-title">
							<h4><a href="properties.php">Eagle Apartments</a></h4>
							<a href="https://maps.google.com/maps?q=221B+Baker+Street,+London,+United+Kingdom&amp;hl=en&amp;t=v&amp;hnear=221B+Baker+St,+London+NW1+6XE,+United+Kingdom" class="listing-address popup-gmaps">
								<i class="fa fa-map-marker"></i>
								9364 School St. Lynchburg, NY
							</a>

							<a href="properties.php" class="details button border">Details</a>
						</div>

						<ul class="listing-details">
							<li>530 sq ft</li>
							<li>1 Bedroom</li>
							<li>3 Rooms</li>
							<li>1 Bathroom</li>
						</ul>

						<div class="listing-footer">
							<a href="#"><i class="fa fa-user"></i> David Strozier</a>
							<span><i class="fa fa-calendar-o"></i> 1 day ago</span>
						</div>

					</div>

				</div>
				<!-- Listing Item / End -->


				<!-- Listing Item -->
				<div class="listing-item">

					<a href="single-property-page-1.html" class="listing-img-container">

						<div class="listing-badges">
							<span>For Rent</span>
						</div>

						<div class="listing-img-content">
							<span class="listing-price">$900 <i>monthly</i></span>
							<span class="like-icon with-tip" data-tip-content="Add to Bookmarks"></span>
							<span class="compare-button with-tip" data-tip-content="Add to Compare"></span>
						</div>

						<img src="images/listing-02.jpg" alt="">

					</a>
					
					<div class="listing-content">

						<div class="listing-title">
							<h4><a href="single-property-page-1.html">Serene Uptown</a></h4>
							<a href="https://maps.google.com/maps?q=221B+Baker+Street,+London,+United+Kingdom&amp;hl=en&amp;t=v&amp;hnear=221B+Baker+St,+London+NW1+6XE,+United+Kingdom" class="listing-address popup-gmaps">
								<i class="fa fa-map-marker"></i>
								6 Bishop Ave. Perkasie, PA
							</a>

							<a href="single-property-page-1.html" class="details button border">Details</a>
						</div>

						<ul class="listing-details">
							<li>440 sq ft</li>
							<li>1 Bedroom</li>
							<li>1 Room</li>
							<li>1 Bathroom</li>
						</ul>

						<div class="listing-footer">
							<a href="#"><i class="fa fa-user"></i> Harriette Clark</a>
							<span><i class="fa fa-calendar-o"></i> 2 days ago</span>
						</div>

					</div>

				</div>
				<!-- Listing Item / End -->


				<!-- Listing Item -->
				<div class="listing-item">

					<a href="single-property-page-1.html" class="listing-img-container">

						<div class="listing-badges">
							<span class="featured">Featured</span>
							<span>For Rent</span>
						</div>

						<div class="listing-img-content">
							<span class="listing-price">$1700 <i>monthly</i></span>
							<span class="like-icon with-tip" data-tip-content="Add to Bookmarks"></span>
							<span class="compare-button with-tip" data-tip-content="Add to Compare"></span>
						</div>

						<img src="images/listing-03.jpg" alt="">

					</a>
					
					<div class="listing-content">

						<div class="listing-title">
							<h4><a href="single-property-page-1.html">Meridian Villas</a></h4>
							<a href="https://maps.google.com/maps?q=221B+Baker+Street,+London,+United+Kingdom&amp;hl=en&amp;t=v&amp;hnear=221B+Baker+St,+London+NW1+6XE,+United+Kingdom" class="listing-address popup-gmaps">
								<i class="fa fa-map-marker"></i>
								778 Country St. Panama City, FL
							</a>

							<a href="single-property-page-1.html" class="details button border">Details</a>
						</div>

						<ul class="listing-details">
							<li>1450 sq ft</li>
							<li>1 Bedroom</li>
							<li>2 Rooms</li>
							<li>2 Rooms</li>
						</ul>

						<div class="listing-footer">
							<a href="#"><i class="fa fa-user"></i> Chester Miller</a>
							<span><i class="fa fa-calendar-o"></i> 4 days ago</span>
						</div>

					</div>
					<!-- Listing Item / End -->

				</div>
				<!-- Listing Item / End -->


				<!-- Listing Item -->
				<div class="listing-item">

					<a href="single-property-page-1.html" class="listing-img-container">

						<div class="listing-badges">
							<span>For Sale</span>
						</div>

						<div class="listing-img-content">
							<span class="listing-price">$420,000 <i>$770 / sq ft</i></span>
							<span class="like-icon with-tip" data-tip-content="Add to Bookmarks"></span>
							<span class="compare-button with-tip" data-tip-content="Add to Compare"></span>
						</div>

						<div class="listing-carousel">
							<div><img src="images/listing-04.jpg" alt=""></div>
							<div><img src="images/listing-04b.jpg" alt=""></div>
						</div>

					</a>
					
					<div class="listing-content">

						<div class="listing-title">
							<h4><a href="single-property-page-1.html">Selway Apartments</a></h4>
							<a href="https://maps.google.com/maps?q=221B+Baker+Street,+London,+United+Kingdom&amp;hl=en&amp;t=v&amp;hnear=221B+Baker+St,+London+NW1+6XE,+United+Kingdom" class="listing-address popup-gmaps">
								<i class="fa fa-map-marker"></i>
								33 William St. Northbrook, IL
							</a>

							<a href="single-property-page-1.html" class="details button border">Details</a>
						</div>

						<ul class="listing-details">
							<li>540 sq ft</li>
							<li>1 Bedroom</li>
							<li>3 Rooms</li>
							<li>2 Bathroom</li>
						</ul>

						<div class="listing-footer">
							<a href="#"><i class="fa fa-user"></i> Kristen Berry</a>
							<span><i class="fa fa-calendar-o"></i> 3 days ago</span>
						</div>

					</div>
					<!-- Listing Item / End -->

				</div>
				<!-- Listing Item / End -->


				<!-- Listing Item -->
				<div class="listing-item">

					<a href="single-property-page-1.html" class="listing-img-container">
						<div class="listing-badges">
							<span>For Sale</span>
						</div>

						<div class="listing-img-content">
							<span class="listing-price">$535,000 <i>$640 / sq ft</i></span>
							<span class="like-icon with-tip" data-tip-content="Add to Bookmarks"></span>
							<span class="compare-button with-tip" data-tip-content="Add to Compare"></span>
						</div>

						<img src="images/listing-05.jpg" alt="">
					</a>
					
					<div class="listing-content">

						<div class="listing-title">
							<h4><a href="single-property-page-1.html">Oak Tree Villas</a></h4>
							<a href="https://maps.google.com/maps?q=221B+Baker+Street,+London,+United+Kingdom&amp;hl=en&amp;t=v&amp;hnear=221B+Baker+St,+London+NW1+6XE,+United+Kingdom" class="listing-address popup-gmaps">
								<i class="fa fa-map-marker"></i>
								71 Lower River Dr. Bronx, NY
							</a>

							<a href="assets/images/properties/city/1.jpg" class="details button border">Details</a>
						</div>

						<ul class="listing-details">
							<li>350 sq ft</li>
							<li>1 Bedroom</li>
							<li>2 Rooms</li>
							<li>1 Bathroom</li>
						</ul>

						<div class="listing-footer">
							<a href="#"><i class="fa fa-user"></i> Mabel Gagnon</a>
							<span><i class="fa fa-calendar-o"></i> 4 days ago</span>
						</div>

					</div>
					<!-- Listing Item / End -->

				</div>
				<!-- Listing Item / End -->

				
				<!-- Listing Item -->
				<div class="listing-item">

					<a href="single-property-page-1.html" class="listing-img-container">
						<div class="listing-badges">
							<span>For Rent</span>
						</div>

						<div class="listing-img-content">
							<span class="listing-price">$500 <i>monthly</i></span>
							<span class="like-icon with-tip" data-tip-content="Add to Bookmarks"></span>
							<span class="compare-button with-tip" data-tip-content="Add to Compare"></span>
						</div>

						<img src="images/listing-06.jpg" alt="">
					</a>
					
					<div class="listing-content">

						<div class="listing-title">
							<h4><a href="single-property-page-1.html">Old Town Manchester</a></h4>
							<a href="https://maps.google.com/maps?q=221B+Baker+Street,+London,+United+Kingdom&amp;hl=en&amp;t=v&amp;hnear=221B+Baker+St,+London+NW1+6XE,+United+Kingdom" class="listing-address popup-gmaps">
								<i class="fa fa-map-marker"></i>
								7843 Durham Avenue, MD
							</a>

							<a href="single-property-page-1.html" class="details button border">Details</a>
						</div>

						<ul class="listing-details">
							<li>850 sq ft</li>
							<li>2 Bedroom</li>
							<li>3 Rooms</li>
							<li>1 Bathroom</li>
						</ul>

						<div class="listing-footer">
							<a href="#"><i class="fa fa-user"></i> Charles Watson</a>
							<span><i class="fa fa-calendar-o"></i> 3 days ago</span>
						</div>

					</div>

				</div>
				<!-- Listing Item / End -->

			</div>
			<!-- Listings Container / End -->

			
			<!-- Pagination -->
			<div class="pagination-container margin-top-20">
				<nav class="pagination">
					<ul>
						<li><a href="#" class="current-page">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li class="blank">...</li>
						<li><a href="#">22</a></li>
					</ul>
				</nav>

				<nav class="pagination-next-prev">
					<ul>
						<li><a href="#" class="prev">Previous</a></li>
						<li><a href="#" class="next">Next</a></li>
					</ul>
				</nav>
			</div>
			<!-- Pagination / End -->

		</div>


		<!-- Sidebar
		================================================== -->
		<div class="col-md-4">
			<div class="sidebar sticky right">

				<!-- Widget -->
				<div class="widget margin-bottom-40">
					<h3 class="margin-top-0 margin-bottom-35">Find Property</h3>

					

					<br>

					
					<!-- Price Range -->
					<div class="range-slider">
						<label>Price Range</label>
						<div id="price-range" data-min="0" data-max="400000" data-unit="$"></div>
						<div class="clearfix"></div>
					</div>



					
					<div class="more-search-options relative">

						<!-- Checkboxes -->
						<div class="checkboxes one-in-row margin-bottom-10">
					
							<input id="check-2" type="checkbox" name="check">
							<label for="check-2">Air Conditioning</label>

							<input id="check-3" type="checkbox" name="check">
							<label for="check-3">Swimming Pool</label>

							<input id="check-4" type="checkbox" name="check" >
							<label for="check-4">Central Heating</label>

							<input id="check-5" type="checkbox" name="check">
							<label for="check-5">Laundry Room</label>	


							<input id="check-6" type="checkbox" name="check">
							<label for="check-6">Gym</label>

							<input id="check-7" type="checkbox" name="check">
							<label for="check-7">Alarm</label>

							<input id="check-8" type="checkbox" name="check">
							<label for="check-8">Window Covering</label>
					
						</div>
						<!-- Checkboxes / End -->

					</div>
					<!-- More Search Options / End -->

					<button class="button fullwidth margin-top-30">Search</button>


				</div>
				<!-- Widget / End -->

			</div>
		</div>
		<!-- Sidebar / End -->
	</div>
</div>

<?php 
	include('footer.php');
 ?>

<!-- Back To Top Button -->
<div id="backtotop"><a href="#"></a></div>


<!-- Scripts
================================================== -->
<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script type="text/javascript" src="scripts/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="scripts/jquery-migrate-3.1.0.min.js"></script>
<script type="text/javascript" src="scripts/chosen.min.js"></script>
<script type="text/javascript" src="scripts/magnific-popup.min.js"></script>
<script type="text/javascript" src="scripts/owl.carousel.min.js"></script>
<script type="text/javascript" src="scripts/rangeSlider.js"></script>
<script type="text/javascript" src="scripts/sticky-kit.min.js"></script>
<script type="text/javascript" src="scripts/slick.min.js"></script>
<script type="text/javascript" src="scripts/mmenu.min.js"></script>
<script type="text/javascript" src="scripts/tooltips.min.js"></script>
<script type="text/javascript" src="scripts/masonry.min.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>





</div>
<!-- Wrapper / End -->


</body>

<!-- Mirrored from www.vasterad.com/themes/findeo_updated/listings-list-with-sidebar.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Jan 2020 11:07:45 GMT -->
</html>