@extends('layouts.frontend')

@section('content')
 <!-- herobanner__start -->
            <div class="herobanner">
                <div class=" container-fluid hero__fullwidth__spacing">

                    <div class="herobanner__inner">
                        <div class="container herobannerarea__slider  slider__default__arrow slider__default__dot">
                            @foreach($latestBooks as $hero)
                                <div class="herobannerarea__slider__single">
                                    <div class="row align-items-center">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 herobanner__text__side">
                                            <div class="herobanner__text__wraper ltn__slide-animation">
                                                <h1 class="herobanner__title herobanner__title__color animated">{{Str::limit($hero->title)}}</h1>
                                                <div class="herobanner__text herobanner__text__color  animated">
                                                    <p>{{Str::limit($hero->description)}}</p>
                                                </div>
                                                <div class="herobanner__button herobanner__button__color  animated">
                                                    <a href="/book/{{$hero->slug}}" class="default__button" tabindex="0">See book details!</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 herobanner__img__side">
                                            <div class="herobanner__img">
                                                <img src="{{ Storage::url($hero->image) }}" alt="{{ $hero->title }}"  style="max-height: 400px; object-fit: contain;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div> 
                    </div>
            </div>
         <!-- herobanner__end -->


          <!-- best__selling__start -->
            <div class="best__selling sp_bottom_80">
                <div class="container">

                    <div class="row mt-5">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="section__title">
                                <h2>Books</h2>
                            </div>
                        </div>
                    </div>

                    <div class="tab-content " id="myTabContent">
                        <div class="tab-pane fade active show" id="projects__one" role="tabpanel" aria-labelledby="projects__one">
                            <div class="row grid__responsive">

                                {{-- Looping book --}}
                                @foreach($book as $data)
                                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6">
                                        <div class="grid__wraper">
                                            <div class="grid__wraper__img">
                                                <div class="grid__wraper__img__inner">
                                                    <a href="/book/{{$data->slug}}">
                                                        <img class="primary__image" src="{{Storage::url($data->image)}}" alt="Primary Image">
                                                        <img class="secondary__image" src="{{Storage::url($data->image)}}" alt="Secondary Image">
                                                    </a>
                                                </div>
                                                <div class="grid__wraper__icon">                                
                                                    <ul>
                                                        <li>
                                                            <span data-bs-toggle="modal" data-bs-target="#bookModal-{{$data->slug}}">
                                                                <a class="quick__view__action" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View" data-bs-original-title="Quick View">
                                                                    <i class="far fa-eye"></i>
                                                                </a>
                                                            </span>
                                                        </li>
            
                                                        <li>
                                                            <a href="{{ route('cart.add', $data->id) }}" data-bs-toggle="tooltip" onclick="event.preventDefault(); document.getElementById('add-to-cart-form-{{ $data->id }}').submit();"
                                                                data-bs-toggle="tooltip" title="Add To Cart">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>    
                                                            
                                                             <form id="add-to-cart-form-{{ $data->id }}"
                                                                action="{{ route('cart.add', $data->id) }}" method="POST"
                                                                class="d-none">
                                                                @csrf
                                                                <input type="hidden" name="qty" value="1">
                                                            </form>
                                                        </li>
                                   
                                                    </ul>   
                                                </div>
            
                                            </div>
                                            <div class="grid__wraper__info">
                                                <h3 class="grid__wraper__tittle">
                                                    <a href="/book/{{$data->slug}}" tabindex="0">{{$data->title}}</a>
                                                </h3>
                                                <div class="grid__wraper__price">
                                                    <span>RP {{number_format($data->price,0,'.','.')}}</span> 
                                                </div>
                                            
                                            </div>
            
                                        </div>
                                    </div>
                                @endforeach
                                {{-- end looping book --}}
        
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="best__selling__button">
                                <a class="default__button" href="{{route('book.index')}}">View All Avalaible Books</a>
                            </div>
                        </div>
                    </div>

                 
                </div>
            </div>
           <!-- best__selling__start -->

        <!-- blog__section__start -->
        
        <!-- blog__section__start -->

        <!-- modal__section__start -->
        @foreach($book as $data)

        <div class="grid__quick__view__modal modalarea modal fade" id="bookModal-{{$data->slug}}" tabindex="-1" aria-labelledby="#book" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body">
                        <div class="row align-items-center">
                    
                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="grid__quick__img">
                                    <img src="{{Storage::url($data->image)}}" alt="">
                                </div>
                            </div>
            
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                <div class="grid__quick__content">
                                    <h3>{{$data->title}}</h3>
                                    <div class="quick__price">
                                        <span>RP {{number_format($data->price,0,'.','.')}}</span>
                                    </div>
                                    <p>{{$data->description}}</p>
                                    <div class="featurearea__quantity">
                                        <a class="default__button" href="/book/{{$data->slug}}">See more details of this book!</a>        
                                    </div>
                                </div>
                            </div>
            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
        <!-- modal__section__end -->

    </div>
@endsection