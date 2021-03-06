<!DOCTYPE html>

<html lang="en">



<!-- Body BEGIN -->

<body class="ecommerce">


    <div class="main">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="#">Store</a></li>
                <li class="active">{{ $product->name }}</li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">
                <!-- BEGIN SIDEBAR -->
                <div class="sidebar col-md-3 col-sm-5">
                    <ul class="list-group margin-bottom-25 sidebar-menu">
                        @foreach ($categories as $category)
                            <li
                                class="list-group-item clearfix dropdown {{ count($category->subCategories) > 0 ? 'has-child-cate' : '' }} ">
                                <a href="{{ route('product.category', ['category_slug' => $category->slug]) }}"
                                    class="collapsed">
                                    <i class="fa fa-angle-right"></i>
                                    {{ $category->name }}
                                </a>
                                @if (count($category->subCategories) > 0)
                                    <ul class="dropdown-menu">
                                        @foreach ($category->subCategories as $scategory)
                                            <li class="list-group-item clearfix dropdown">
                                                <a href="{{ route('product.category', ['category_slug' => $category->slug, 'scategory_slug' => $scategory->slug]) }}"
                                                    class="collapsed">
                                                    <i class="fa fa-angle-right"></i>
                                                    {{ $scategory->name }}
                                                </a>
                                            </li>
                                        @endforeach

                                    </ul>
                                @endif
                                {{-- <ul class="dropdown-menu" style="display:block;">
                                    <li
                                        class="list-group-item dropdown clearfix active {{ count($category->subCategories) > 0 ? 'has-child-cate' : '' }}">
                                        @if (count($category->subCategories) > 0)
                                            @foreach ($category->subCategories as $scategory)
                                                <a href="{{ route('product.category', ['category_slug' => $category->slug, 'scategory_slug' => $scategory->slug]) }}"
                                                    class="collapsed"><i class="fa fa-angle-right"></i>
                                                    {{ $scategory->name }} </a>
                                            @endforeach
                                        @endif
                                    </li>
                                </ul> --}}
                            </li>
                        @endforeach

                        <div class="sidebar-filter margin-bottom-25">
                            <h2>Filter</h2>
                            <h3>Availability</h3>
                            <div class="checkbox-list">
                                <label><input type="checkbox"> Not Available (3)</label>
                                <label><input type="checkbox"> In Stock (26)</label>
                            </div>

                            <h3>Price <span class="text-info"></span></h3>
                            <div id="slider"></div>
                        </div>
                </div>
                <!-- END SIDEBAR -->

                <!-- BEGIN CONTENT -->
                <div class="col-md-9 col-sm-7">
                    <div class="product-page">
                        <div class="row">


                            <div class="col-md-6 col-sm-6">
                                <!-- default start -->

                                <div class="large-12 column">
                                    <div class="xzoom-container">
                                        <img class="xzoom" id="xzoom-default"
                                            src="{{ asset('assets/pages/img/products') }}/{{ $product->image }}"
                                            alt="{{ $product->name }}"
                                            xoriginal="{{ asset('assets/pages/img/products') }}/{{ $product->image }}" />
                                        <div class="xzoom-thumbs">
                                            @php
                                                $images = explode(',', $product->images);
                                            @endphp
                                            @foreach ($images as $image)
                                                @if ($image)
                                                    <a
                                                        href="{{ asset('assets/pages/img/products') }}/{{ $image }}"><img
                                                            class="xzoom-gallery" width="80"
                                                            src="{{ asset('assets/pages/img/products') }}/{{ $image }}"
                                                            xpreview="{{ asset('assets/pages/img/products') }}/{{ $image }}"></a>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="large-7 column"></div>

                                <!-- default end -->

                            </div>
                            <?php
                            $discout = (($product->regular_price - $product->sale_price) / $product->regular_price) * 100;
                            ?>
                            <div class="col-md-6 col-sm-6">
                                <h4>{{ $product->name }}</h4>
                                <div class="price-availability-block clearfix">
                                    <div class="price">
                                        <strong><span>???</span>{{ $product->sale_price }} <strike
                                                class="dull1">???
                                                {{ $product->regular_price }}</strike> </strong>
                                        <!-- <em>$<span>{{ $product->regular_price }}</span></em> -->
                                        <span
                                            class=" bg-success text-white p-2">{{ (int) $discout }}%&nbsp;off</span>
                                    </div>




                                    <div class="availability">
                                        Availability: <strong
                                            class=" font-bold {{ $product->stock_status == 'instock' ? 'text-success' : 'text-danger' }}">{{ $product->stock_status }}</strong>
                                    </div>
                                </div>
                                <div class="description">
                                    <p>{!! $product->short_description !!}</p>
                                </div>
                                <div class="product-page-options">
                                    <div class="pull-left">
                                        <a href="shop-shopping-cart.php" title=""><img
                                                src="{{ asset('assets/pages/img/finance/bajaj.jpg') }}" alt=""></a>
                                    </div>
                                    <div class="pull-left">
                                        <a href="shop-shopping-cart.php" title=""><img
                                                src="{{ asset('assets/pages/img/finance/hdb.jpg') }}" alt=""></a>
                                    </div>
                                </div>
                                <div class="product-page-cart">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <form action="{{ route('cart.addwithmore') }}" method="post">
                                                @csrf
                                                <div class="product-quantity">
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}"
                                                        id="">
                                                    <input id="product-quantity" name="item" type="text" value="1" min="1" readonly
                                                        class="form-control form-control-sm ">
                                                </div>
                                                <button type="submit" class="btn btn-default add2cart">Add
                                                    to cart
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-sm-4">
                                            <a href="{{ route('wishlist.add', $product->id) }}"
                                                class="btn btn-primary add2cart">Secure your
                                                system
                                            </a>
                                        </div>
                                    </div>


                                </div>

                                <ul class="social-icons">
                                    <li><a class="facebook" data-original-title="facebook"
                                            href="javascript:;"></a></li>
                                    <li><a class="twitter" data-original-title="twitter" href="javascript:;"></a>
                                    </li>
                                    <li><a class="googleplus" data-original-title="googleplus"
                                            href="javascript:;"></a>
                                    </li>
                                    <li><a class="evernote" data-original-title="evernote"
                                            href="javascript:;"></a></li>
                                    <li><a class="tumblr" data-original-title="tumblr" href="javascript:;"></a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-page-content">
                                <ul id="myTab" class="nav nav-tabs">
                                    <li class="active"><a href="#Description" data-toggle="tab">Description</a>
                                    </li>
                                    <!-- <li><a href="#Information" data-toggle="tab">Information</a></li> -->
                                    <li><a href="#Reviews" data-toggle="tab">Reviews</a></li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane fade in active" id="Description">
                                        <p>{!! $product->description !!}</p>
                                    </div>
                                    <div class="tab-pane fade" id="Information">
                                        <table class="datasheet">
                                            <tr>
                                                <th colspan="2">Additional features</th>
                                            </tr>
                                            <tr>
                                                <td class="datasheet-features-type">Value 1</td>
                                                <td>21 cm</td>
                                            </tr>
                                            <tr>
                                                <td class="datasheet-features-type">Value 2</td>
                                                <td>700 gr.</td>
                                            </tr>
                                            <tr>
                                                <td class="datasheet-features-type">Value 3</td>
                                                <td>10 person</td>
                                            </tr>
                                            <tr>
                                                <td class="datasheet-features-type">Value 4</td>
                                                <td>14 cm</td>
                                            </tr>
                                            <tr>
                                                <td class="datasheet-features-type">Value 5</td>
                                                <td>plastic</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="Reviews">
                                        <h2>{{ $product->orderItems->where('rstatus', 1)->count() }} review for
                                            <span>{{ $product->name }}</span>
                                        </h2>
                                        @foreach ($product->orderItems->where('rstatus', 1) as $orderItem)
                                            <div class="review-item clearfix">
                                                <div class="review-item-submitted">
                                                    <strong>{{ $orderItem->order->user->name }}</strong>
                                                    <em>{{ Carbon\Carbon::parse($orderItem->review->created_at)->format('d F Y g:i A') }}</em>
                                                    <div class="rateit" data-rateit-value="5"
                                                        data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                                                </div>
                                                <div class="review-item-content">
                                                    <p>{{ $orderItem->review->comment }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <!-- END CONTENT -->

            </div>
            <!-- END SIDEBAR & CONTENT -->

            <div class="row margin-bottom-40">
                <div class="col-lg-12">
                    <h3>BUY IT WITH</h3>
                    <form action="{{ route('addwith') }}" method="POST">
                        @csrf
                        <div class="row">
                            @foreach ($related_products as $r_product)
                                <div class="col-lg-2 col-6 addwithproduct">

                                    <img src="{{ asset('assets/pages/img/products') }}/{{ $r_product->image }}"
                                        alt="{{ $r_product->name }}" height="100px">
                                    <span style="font-size: 25px;margin-left: 20px;font-weight: 800;">+</span> <small
                                        class="text-decoration-line-through">{{ $r_product->regular_price }}</small>
                                    <span class="text-primary sale_prince">{{ $r_product->sale_price }}</span>
                                </div>
                            @endforeach


                            <div class="col-lg-2">
                                <div class="a-section a-spacing-mini _p13n-desktop-sims-fbt_fbt-desktop_total-label__dI983"
                                    style="display: block;">
                                    <span class="a-size-base a-color-secondary">Total price:</span>
                                    <span id="total_buy"
                                        class="a-color-price _p13n-desktop-sims-fbt_fbt-desktop_total-amount__wLVdU">???{{ $total_amount }}
                                    </span>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary" type="submit">Add
                                        to cart</button>
                                </div>
                            </div>
                        </div>
                        <div class="row margin-top-40">
                            <div class="col-lg-12">
                                <!-- Default checkbox -->


                                <div class="checkbox-list">
                                    <input type="hidden" name="product_addwith[]" value="{{ $product->id }}">
                                    @foreach ($related_products as $r_product)
                                        <label><input name="product_addwith[]" class="product_addwith" checked
                                                onclick="addwith()" value="{{ $r_product->id }}" type="checkbox">
                                            {{ $r_product->name }}</label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <!-- BEGIN SALE PRODUCT & NEW ARRIVALS -->
            <div class="row margin-bottom-40">
                <!-- BEGIN SALE PRODUCT -->
                <div class="col-md-12 sale-product">
                    <h2>Products related to your search</h2>
                    <div class="owl-carousel owl-carousel5">
                        @foreach ($popular_products as $p_product)
                            <div class="product-item">
                                <div class="pi-img-wrapper">
                                    <img src="{{ asset('assets/pages/img/products') }}/{{ $p_product->image }}"
                                        class="img-responsive" alt="{{ $p_product->name }}">
                                    <div>
                                        <a href="{{ route('product.details', ['slug' => $p_product->slug]) }}"
                                            class="btn btn-default fancybox-button">Zoom</a>
                                        <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                                    </div>
                                </div>
                                <h3><a href="{{ route('product.details', ['slug' => $p_product->slug]) }}">{{ substr($p_product->name, 0, 35) }}
                                    </a></h3>
                                <div class="pi-price">??? {{ $p_product->sale_price }} <strike
                                        class="dull">??? {{ $product->regular_price }}</strike></div>
                                <a class="btn btn-default add2cart" href="{{ route('addcart', $product->id) }}">Add
                                    to cart
                                </a>
                                <!--<div class="sticker sticker-sale"></div>-->
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- END SALE PRODUCT -->
            </div>
            <!-- END SALE PRODUCT & NEW ARRIVALS -->
        </div>
    </div>


</body>
<!-- END BODY -->
<script src="{{ asset('js/foundation.min.js') }}"></script>
<script src="{{ asset('js/setup.js') }}"></script>
<script>
    function addwith() {
        var total = 0;
        var sale_price = document.getElementsByClassName('sale_prince')
        for (i = 0; i < sale_price.length; i++) {
            if (document.getElementsByClassName('product_addwith')[i].checked == true) {
                document.getElementsByClassName('addwithproduct')[i].style.display = "block"

                var total = total + Number(document.getElementsByClassName('sale_prince')[i].innerText);
            } else {
                document.getElementsByClassName('addwithproduct')[i].style.display = "none"

            }
        }
        document.getElementById('total_buy').innerText = total;
    }
</script>

</html>
