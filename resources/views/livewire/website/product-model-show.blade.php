<div wire:ignore.self class="modal fade" id="productview" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content overflow-hidden border-0">
            <button class="btn-close p-4 position-absolute top-0 end-0 z-index-20 shadow-0" type="button"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body p-0">
                @if($ProductModelCount )
                    <div class="row align-items-stretch">
                        <div class="col-lg-6 p-lg-0">
                            @forelse($ProductModel->photos as $row)
                                @if($loop->first)
                                    <a
                                        class="glightbox  product-view d-block h-100 bg-cover bg-center"
                                        style="background: url('{{asset('admin/pictures/product/'.$ProductModel->id .'/'.$row->Filename)}}')"
                                        href="{{asset('admin/pictures/product/'.$ProductModel->id .'/'.$row->Filename)}}"
                                        data-gallery="gallery1" data-glightbox="Red digital smartwatch"
                                        title="{{$ProductModel->name}}">
                                    </a>
                                @else
                                    <a class="glightbox d-none" title="{{$ProductModel->name}}"
                                       href="{{asset('admin/pictures/product/'.$ProductModel->id .'/'.$row->Filename)}}"
                                       data-gallery="gallery1" data-glightbox="Red digital smartwatch"></a>
                                @endif
                            @empty
                                <img class="img-fluid w-100" src="{{asset('website/img/product-1.jpg')}}" alt="...">
                            @endforelse
                        </div>
                        <div class="col-lg-6">
                            <div class="p-4 my-md-4">
                                <ul class="list-inline mb-2">
                                    @if($ProductModel->reviews_avg_rating != null)
                                        @for($i=0;$i<5;$i++)
                                            @if(round($ProductModel->reviews_avg_rating) > $i)
                                                <li class="list-inline-item m-0"><i
                                                        class="fas fa-star small text-warning"></i></li>
                                            @else
                                                <li class="list-inline-item m-0"><i
                                                        class="far fa-star small text-warning"></i></li>
                                            @endif
                                        @endfor

                                    @else
                                        <li class="list-inline-item m-0"><i class="far fa-star small text-warning"></i>
                                        </li>
                                        <li class="list-inline-item m-0 1"><i
                                                class="far fa-star small text-warning"></i>
                                        </li>
                                        <li class="list-inline-item m-0 2"><i
                                                class="far fa-star small text-warning"></i>
                                        </li>
                                        <li class="list-inline-item m-0 3"><i
                                                class="far fa-star small text-warning"></i>
                                        </li>
                                        <li class="list-inline-item m-0 4"><i
                                                class="far fa-star small text-warning"></i>
                                        </li>

                                    @endif

                                </ul>
                                <h2 class="h4">{{$ProductModel->name}}</h2>
                                <p class="text-muted">${{$ProductModel->price}}</p>
                                <p class="text-sm mb-4">{{$ProductModel->description}}</p>
                                <div class="row align-items-stretch mb-4 gx-0">
                                    <div class="col-sm-7">
                                        <div class="border d-flex align-items-center justify-content-between py-1 px-3">
                                            <span class="small text-uppercase text-gray mr-4 no-select">Quantity</span>
                                            <div class="quantity">
                                                <button class="p-0" wire:click="decQunitiny()"><i class="fas fa-caret-left"></i></button>
                                                <input type="text" wire:model="quantity"
                                                       class="form-control border-0 shadow-0 p-0">
                                                <button class="p-0" wire:click="incQunitiny()"><i class="fas fa-caret-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-5"><a
                                            class="btn btn-dark btn-sm w-100 h-100 d-flex align-items-center justify-content-center px-0"
                                            href="cart.html">Add to cart</a></div>
                                </div>
                                <a class="btn btn-link text-dark text-decoration-none p-0" href="#!"><i
                                        class="far fa-heart me-2"></i>Add to wish list</a>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
