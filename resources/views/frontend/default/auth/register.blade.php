@extends('frontend::layouts.auth')

@section('title')
    {{ __('Register') }}
@endsection

@section('content')

<!-- Enhanced Investment Theme Register Section with Raining Money and Snow Effect -->
<section class="section-style site-auth" style="background: linear-gradient(135deg, #0f0c29, #302b63, #24243e); min-height: 100vh; display: flex; align-items: center; justify-content: center; overflow: hidden; position: relative;">
    
    <!-- Raining Money and Snow Overlay -->
    <div class="money-snow-overlay">
        <div class="falling-money-snow dollar" style="--i:1;">💵</div>
        <div class="falling-money-snow euro" style="--i:2;">💶</div>
        <div class="falling-money-snow snowflake" style="--i:3;">❄️</div>
        <div class="falling-money-snow dollar" style="--i:4;">💵</div>
        <div class="falling-money-snow euro" style="--i:5;">💶</div>
        <div class="falling-money-snow snowflake" style="--i:6;">❄️</div>
        <div class="falling-money-snow dollar" style="--i:7;">💵</div>
        <div class="falling-money-snow euro" style="--i:8;">💶</div>
        <div class="falling-money-snow snowflake" style="--i:9;">❄️</div>
        <div class="falling-money-snow dollar" style="--i:10;">💵</div>
        <div class="falling-money-snow euro" style="--i:11;">💶</div>
        <div class="falling-money-snow snowflake" style="--i:12;">❄️</div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-md-12">
                <div class="auth-content p-5 rounded shadow-lg text-center animate__animated animate__fadeInUp" style="background: rgba(255, 255, 255, 0.95); border-radius: 20px; animation-duration: 1.2s; position: relative; z-index: 10;">
                    
                    <!-- Spinning Logo -->
                    <div class="logo mb-4 animate__animated animate__pulse" style="animation-duration: 2s; animation-iteration-count: infinite;">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset(setting('site_logo','global')) }}" alt="Logo" class="spinning-logo" style="width: 80px; filter: drop-shadow(0 0 10px #FFD700);">
                        </a>
                    </div>

                    <!-- Title Section -->
                    <div class="title mb-4">
                        <h2 class="fw-bold" style="color: #333; font-size: 1.8rem;">Create an Account</h2>
                        <p style="color: #777; font-size: 1rem;">Register to continue with Kryptexa</p>
                    </div>

                    <!-- Error Messages with Animation -->
                    @if ($errors->any())
                        <div class="alert alert-warning alert-dismissible fade show animate__animated animate__shakeX" role="alert" style="animation-duration: 0.8s;">
                            @foreach($errors->all() as $error)
                                <strong>{{ __('You Entered') }} {{ $error }}</strong>
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Register Form -->
                    <div class="site-auth-form">
                        <form method="POST" action="{{ route('register') }}" class="row">
                            @csrf
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="single-field">
                                    <label class="box-label" for="first_name">{{ __('First Name') }}<span class="required-field">*</span></label>
                                    <input
                                        class="box-input form-control shadow-sm"
                                        type="text"
                                        placeholder="Your First Name"
                                        name="first_name"
                                        value="{{ old('first_name') }}"
                                        required
                                        style="border-radius: 30px; background-color: #f0f3f8;"
                                        onfocus="this.style.background='#fef3c7'"
                                        onblur="this.style.background='#f0f3f8'"
                                    />
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="single-field">
                                    <label class="box-label" for="last_name">{{ __('Last Name') }}<span class="required-field">*</span></label>
                                    <input
                                        class="box-input form-control shadow-sm"
                                        type="text"
                                        placeholder="Your Last Name"
                                        name="last_name"
                                        value="{{ old('last_name') }}"
                                        required
                                    />
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="single-field">
                                    <label class="box-label" for="email">{{ __('Email Address') }}<span class="required-field">*</span></label>
                                    <input
                                        class="box-input form-control shadow-sm"
                                        type="email"
                                        name="email"
                                        placeholder="Enter Your Email Address"
                                        value="{{ old('email') }}"
                                        required
                                    />
                                </div>
                            </div>

                            @if(getPageSetting('username_show'))
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="single-field">
                                        <label class="box-label" for="username">{{ __('User Name') }}<span class="required-field">*</span></label>
                                        <input
                                            class="box-input form-control shadow-sm"
                                            type="text"
                                            placeholder="Enter Your User Name"
                                            name="username"
                                            value="{{ old('username') }}"
                                            required
                                        />
                                    </div>
                                </div>
                            @endif

                            @if(getPageSetting('country_show'))
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="single-field">
                                        <label class="box-label" for="country">{{ __('Select Country') }}<span class="required-field">*</span></label>
                                        <select name="country" id="countrySelect" class="site-nice-select form-control shadow-sm">
                                            @foreach(getCountries() as $country)
                                                <option @if($location->country_code == $country['code']) selected @endif value="{{ $country['name'].':'.$country['dial_code'] }}">
                                                    {{ $country['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif

                            @if(getPageSetting('phone_show'))
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
    <div class="single-field">
        <label class="box-label" for="phone">{{ __('Phone Number') }}<span class="required-field">*</span></label>
        <input
            type="tel"
            id="phone"
            class="form-control shadow-sm"
            placeholder="Phone Number"
            name="phone"
            value="{{ old('phone') }}"
            required
        />
    </div>
</div>

                            @endif

                            @if(getPageSetting('referral_code_show'))
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="single-field">
                                        <label class="box-label" for="invite">{{ __('Referral Code') }}</label>
                                        <input
                                            class="box-input form-control shadow-sm"
                                            type="text"
                                            placeholder="Enter Your Referral Code"
                                            name="invite"
                                            value="{{ request('invite') ?? old('invite') }}"
                                        />
                                    </div>
                                </div>
                            @endif

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="single-field">
                                    <label class="box-label" for="password">{{ __('Password') }}<span class="required-field">*</span></label>
                                    <input
                                        class="box-input form-control shadow-sm"
                                        type="password"
                                        name="password"
                                        placeholder="Enter your password"
                                        required
                                    />
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="single-field">
                                    <label class="box-label" for="password_confirmation">{{ __('Confirm Password') }}<span class="required-field">*</span></label>
                                    <input
                                        class="box-input form-control shadow-sm"
                                        type="password"
                                        name="password_confirmation"
                                        placeholder="Confirm your password"
                                        required
                                    />
                                </div>
                            </div>

                            <!-- Terms and Conditions Checkbox -->
                            <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                                <div class="single-field">
                                    <input
                                        class="form-check-input check-input"
                                        type="checkbox"
                                        name="i_agree"
                                        value="yes"
                                        id="flexCheckDefault"
                                        required
                                    />
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ __('I agree with') }}
                                        <a href="{{url('/privacy-policy')}}">{{ __('Privacy & Policy') }}</a> {{ __('and') }}
                                        <a href="{{url('/terms-and-conditions')}}">{{ __('Terms & Condition') }}</a>
                                    </label>
                                </div>
                            </div>

                            <!-- Submit Button with Financial Icon -->
                            <div class="col-xl-12">
                                <button type="submit" class="btn w-100 py-3 text-white shadow animate__animated animate__pulse animate__infinite" style="background: linear-gradient(135deg, #FFD700, #ff9505); border-radius: 30px; font-size: 1.1rem; font-weight: bold;">
                                    <i class="fas fa-coins me-2"></i> {{ __('Create Account') }}
                                </button>
                            </div>
                        </form>

                        <!-- Login Redirect -->
                        <div class="signup-text mt-4 animate__animated animate__fadeInUp" style="animation-delay: 0.8s;">
                            <p>{{ __('Already have an account?') }} <a href="{{ route('login') }}" class="fw-bold" style="color: #ff9505;">{{ __('Login') }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

@section('script')
    @if($googleReCaptcha)
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif
    <script>
        // Initialize intl-tel-input plugin
        const phoneInputField = document.querySelector("#phone");
        const phoneInput = window.intlTelInput(phoneInputField, {
            preferredCountries: ["us", "xk", "al", "mk", "de", "ch"],
            separateDialCode: true,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        });

        $('#countrySelect').on('change', function (e) {
            e.preventDefault();
            var country = $(this).val();
            $('#dial-code').html(country.split(":")[1]);
        });
    </script>
@endsection

<style>
    .money-snow-overlay { /* Styles for animation */ }
    .falling-money-snow { /* Styles for animation */ }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection
