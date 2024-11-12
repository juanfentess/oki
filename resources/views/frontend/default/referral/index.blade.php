@extends('frontend::layouts.user')
@section('title')
    {{ __('Dashboard') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="site-card animated-card">
                <div class="site-card-header header-glow">
                    <h3 class="title">
                        <i class="anticon anticon-network"></i> {{ __('Referral URL and Tree') }}
                    </h3>
                </div>
                <div class="site-card-body">
                    <div class="referral-link link-glow">
                        <div class="referral-link-form">
                            <input type="text" value="{{ $getReferral->link }}" id="refLink" class="glow-input" />
                            <button type="submit" onclick="copyRef()" class="animated-copy-btn">
                                <i class="anticon anticon-copy"></i>
                                <span id="copy">{{ __('Copy URL') }}</span>
                                <input id="copied" hidden value="{{ __('Copied!') }}">
                            </button>
                        </div>
                        <p class="referral-joined">
                            {{ $getReferral->relationships()->count() }} {{ __('people have joined using this URL') }}
                        </p>
                        <div class="referral-tips tips-animated">
                            <i class="anticon anticon-info-circle"></i> 
                            {{ __('Share this link with friends to earn referral bonuses!') }}
                        </div>
                    </div>

                    @if(setting('site_referral','global') == 'level' && auth()->user()->referrals->count() > 0)
                        <section class="management-hierarchy">
                            <div class="hv-container">
                                <div class="hv-wrapper">
                                    @include('frontend::referral.include.__tree',['levelUser' => auth()->user(),'level' => $level,'depth' => 1, 'me' => true])
                                </div>
                            </div>
                        </section>
                    @else
                        <p class="no-referrals-message">{{ __('No Referral user found') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12">
            <div class="site-card animated-card">
                <div class="site-card-header header-glow">
                    <h3 class="title">
                        <i class="anticon anticon-wallet"></i> {{ __('All Referral Logs') }}
                    </h3>
                    <div class="card-header-links profit-glow">
                        <span class="referral-profit-label">
                            <i class="anticon anticon-dollar"></i> {{ __('Referral Profit:') }}
                        </span>
                        <span class="referral-profit-amount">
                            {{ $totalReferralProfit . ' ' . $currency }}
                        </span>
                    </div>
                </div>
                <div class="site-card-body table-responsive">
                    <div class="site-datatable">
                        <p class="no-referrals-message">{{ __('No referral logs found.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function copyRef() {
            var copyApi = document.getElementById("refLink");
            copyApi.select();
            copyApi.setSelectionRange(0, 999999999);
            document.execCommand('copy');
            $('#copy').text($('#copied').val());
            $('#copy').css({color: 'green', fontWeight: 'bold'}).text('Copied!');
            setTimeout(() => $('#copy').css({color: 'white', fontWeight: 'normal'}).text('Copy URL'), 1000);
            triggerDollarRain();
        }
        
        function triggerDollarRain() {
            for (let i = 0; i < 10; i++) {
                let dollar = $('<div class="dollar">$</div>');
                $('body').append(dollar);
                dollar.css({
                    left: Math.random() * window.innerWidth + 'px',
                    animationDelay: Math.random() * 1.5 + 's'
                });
                setTimeout(() => dollar.remove(), 3000);
            }
        }
    </script>
@endsection

<style>
    /* Main Card Styles */
    .site-card {
        background: linear-gradient(135deg, #F9A8D4, #FF5E3A);
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);
        animation: fadeIn 1.5s;
    }

    /* Header Styles */
    .header-glow {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px;
        border-radius: 8px;
        background-color: #FF7F50;
        color: white;
        font-weight: bold;
        box-shadow: 0px 0px 15px rgba(255, 127, 80, 0.5);
    }

    .header-glow .title {
        display: flex;
        align-items: center;
    }

    .header-glow .title i {
        margin-right: 8px;
        font-size: 1.2rem;
        color: #FFF5EE;
    }

    /* Referral Profit Display */
    .profit-glow {
        display: flex;
        align-items: center;
        background: #FFD700;
        padding: 5px 10px;
        border-radius: 5px;
        color: #333;
        font-weight: bold;
        animation: glowEffect 2s infinite alternate;
    }

    .referral-profit-label {
        font-size: 0.9rem;
        color: #333;
    }

    .referral-profit-amount {
        margin-left: 5px;
        font-size: 1rem;
        color: #800080;
    }

    /* Glowing Input */
    .glow-input {
        animation: pulse 2s infinite;
        background: #1e272e;
        color: #ffffff;
        padding: 10px;
        border-radius: 5px;
        border: none;
    }

    /* Dollar Rain Animation */
    .dollar {
        position: fixed;
        font-size: 1.5rem;
        color: #ffd700;
        animation: fall 3s forwards;
        pointer-events: none;
    }

    /* Button Animations */
    .animated-copy-btn {
        background: linear-gradient(135deg, #ff7e5f, #ffcc00);
        color: white;
        font-weight: bold;
        padding: 10px 20px;
        border-radius: 5px;
        transition: transform 0.2s ease;
    }

    .animated-copy-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 0 10px rgba(255, 204, 0, 0.8);
    }

    /* Tooltip Animation */
    .tips-animated {
        font-size: 0.9rem;
        color: #ffffff;
        display: flex;
        align-items: center;
        padding: 10px;
        border-radius: 8px;
        animation: slideIn 1.5s ease-in-out;
        color: #ff7e5f;
    }

    /* Empty Referral Logs Message */
    .no-referrals-message {
        color: #ff7e5f;
        text-align: center;
        padding: 10px;
        font-weight: bold;
        animation: pulse 1.5s infinite alternate;
    }

    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes glowEffect {
        0% { box-shadow: 0 0 5px #ff7e5f; }
        100% { box-shadow: 0 0 15px #FFD700; }
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    @keyframes fall {
        0% { opacity: 1; transform: translateY(-100px) rotate(0); }
        100% { opacity: 0; transform: translateY(100vh) rotate(360deg); }
    }

    @keyframes slideIn {
        from { transform: translateX(-50%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
</style>
