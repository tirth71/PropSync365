<!DOCTYPE html>
<html dir="ltr" lang="en-US">


<!-- Mirrored from demo.zytheme.com/lalan/properties-grid-split.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 Jan 2020 12:57:38 GMT -->
<?php include("header.php"); ?>
============================================ -->
        <section id="properties-split" class="properties-split pt-0 pb-0 bg-white">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-7">
                        <form class="from-split">
                            <div class="form-box search-properties static pr-0 pl-0">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group input-icon">
                                            <i class="fa fa-map-marker"></i>
                                            <input type="text" class="form-control" id="location" placeholder="Location">
                                        </div>
                                    </div>
                                    <!-- .col-md-12 end -->
                                    <div class="col-xs-12 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <div class="select--box">
                                                <i class="fa fa-angle-down"></i>
                                                <select name="select-city" id="select-city">
								<option>Any city</option>
								<option>Alabama</option>
								<option>Alaska</option>
								<option>California</option>
								<option>Florida</option>
								<option>Mississippi</option>
								<option>Oregon</option>
							</select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- .col-md-4 end -->
                                    <div class="col-xs-12 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <div class="select--box">
                                                <i class="fa fa-angle-down"></i>
                                                <select name="select-type" id="select-type">
								<option>Any Type</option>
								<option>Apartment</option>
								<option>House</option>
								<option>Office</option>
								<option>Villa</option>
							</select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- .col-md-4 end -->
                                    <div class="col-xs-12 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <div class="select--box">
                                                <i class="fa fa-angle-down"></i>
                                                <select name="select-status" id="select-status">
								<option>Any Status</option>
								<option>For Rent</option>
								<option>For Sale</option>
							</select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- .col-md-12 end -->

                                    <div class="col-xs-12 col-sm-4 col-md-4 option-hide">
                                        <div class="form-group">
                                            <div class="select--box">
                                                <i class="fa fa-angle-down"></i>
                                                <select name="select-bedrooms" id="select-bedrooms">
								<option>Bedrooms</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
							</select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- .col-md-3 end -->
                                    <div class="col-xs-12 col-sm-4 col-md-4 option-hide">
                                        <div class="form-group">
                                            <div class="select--box">
                                                <i class="fa fa-angle-down"></i>
                                                <select name="select-bathrooms" id="select-bathrooms">
								<option>Bathrooms</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
							</select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- .col-md-4 end -->
                                    <div class="col-xs-12 col-sm-4 col-md-4 option-hide">
                                        <div class="filter mb-30">
                                            <p>
                                                <label for="area">Area Size:</label>
                                                <input id="area" type="text" class="amount" readonly>
                                            </p>
                                            <div class="slider-range"></div>
                                        </div>
                                    </div>
                                    <!-- .col-md-4 end -->
                                    <div class="col-xs-12 col-sm-12 col-md-12 option-hide">
                                        <div class="filter mb-30">
                                            <p>
                                                <label for="amount">Price Range:</label>
                                                <input id="amount" type="text" class="amount" readonly>
                                            </p>
                                            <div class="slider-range"></div>
                                        </div>
                                    </div>
                                    <!-- .col-md-4 end -->
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <a href="#" class="less--options mt-0 mb-25 block">Less options</a>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <div class="input-checkbox">
                                            <label class="label-checkbox">
							<span>Center Cooling</span>
							<input type="checkbox">
							<span class="check-indicator"></span>
						</label>
                                        </div>
                                    </div>
                                    <!-- .col-md-3 end -->
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <div class="input-checkbox">
                                            <label class="label-checkbox">
							<span>Balcony</span>
							<input type="checkbox">
							<span class="check-indicator"></span>
						</label>
                                        </div>
                                    </div>
                                    <!-- .col-md-3 end -->
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <div class="input-checkbox">
                                            <label class="label-checkbox">
							<span>Pet Friendly</span>
							<input type="checkbox">
							<span class="check-indicator"></span>
						</label>
                                        </div>
                                    </div>
                                    <!-- .col-md-3 end -->
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <div class="input-checkbox">
                                            <label class="label-checkbox">
							<span>Barbeque</span>
							<input type="checkbox">
							<span class="check-indicator"></span>
						</label>
                                        </div>
                                    </div>
                                    <!-- .col-md-3 end -->
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <div class="input-checkbox">
                                            <label class="label-checkbox">
							<span>Fire Alarm</span>
							<input type="checkbox">
							<span class="check-indicator"></span>
						</label>
                                        </div>
                                    </div>
                                    <!-- .col-md-3 end -->
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <div class="input-checkbox">
                                            <label class="label-checkbox">
							<span>Modern Kitchen</span>
							<input type="checkbox">
							<span class="check-indicator"></span>
						</label>
                                        </div>
                                    </div>
                                    <!-- .col-md-3 end -->
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <div class="input-checkbox">
                                            <label class="label-checkbox">
							<span>Storage</span>
							<input type="checkbox">
							<span class="check-indicator"></span>
						</label>
                                        </div>
                                    </div>
                                    <!-- .col-md-3 end -->
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <div class="input-checkbox">
                                            <label class="label-checkbox">
							<span>Dryer</span>
							<input type="checkbox">
							<span class="check-indicator"></span>
						</label>
                                        </div>
                                    </div>
                                    <!-- .col-md-3 end -->
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <div class="input-checkbox">
                                            <label class="label-checkbox">
							<span>Heating</span>
							<input type="checkbox">
							<span class="check-indicator"></span>
						</label>
                                        </div>
                                    </div>
                                    <!-- .col-md-3 end -->
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <div class="input-checkbox">
                                            <label class="label-checkbox">
							<span>Pool</span>
							<input type="checkbox">
							<span class="check-indicator"></span>
						</label>
                                        </div>
                                    </div>
                                    <!-- .col-md-3 end -->
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <div class="input-checkbox">
                                            <label class="label-checkbox">
							<span>Laundry</span>
							<input type="checkbox">
							<span class="check-indicator"></span>
						</label>
                                        </div>
                                    </div>
                                    <!-- .col-md-3 end -->
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <div class="input-checkbox">
                                            <label class="label-checkbox">
							<span>Sauna</span>
							<input type="checkbox">
							<span class="check-indicator"></span>
						</label>
                                        </div>
                                    </div>
                                    <!-- .col-md-3 end -->
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <input type="submit" value="Apply Filters" name="submit" class="btn btn--primary btn--block mb-30">
                                    </div>
                                    <!-- .col-md-12 end -->
                                </div>
                                <!-- .row end -->
                            </div>
                            <!-- .form-box end -->
                        </form>
                        <div class="row wrapper-bg pt-45">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="properties-filter clearfix">
                                    <div class="select--box pull-left">
                                        <label>6 Results Found</label>
                                    </div>
                                    <!-- .select-box -->
                                    <div class="view--type pull-right">
                                        <a id="switch-list" href="#" class=""><i class="fa fa-th-list"></i></a>
                                        <a id="switch-grid" href="#" class="active"><i class="fa fa-th-large"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="properties properties-grid">
                                <!-- .property-item #1 -->
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="property-item">
                                        <div class="property--img">
                                            <a href="property-single-gallery.html">
                                <img src="assets/images/properties/2.jpg" alt="property image" class="img-responsive">
								</a>
                                            <span class="property--status">For Sale</span>
                                        </div>
                                        <div class="property--content">
                                            <div class="property--info">
                                                <h5 class="property--title"><a href="property-single-gallery.html">House in Kent Street</a></h5>
                                                <p class="property--location">127 Kent Street, Sydney, NSW 2000</p>
                                                <p class="property--price">$130,000</p>
                                            </div>
                                            <!-- .property-info end -->
                                        </div>
                                    </div>
                                </div>
                                <!-- .property item end -->
                                <!-- .property-item #2 -->
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="property-item">
                                        <div class="property--img">
                                            <a href="property-single-gallery.html">
                               <img src="assets/images/properties/5.jpg" alt="property image" class="img-responsive">
								</a>
                                            <span class="property--status">For Rent</span>
                                        </div>
                                        <div class="property--content">
                                            <div class="property--info">
                                                <h5 class="property--title"><a href="property-single-gallery.html">2750 House in Urban St.</a></h5>
                                                <p class="property--location">2750 Urban Street Dr, Anderson, IN 46011</p>
                                                <p class="property--price">$1,550<span class="time">month</span></p>
                                            </div>
                                            <!-- .property-info end -->
                                        </div>
                                    </div>
                                </div>
                                <!-- .property item end -->
                                <!-- .property-item #3 -->
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="property-item">
                                        <div class="property--img">
                                            <a href="property-single-gallery.html">
                                <img src="assets/images/properties/7.jpg" alt="property image" class="img-responsive">
								</a>
                                            <span class="property--status">For Sale</span>
                                        </div>
                                        <div class="property--content">
                                            <div class="property--info">
                                                <h5 class="property--title"><a href="property-single-gallery.html">House in Kent Street</a></h5>
                                                <p class="property--location">127 Kent Street, Sydney, NSW 2000</p>
                                                <p class="property--price">$130,000</p>
                                            </div>
                                            <!-- .property-info end -->
                                        </div>
                                    </div>
                                </div>
                                <!-- .property item end -->
                                <!-- .property-item #4 -->
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="property-item">
                                        <div class="property--img">
                                            <a href="property-single-gallery.html">
                               <img src="assets/images/properties/6.jpg" alt="property image" class="img-responsive">
								</a>
                                            <span class="property--status">For Rent</span>
                                        </div>
                                        <div class="property--content">
                                            <div class="property--info">
                                                <h5 class="property--title"><a href="property-single-gallery.html">2750 House in Urban St.</a></h5>
                                                <p class="property--location">2750 Urban Street Dr, Anderson, IN 46011</p>
                                                <p class="property--price">$1,550<span class="time">month</span></p>
                                            </div>
                                            <!-- .property-info end -->
                                        </div>
                                    </div>
                                </div>
                                <!-- .property item end -->
                                <!-- .property-item #5 -->
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="property-item">
                                        <div class="property--img">
                                            <a href="property-single-gallery.html">
                                <img src="assets/images/properties/1.jpg" alt="property image" class="img-responsive">
								</a>
                                            <span class="property--status">For Sale</span>
                                        </div>
                                        <div class="property--content">
                                            <div class="property--info">
                                                <h5 class="property--title"><a href="property-single-gallery.html">House in Kent Street</a></h5>
                                                <p class="property--location">127 Kent Street, Sydney, NSW 2000</p>
                                                <p class="property--price">$130,000</p>
                                            </div>
                                            <!-- .property-info end -->
                                        </div>
                                    </div>
                                </div>
                                <!-- .property item end -->
                                <!-- .property-item #6 -->
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="property-item">
                                        <div class="property--img">
                                            <a href="property-single-gallery.html">
                               <img src="assets/images/properties/2.jpg" alt="property image" class="img-responsive">
								</a>
                                            <span class="property--status">For Rent</span>
                                        </div>
                                        <div class="property--content">
                                            <div class="property--info">
                                                <h5 class="property--title"><a href="property-single-gallery.html">2750 House in Urban St.</a></h5>
                                                <p class="property--location">2750 Urban Street Dr, Anderson, IN 46011</p>
                                                <p class="property--price">$1,550<span class="time">month</span></p>
                                            </div>
                                            <!-- .property-info end -->
                                        </div>
                                    </div>
                                </div>
                                <!-- .property item end -->
                            </div>
                        </div>
                        <!-- .row -->
                    </div>
                    <!-- .col-md-7 end -->
                    <div class="col-xs-12 col-sm-12 col-md-5 col-map">
                        <div class="map-horizontal">
                            <div id="googleMap" style="width:100%;height:100vh;"></div>
                        </div>
                    </div>
                    <!-- .col-md-5 end -->
                </div>
                <!-- .row end -->
            </div>
            <!-- .container end -->

        </section>
        <!-- #properties-split  end -->

    </div>
    <!-- #wrapper end -->

    <!-- Footer Scripts
============================================= -->
    <script src="assets/js/jquery-2.2.4.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/functions.js"></script>
    <script src="https://maps.google.com/maps/api/js?sensor=true&amp;key=AIzaSyCiRALrXFl5vovX0hAkccXXBFh7zP8AOW8"></script>
    <script src="assets/js/plugins/jquery.gmap.min.js"></script>
    <script src="assets/js/map-addresses.js"></script>
    <script src="assets/js/map-custom.js"></script>
</body>


<!-- Mirrored from demo.zytheme.com/lalan/properties-grid-split.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 Jan 2020 12:57:38 GMT -->
</html>
