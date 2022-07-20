@extends('website.layouts.master')

@section('css')
    @livewireStyles
@endsection

@section('content')
    <section class="pt-5">
        <header class="text-center">
            <p class="small text-muted small text-uppercase mb-1">Carefully created collections</p>
            <h2 class="h5 text-uppercase mb-4">Browse our categories</h2>
        </header>
        <div class="row">
            @forelse($product_Category as $row)
                <div class="col-md-4"><a class="category-item" href="{{route('product.slug',$row->slug)}}">
                        @if($row->photo)

                            <img class="img-fluid"
                                 src="{{asset('admin/pictures/category/'. $row->id .'/'. $row->photo->Filename)}}"
                                 alt=""/>
                        @else
                            <img class="img-fluid" src="{{asset('website/img/cat-img-2.jpg')}}" alt=""/>

                        @endif
                        <strong class="category-item-title">{{$row->name}}</strong></a>
                </div>
            @empty

            @endforelse
        </div>
    </section>
    <livewire:website.feature-product />
@endsection


@section('js')
    @livewireScripts
    
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <x-livewire-alert::scripts />
@endsection
