<div class="item_product_main">
    <form class="variants product-action " data-id="product-actions-32949270" enctype="multipart/form-data">
        <div class="product-thumbnail">
            <a class="image_thumb" href="{{ route('front.show-product-detail', $product->slug) }}"
                title="{{ $product->name }}">
                <img class="lazyload" width="350" height="350" {{-- src="/site/images/lazy.png" --}}
                    src="{{ $product->image ? $product->image->path : 'https://placehold.co/350x350' }}"
                    alt="{{ $product->name }}" loading="lazy" />
            </a>
            @if ($product->base_price > 0 && $product->price > 0)
                <span class="smart">-
                    {{ round(100 - ($product->price / $product->base_price) * 100) }}%
                </span>
            @endif
            {{-- <div class="action">
                <div class="actions-secondary">
                    <div class="actions-primary" style="cursor: pointer; padding: 8px; border: 1px solid #d30e00" ng-click="addToCart({{ $product->id }})">
                        <a class="btn-cart add_to_cart " href="javascript:void(0);"
                            title="Thêm vào giỏ hàng">
                            <span class="icon icon-cart">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="18"
                                    viewBox="0 0 18 20" fill="none">
                                    <path fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M8.50001 1.75C6.98123 1.75 5.75001 2.98121 5.75001 4.5L5.75 8.83231C5.75 9.24652 5.41421 9.58231 5 9.58231C4.58579 9.58231 4.25 9.24652 4.25 8.8323L4.25001 4.49999C4.25001 2.15279 6.1528 0.25 8.50001 0.25H9.5C11.8472 0.25 13.75 2.15279 13.75 4.5V9C13.75 9.41421 13.4142 9.75 13 9.75C12.5858 9.75 12.25 9.41421 12.25 9V4.5C12.25 2.98122 11.0188 1.75 9.5 1.75H8.50001Z"
                                        fill="#d30e00" />
                                    <path fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M0.365475 9.71565C-0.271948 7.07673 2.13363 4.83729 4.68971 5.25515C7.6749 5.74315 10.2539 5.75778 13.3285 5.25915C15.8862 4.84435 18.3012 7.08619 17.6626 9.7297L15.8987 17.0323C15.5134 18.6275 14.0839 19.75 12.4423 19.75H5.58922C3.94759 19.75 2.5181 18.6275 2.13279 17.0323L0.365475 9.71565ZM4.44771 6.7355C2.82223 6.46977 1.46793 7.89121 1.82354 9.36346L3.59085 16.6801C3.81308 17.6001 4.63848 18.25 5.58922 18.25H12.4423C13.393 18.25 14.2184 17.6001 14.4407 16.6801L16.2046 9.37751C16.5607 7.90333 15.2 6.47523 13.5686 6.73981C10.3323 7.26466 7.59048 7.24926 4.44771 6.7355Z"
                                        fill="#d30e00" />
                                    <path fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M6.35724 12.9114C6.36263 12.4972 6.70276 12.1658 7.11694 12.1712L11.0098 12.2219C11.424 12.2273 11.7553 12.5674 11.7499 12.9816C11.7446 13.3958 11.4044 13.7271 10.9902 13.7217L7.09742 13.6711C6.68324 13.6657 6.35185 13.3256 6.35724 12.9114Z"
                                        fill="#d30e00" />
                                    <path fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M9.08863 10.2501C9.5028 10.2555 9.83419 10.5956 9.8288 11.0098L9.77812 14.9026C9.77273 15.3168 9.4326 15.6482 9.01843 15.6428C8.60425 15.6374 8.27286 15.2972 8.27825 14.8831L8.32893 10.9902C8.33432 10.5761 8.67445 10.2447 9.08863 10.2501Z"
                                        fill="#d30e00" />
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="product-info">
            <h3 class="product-name"><a href="{{ route('front.show-product-detail', $product->slug) }}"
                    title="{{ $product->name }}">{{ $product->name }}</a></h3>
            <div class="price-box">
                @if ($product->base_price > 0 && $product->price > 0)
                    <span class="compare-price">{{ formatCurrency($product->base_price) }}₫</span>
                    <span class="price">{{ formatCurrency($product->price) }}₫
                        {{ $product->unit_id ? ' / ' . $product->unit->name : '' }}</span>
                @elseif ($product->price > 0 && $product->base_price == 0)
                    <span class="price">{{ formatCurrency($product->price) }}₫
                        {{ $product->unit_id ? ' / ' . $product->unit->name : '' }}</span>
                @elseif ($product->price == 0 && $product->base_price > 0)
                    <span class="price">{{ formatCurrency($product->base_price) }}₫
                        {{ $product->unit_id ? ' / ' . $product->unit->name : '' }}</span>
                @else
                    <span class="price">Liên hệ</span>
                @endif
            </div>
        </div>
        <div class="btn-action">
            <a href="javascript:void(0)" class="btn-action-item" ng-click="addToCart({{ $product->id }})"
                title="Thêm vào giỏ hàng">
                <span>Thêm vào giỏ hàng</span>
                <span class="btn-icon" title="Thêm vào giỏ">
                    <svg class="btnico-first" version="1.0" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                        <g transform="translate(0 512) scale(.1 -.1)">
                            <path
                                d="m2371 5100c-150-40-306-141-387-248l-35-48-492-58c-271-32-501-63-512-69-31-16-44-39-45-75 0-32 54-516 64-573 5-25 3-27-44-31-27-3-56-11-65-18s-78-117-155-245l-139-232-86-1660c-47-913-85-1692-85-1730 0-60 3-73 23-91l23-22h2125 2126l21 23c18 19 22 35 22 92 0 37-38 815-85 1728l-86 1660-139 232c-77 128-147 238-156 246-11 9-49 15-106 18-86 3-90 4-84 25 3 11 18 74 33 138 29 128 26 152-19 182-13 8-190 54-393 101-204 47-380 90-391 94-14 6-24 22-28 45-11 60-92 208-153 281-76 91-209 181-324 220-73 25-102 29-219 32-111 2-148-1-209-17zm318-176c139-34 279-140 353-265 21-34 36-64 34-66s-51 8-110 22c-113 28-152 27-180-4-8-9-34-96-56-192-23-95-43-182-46-191-4-14-72-44-80-35-1 1-19 139-39 306-19 167-40 311-44 320-21 39-55 45-163 33-56-7-103-10-106-7-8 8 127 68 183 81 72 18 178 17 254-2zm-329-258c0-2 14-117 30-256 17-139 27-256 23-260s-190-51-413-104c-308-74-410-102-427-118-31-29-30-70 7-220 17-67 30-128 30-135 0-10-45-13-203-13h-203l-56 478c-31 262-56 478-55 478 1 1 283 36 627 77s628 75 633 76c4 0 7-1 7-3zm1105-357c242-56 444-105 449-110 6-5-20-134-64-324l-74-315h-246-246l-82 343c-72 301-85 345-107 365-31 26-65 28-147 6-33-8-61-14-63-12-1 2 7 42 18 89l20 86 51-13c28-7 249-58 491-115zm-495-226c0-5 27-120 60-257 33-136 60-252 60-257s-276-9-643-9h-642l-28 117c-15 64-26 117-24 119 2 1 1194 291 1210 293 4 0 7-2 7-6zm-1980-282c0-9 14-119 25-203l5-38h-100c-55 0-100 3-100 6 0 18 145 244 156 244 8 0 14-4 14-9zm3239-110c39-66 71-122 71-125s-74-6-165-6-165 3-165 8c0 4 12 60 27 125l27 117h67 66l72-119zm155-373c3-35 40-733 81-1553s76-1511 78-1537l4-48h-1987-1987l4 48c2 26 37 717 78 1537s78 1518 81 1553l6 62h1818 1818l6-62z">
                            </path>
                            <path
                                d="m1850 3209c-168-32-260-248-169-395 24-39 82-92 114-104 23-9 23-10 27-242 4-223 5-236 32-313 85-248 285-432 534-492 88-21 256-21 344 0 249 60 449 244 534 492 27 77 28 90 32 312l4 233 34 16c42 20 101 85 121 133 24 55 21 159-6 214-26 53-87 112-140 134-46 20-156 20-202 0-199-83-215-381-26-479l39-19-4-207c-5-237-17-291-88-400-225-349-715-349-940 0-71 109-83 164-88 400l-4 207 39 19c85 44 132 127 133 232 0 175-145 292-320 259z">
                            </path>
                        </g>
                    </svg>
                </span>
            </a>
        </div>
    </form>
</div>
