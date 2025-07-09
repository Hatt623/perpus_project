@extends('layouts.frontend')

@section('content')

 <!-- login__section__start -->
    <div class="loginarea  sp_bottom_80 sp_top_80">
     <div class="container">
        <div class="row">
            <div class="tab-content tab__content__wrapper" id="myTabContent">
                <div class="tab-pane fade active show" id="projects__two" role="tabpanel" aria-labelledby="projects__two">
                    
                    <div class="col-xl-8 offset-md-2 loginarea__col">
                        <div class="loginarea__wraper">
                            <div class="loginarea__heading">
                                <h5 class="login__title">Sign Up</h5>
                                <p class="login__description">Already have an account? <a href="{{ route('login') }}">Log In</a></p>
                            </div>

                            <form  method="POST" action="{{route('register')}}">
                                @csrf

                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="loginarea__form">
                                            <label class="form__label">Username</label>
                                            <input id="name" type="text" class="common__login__input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"placeholder="Username"  required autocomplete="name" autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="loginarea__form">
                                            <label class="form__label">Email</label>
                                            <input id="email"class="common__login__input @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror   
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="loginarea__form">
                                            <label class="form__label">Password</label>
                                            <input id="password" class="common__login__input @error('password') is-invalid @enderror" type="password" placeholder="Password" name="password" required autocomplete="new-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror   
                                        </div>
                                    </div>
                                    
                                    <div class="col-xl-6">
                                        <div class="loginarea__form">
                                            <label class="form__label">Password confirmation</label>
                                            <input id="password-confirm" type="password" class="common__login__input" name="password_confirmation" placeholder="Password confirmation" required autocomplete="new-password">

                                        </div>
                                    </div>
                                </div>

                                <div class="login__button mt-3">
                                    {{-- <a class="default__button text-center" href="#">Sign Up</a> --}}
                                    <button type="submit" class="default__button text-center">Sign up</button>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
    </div>

</body>
@endsection
