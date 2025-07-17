@extends('layouts.frontend')

@section('content')

    <main class="main_wrapper body__overlay overflow__hidden">

      <!-- breadcrumb__start -->
      <div class="breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb__title">
                        <h1>Login</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- breadcrumb__end -->


 <!-- login__section__start -->
    <div class="loginarea  sp_bottom_80 sp_top_80">
     <div class="container">
        <div class="row">
            <div class="tab-content tab__content__wrapper" id="myTabContent">

                <div class="tab-pane fade active show" id="projects__one" role="tabpanel" aria-labelledby="projects__one">
                    <div class="col-xl-8 offset-md-2 loginarea__col">
                        <div class="loginarea__wraper">
                            <div class="loginarea__heading">
                                <h5 class="login__title">Login</h5>
                                <p class="login__description">Don't have an account yet? <a href="{{ route('register') }}" >Sign up for free</a></p>
                            </div>

                            <form method="POST" action="{{route ('login')}}">
                                @csrf

                                <div class="loginarea__form">
                                    <label class="form__label">Email</label>
                                    <input id="email" class="common__login__input @error('email') is-invalid @enderror" type="email" placeholder="Insert You're Email..."  name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="loginarea__form">
                                    <label class="form__label">Password</label>
                                    <input id="password" class="common__login__input @error('password') is-invalid @enderror" type="password" placeholder="Insert You're Password..." name="password" required autocomplete="current-password">

                                     @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="loginarea__button text-center">
                                    <button type="submit" class="default__button">Log In</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>

        </div>

    </div>
    </div>

    </main>


</body>
@endsection
