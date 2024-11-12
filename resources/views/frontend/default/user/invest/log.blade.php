@extends('frontend::layouts.user')
@section('title')
    {{ __('My Investments') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="site-card">
                <div class="site-card-header">
                    <h3 class="title">{{ __('All Invested Plans') }}</h3>
                    <p class="swipe-instruction animated-swipe">{{ __('Swipe Right to View Full Page') }}</p>
                </div>
                <div class="site-card-body">
                    <div class="site-datatable">
                        <div class="row table-responsive">
                            <div class="col-xl-12">
                                <table id="dataTable" class="display data-table">
                                    <thead>
                                    <tr>
                                        <th>{{ __('Icon') }}</th>
                                        <th>{{ __('Plan') }}</th>
                                        <th>{{ __('ROI') }}</th>
                                        <th>{{ __('Profit') }}</th>
                                        <th>{{ __('Period Remaining') }}</th>
                                        <th>{{ __('Capital Back') }}</th>
                                        <th>{{ __('Next Payout') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        (function ($) {
            "use strict";
            var table = $('#dataTable').DataTable({
                processing: false,
                serverSide: true,
                ajax: "{{ route('user.invest-logs') }}",
                columns: [
                    {data: 'icon', name: 'icon'},
                    {data: 'schema', name: 'schema'},
                    {data: 'rio', name: 'rio'},
                    {data: 'profit', name: 'profit'},
                    {data: 'period_remaining', name: 'period_remaining'},
                    {data: 'capital_back', name: 'capital_back'},
                    {data: 'next_profit_time', name: 'next_profit_time'},
                ]
            });
        })(jQuery);
    </script>
@endsection

<style>
    .swipe-instruction {
        font-size: 0.85rem;
        color: #FF6F61;
        text-align: center;
        animation: swipeTextAnimation 2s ease-in-out infinite;
    }

    @keyframes swipeTextAnimation {
        0%, 100% {
            opacity: 0;
            transform: translateX(-10px);
        }
        50% {
            opacity: 1;
            transform: translateX(0);
        }
    }
</style>
