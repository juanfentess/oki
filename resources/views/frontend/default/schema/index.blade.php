@extends('frontend::layouts.user')
@section('title')
    {{ __('Investment Plans') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="site-card">
                <div class="site-card-header">
                    <h3 class="title">{{ __('Investment Plans') }}</h3>
                </div>
                <div class="site-card-body">
                    <div class="row">
                        @foreach($schemas as $schema)
                            <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="single-investment-plan" style="position: relative; padding-top: 20px;">

                                    <div class="investment-icon-container" style="display: flex; justify-content: center;">
                                        <img
                                            class="investment-plan-icon"
                                            src="{{ asset($schema->icon) }}"
                                            alt=""
                                            style="width: 80px; height: 80px; object-fit: cover;"
                                        />
                                    </div>

                                    @if($schema->badge)
                                        <div class="feature-plan">{{$schema->badge}}</div>
                                    @endif

                                    <h3>{{$schema->name}}</h3>
                                    <p>{{$schema->schedule->name . ' '. ($schema->interest_type == 'percentage' ? $schema->return_interest.'%' : $currencySymbol.$schema->return_interest ) }}</p>
                                    <ul>
                                        <li>{{ __('Investment') }} <span class="special">
                                            {{ $schema->type == 'range' ? $currencySymbol . $schema->min_amount . '-' . $currencySymbol . $schema->max_amount : $currencySymbol . $schema->fixed_amount }}
                                        </span></li>
                                        <li>{{ __('Capital Back') }}
                                            <span>{{ $schema->capital_back ? 'Yes' : 'No' }}</span></li>
                                        <li>{{ __('Return Type') }} <span>{{ ucwords($schema->return_type) }}</span>
                                        </li>
                                        <li>{{ __('Number of Period') }}
                                            <span>{{ ($schema->return_type == 'period' ? $schema->number_of_period : 'Unlimited').($schema->number_of_period == 1 ? ' Time' : ' Times' )  }}</span>
                                        </li>
                                        <li>{{ __('Profit Withdraw') }} <span>{{ __('Anytime') }}</span></li>
                                        <li>{{ __('Cancel') }}  <span> @if($schema->schema_cancel) {{ __('Within').' '. $schema->expiry_minute .' '. 'Minute' }} @else   {{ __('No') }}@endif</span></li>
                                    </ul>
                                    <div class="holidays"><span class="star">*</span>@if( null != $schema->off_days) {{ implode(', ', json_decode($schema->off_days,true))  .' '.__('are')}}  @else {{ __('No Profit') }} @endif {{ __('Holidays') }}</div>
                                    <a href="{{route('user.schema.preview',$schema->id)}}"
                                       class="site-btn grad-btn w-100 centered invest-now-btn"><i
                                            class="anticon anticon-check"></i>{{ __('Invest Now') }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    /* Animation for the Invest Now button */
    .invest-now-btn {
        animation: pulse 2s infinite;
        background: linear-gradient(135deg, #ff7e5f, #feb47b);
        color: white;
        font-weight: bold;
        transition: transform 0.2s ease-in-out;
    }

    .invest-now-btn:hover {
        transform: scale(1.05);
        box-shadow: 0 0 15px rgba(255, 125, 87, 0.6);
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 5px rgba(255, 125, 87, 0.8), 0 0 10px rgba(255, 125, 87, 0.6), 0 0 15px rgba(255, 125, 87, 0.4);
        }
        50% {
            box-shadow: 0 0 15px rgba(255, 125, 87, 1), 0 0 20px rgba(255, 125, 87, 0.8), 0 0 30px rgba(255, 125, 87, 0.6);
        }
        100% {
            box-shadow: 0 0 5px rgba(255, 125, 87, 0.8), 0 0 10px rgba(255, 125, 87, 0.6), 0 0 15px rgba(255, 125, 87, 0.4);
        }
    }
</style>
