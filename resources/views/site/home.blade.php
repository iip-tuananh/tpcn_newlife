@extends('site.layouts.master')
@section('title')
    {{ $config->meta_title ?? $config->web_title }}
@endsection
@section('description')
    {{ $config->web_des }}
@endsection
@section('image')
    {{ url('' . $banners[0]->image->path) }}
@endsection
@section('css')
    <link href="/site/css/index.scss.css?1743048451127" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .section_product .block-category .list-category-child {
            list-style: none;
            padding: 0;
            margin-bottom: 10px;
        }

        .section_product .block-category .list-category-child li {
            padding-top: 8px;
            padding-bottom: 8px;
            transition: all 0.3s ease;
        }

        .section_product .block-category .list-category-child li:hover {
            background-color: #f0f0f0;
            padding-left: 10px;
        }

        .section_product .block-category .list-category-child li a {
            font-size: 14px;
            text-decoration: none;
        }

        .home-slider {
            border-radius: 5px;
        }

        @media (max-width: 991px) {
            .section_product .block-category .category-image {
                display: none;
            }

            .section_product .block-category .scroll-wrapper {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .section_product .block-category .scroll-wrapper::-webkit-scrollbar {
                height: 4px;
                display: none;
            }

            .section_product .block-category .scroll-wrapper::-webkit-scrollbar-thumb {
                background-color: #ccc;
                border-radius: 2px;
            }

            .section_product .block-category .scroll-wrapper::-webkit-scrollbar-track {
                background-color: transparent;
            }

            .section_product .block-category .list-category-child {
                display: flex;
                flex-wrap: nowrap;
                gap: 10px;
            }

            .section_product .block-category .list-category-child li {
                border: 1px solid #c1c1c1c1;
                border-radius: 5px;
                text-align: center;
                padding: 8px 10px;
                flex: 0 0 auto;
                min-width: 120px;
            }

            .section_product .block-category .list-category-child li:hover {
                background-color: #f0f0f0;
            }
        }
    </style>
@endsection
@section('content')
    <section class="section_slider">
        <div class="container">
            <div class="home-slider swiper-container gallery-top">
                <div class="swiper-wrapper">
                    @foreach ($banners as $banner)
                        <div class="swiper-slide">
                            <a href="{{ $banner->link }}" class="clearfix" title="{{ $banner->name }}">
                                <picture>
                                    <source media="(min-width: 1200px)"
                                        srcset="{{ $banner->image ? $banner->image->path : 'https://placehold.co/1903x694' }}">
                                    <source media="(min-width: 992px)"
                                        srcset="{{ $banner->image ? $banner->image->path : 'https://placehold.co/1903x694' }}">
                                    <source media="(min-width: 569px)"
                                        srcset="{{ $banner->image ? $banner->image->path : 'https://placehold.co/1903x694' }}">
                                    <source media="(max-width: 567px)"
                                        srcset="{{ $banner->image ? $banner->image->path : 'https://placehold.co/1903x694' }}">
                                    <img width="1903" height="694"
                                        src="{{ $banner->image ? $banner->image->path : 'https://placehold.co/1903x694' }}"
                                        alt="{{ $banner->name }}" class="img-responsive lazyload" />
                                </picture>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            var swiper = new Swiper('.home-slider', {
                autoplay: true,
                delay: 4000,
                effect: "fade",
                pagination: {
                    el: '.home-slider .swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.home-slider .swiper-button-next',
                    prevEl: '.home-slider .swiper-button-prev',
                },
            });
        });
    </script>
    <section class="section_service">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <div class="service-sec">
                        @foreach ($productCategories as $category)
                            <div class="item">
                                <div class="icon">
                                    <a href="{{ route('front.show-product-category', ['categorySlug' => $category->slug]) }}"
                                        title="{{ $category->name }}">
                                        <img width="100%" class="lazyload" src="/site/images/lazy.png"
                                            data-src="{{ $category->image ? $category->image->path : 'https://placehold.co/600x300' }}"
                                            alt="{{ $category->name }}" />
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <style>
            .section_service .service-sec {
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
                justify-content: space-between;
            }

            .section_service .service-sec .item .info h3 {
                font-size: 16px;
                font-weight: 600;
                color: var(--textColor);
            }
        </style>
    </section>
    <link rel="preload" as="script" href="/site/js/count-down.js?1743048451127" />
    <script src="/site/js/count-down.js?1743048451127" type="text/javascript"></script>
    <div class="section_flash_sale">
        <div class="container">
            <div class="thumb-flasale">
                <div class="block-title">
                    <h2>
                        <a href="{{ route('front.show-product-category', ['categorySlug' => $categorySpecialFlashsale->slug]) }}"
                            title="{{ $categorySpecialFlashsale->name }}">
                            {{ $categorySpecialFlashsale->name }}
                        </a>
                    </h2>
                    <div class="timer">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 7V12H17" stroke="#14181F" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20Z"
                                stroke="#14181F" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M6.06418 2.00024L3 4.57139" stroke="#14181F" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M21.0041 4.57115L17.9399 2" stroke="#14181F" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <span class="text">Kết thúc sau:</span>
                        <div class="time" data-countdown="countdown"
                            data-date="{{ \Carbon\Carbon::parse($categorySpecialFlashsale->end_date)->format('m-d-Y-H-i-s') }}">
                        </div>
                    </div>
                </div>
                <div class="block-content">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-12">
                            <div class="flash-sale-swiper swiper-container">
                                <div class="swiper-wrapper">
                                    @foreach ($categorySpecialFlashsale->products as $product)
                                        <div class="swiper-slide flashsale__item" data-pdid="{{ $product->id }}"
                                            data-management="true">
                                            @include('site.products.product_item', ['product' => $product])
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.falshSale = {
            type: "hours",
            dateStart: "",
            dateFinish: "",
            hourStart: "00:00",
            hourFinish: "24",
            activeDay: "7",
            finishAction: "show",
            percentMin: "40",
            percentMax: "80",
            maxInStock: "300",
            useSoldQuantity: false,
            quantityType: "sold",
            timestamp: new Date().getTime(),
        }
    </script>
    <script src="/site/js/flashsale.js?1743048451127" defer></script>
    @foreach ($categorySpecial as $category)
        @if ($category->products->count() > 0)
            <div class="section_product_new section_product">
                <div class="container">
                    <div class="block-title">
                        <h2><a href="{{ route('front.show-product-category', ['categorySlug' => $category->slug]) }}"
                                title="{{ $category->name }}">{{ $category->name }}</a></h2>
                        <div class="block-view">
                            <a href="{{ route('front.show-product-category', ['categorySlug' => $category->slug]) }}"
                                class="cta-view" title="Xem thêm">Xem thêm</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-left col-lg-2 col-12">
                            <div class="block-category">
                                <div class="category-image">
                                    <a href="{{ route('front.show-product-category', ['categorySlug' => $category->slug]) }}"
                                        title="{{ $category->name }}">
                                        <img src="{{ $category->image ? $category->image->path : 'https://placehold.co/350x450' }}"
                                            alt="{{ $category->name }}" style="border-radius: 5px;">
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-right col-lg-10 col-12">
                            <div class="block-product relative">
                                <div class="product-new-swiper swiper-container">
                                    <div class="swiper-wrapper">
                                        @foreach ($category->products as $item)
                                            <div class="swiper-slide">
                                                @include('site.products.product_item', [
                                                    'product' => $item,
                                                ])
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
    @foreach ($categorySpecialPost as $postCategory)
        <section class="section_blog">
            <div class="container">
                <div class="block-title">
                    <h2>
                        <a href="javascript:void(0)"
                            title="{{ $postCategory->name }}">{{ $postCategory->name }}</a>
                    </h2>
                </div>
                <div class="block-blog relative">
                    <div class="blog-swiper swiper-container">
                        <div class="swiper-wrapper">
                            @foreach ($postCategory->posts as $post)
                                <div class="swiper-slide">
                                    <div class="item-blog">
                                        <div class="block-thumb">
                                            <a class="thumb" href="{{ route('front.detail-blog', $post->slug) }}"
                                                title="{{ $post->name }}">
                                                <img class="lazyload d-block" src="/site/images/lazy.png"
                                                    data-src="{{ $post->image ? $post->image->path : 'https://placehold.co/350x350' }}"
                                                    alt="{{ $post->name }}">
                                            </a>
                                            {{-- <div class="time-post badge">
                                                {{ date('d/m/Y', strtotime($post->created_at)) }}
                                            </div> --}}
                                        </div>
                                        <div class="block-content">
                                            <h3><a href="{{ route('front.detail-blog', $post->slug) }}"
                                                    title="{{ $post->name }}">{{ $post->name }}</a>
                                            </h3>
                                            <div class="article-content">
                                                {!! $post->intro !!}
                                            </div>
                                            <div class="article-meta">
                                                <div class="article-date">
                                                    <time>{{ date('d', strtotime($post->created_at)) }} Tháng {{ date('m', strtotime($post->created_at)) }}, {{ date('Y', strtotime($post->created_at)) }}</time>
                                                </div>
                                                <a class="article-seemore"
                                                    href="{{ route('front.detail-blog', $post->slug) }}"
                                                    title="{{ $post->name }}">Xem thêm <i
                                                        class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <style>
                            .section_blog .article-meta {
                                display: flex;
                                display: -ms-flex;
                                justify-content: space-between;
                                -ms-justify-content: space-between;
                                align-items: center;
                                -ms-align-items: center;
                                font-size: 12px;
                                color: #a8aeba;
                                border-top: 1px solid #eee;
                                padding-top: 15px;
                                margin-top: auto;
                            }

                            .section_blog .article-meta .article-date:before {
                                display: inline-block;
                                font-family: FontAwesome;
                                font-weight: 400;
                                content: "\f073";
                                font-size: 12px;
                                margin-right: 3px;
                            }

                            .section_blog .article-meta .article-seemore {
                                color: #a8aeba;
                            }

                            .section_blog .article-meta .article-seemore i {
                                font-size: 10px;
                            }

                            .section_blog .article-meta .article-seemore:hover {
                                color: #1e4194;
                            }
                        </style>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach
@endsection
@push('script')
@endpush
