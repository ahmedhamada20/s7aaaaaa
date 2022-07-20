<div>
    <section class="py-5">
        <header>
            <p class="small text-muted small text-uppercase mb-1">Made the hard way</p>
            <h2 class="h5 text-uppercase mb-4">Ahmed</h2>
        </header>

        <div class="row">
            @forelse($feature_products as $prodcut)
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="product text-center">
                        <div class="position-relative mb-3">
                            <div class="badge text-white bg-"></div>
                            <a class="d-block" href="detail.html">
                                @if($prodcut->photo)
                                    <img class="img-fluid w-100"
                                         src="{{asset('admin/pictures/product/'.$prodcut->id .'/'.$prodcut->photo->Filename)}}"
                                         alt="..."></a>
                            @else
                                <img class="img-fluid w-100" src="{{asset('website/img/product-1.jpg')}}" alt="..."></a>
                            @endif

                            <div class="product-overlay">
                                <ul class="mb-0 list-inline">
                                    <li class="list-inline-item m-0 p-0">
                                        <a class="btn btn-sm btn-outline-dark"
                                           href="#!"><i class="far fa-heart"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item m-0 p-0">
                                        <a class="btn btn-sm btn-dark"
                                           href="cart.html">Add to cart</a>
                                    </li>
                                    <li class="list-inline-item me-0">
                                        <!-- Button trigger modal -->
                                        <a class="btn btn-sm btn-outline-dark" wire:click="$emit('showProductModel','{{$prodcut->slug}}')" data-bs-toggle="modal" data-bs-target="#productview"><i class="fas fa-expand"></i>

                                        </a>
{{--                                        <a class="btn btn-sm btn-outline-dark" wire:click="$emit('showProductModel','{{$prodcut->slug}}')"  data-bs-target="#productview" data-toggle="modal"><i class="fas fa-expand"></i></a>--}}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <h6><a class="reset-anchor" href="detail.html">{{$prodcut->name}}</a></h6>
                        <p class="small text-muted">{{$prodcut->price}}</p>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
        <livewire:website.product-model-show />
    </section>
</div>
