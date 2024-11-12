@extends('frontend::layouts.user')
@section('title')
    {{ __('Withdraw Account') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="site-card animate__animated animate__fadeIn" style="animation-duration: 0.8s;">
                <div class="site-card-header d-flex align-items-center justify-content-between">
                    <h3 class="title"><i class="fas fa-wallet text-primary me-2"></i>{{ __('Withdraw Account') }}</h3>
                    <div class="card-header-links">
                        <a href="{{ route('user.withdraw.account.create') }}" class="btn btn-primary shadow-sm" title="Add a new withdrawal account">
                            <i class="fas fa-plus-circle"></i> {{ __('Add New') }}
                        </a>
                    </div>
                </div>

                <div class="site-card-body">
                    <!-- Tips Section with an Icon and Pulse Effect -->
                    <div class="tips-section mb-4 animate__animated animate__pulse" style="animation-duration: 2s; animation-iteration-count: infinite;">
                        <div class="alert alert-info d-flex align-items-center" role="alert" style="border-radius: 10px;">
                            <i class="fas fa-info-circle me-2 text-info" style="font-size: 1.2rem;"></i>
                            <div>
                                {{ __('Tip: Keep your withdrawal account information up-to-date to avoid delays.') }}
                            </div>
                        </div>
                    </div>

                    <div class="site-transactions">
                        @if($accounts->isEmpty())
                            <!-- Placeholder with Animation and Icon -->
                            <div class="text-center my-5 animate__animated animate__zoomIn" style="animation-delay: 0.5s;">
                                <img src="{{ asset('assets/images/no-data.svg') }}" alt="No Data" style="width: 100px; opacity: 0.6;">
                                <p class="mt-3 text-muted" style="font-size: 1rem;">{{ __('No withdrawal accounts found. Click "Add New" to create one.') }}</p>
                            </div>
                        @else
                            <!-- Loop Through Accounts with Enhanced Styling and Hover Effects -->
                            @foreach($accounts as $account)
                                <div class="single p-3 mb-3 rounded shadow-sm d-flex align-items-center justify-content-between" style="background-color: #f0f3f8; border-left: 5px solid #4b7bec; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                                    <div class="left d-flex align-items-center">
                                        <div class="icon me-3">
                                            <i class="fas fa-university text-primary" style="font-size: 1.5rem;"></i>
                                        </div>
                                        <div class="content">
                                            <div class="title fw-bold" style="color: #333;">{{ $account->method_name }}</div>
                                            <div class="date text-muted">{{ $account->method->currency . ' ' . __('Account') }} </div>
                                        </div>
                                    </div>
                                    <div class="right">
                                        <a href="{{ route('user.withdraw.account.edit', $account->id) }}" class="btn btn-outline-secondary btn-sm" title="Edit Account" style="border-radius: 20px;">
                                            <i class="fas fa-edit"></i> {{ __('Edit') }}
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Styles and Effects -->
    <style>
        /* Hover effect on account cards */
        .single:hover {
            transform: scale(1.05);
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1);
        }

        /* Tooltip styling */
        .btn[title] {
            position: relative;
            cursor: pointer;
        }
        .btn[title]::after {
            content: attr(title);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background-color: #333;
            color: #fff;
            padding: 5px 8px;
            border-radius: 5px;
            opacity: 0;
            visibility: hidden;
            white-space: nowrap;
            transition: opacity 0.2s ease, visibility 0.2s ease;
            font-size: 0.875rem;
            margin-bottom: 5px;
            pointer-events: none;
        }
        .btn[title]:hover::after {
            opacity: 1;
            visibility: visible;
        }

        /* Pulse effect on tip section */
        .tips-section {
            animation: pulse 2s infinite;
        }

        /* Define animation */
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.02);
            }
        }
    </style>

    <!-- Include FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection
