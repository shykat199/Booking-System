@extends('layouts.app')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6 col-12">
                        <h2>Welcome To Dashboard</h2>
                        <p class="mb-0 text-title-gray">Welcome back! Let’s start from where you left.</p>
                    </div>

                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid default-dashboard">
            <div class="row">
                <div class="col-xl-12 proorder-xxl-1 col-sm-12 box-col-12">
                    <div class="card welcome-banner">
                        <div class="card-header p-0 card-no-border">
                            <div class="welcome-card">
                                <img class="w-100 img-fluid" src="{{asset('assets/images/dashboard-1/welcome-bg.png')}}" alt=""/>
                                <img class="position-absolute img-1 img-fluid" src="{{asset('assets/images/dashboard-1/img-1.png')}}" alt=""/>
                                <img class="position-absolute img-2 img-fluid" src="{{asset('assets/images/dashboard-1/img-2.png')}}" alt=""/>
                                <img class="position-absolute img-3 img-fluid" src="{{asset('assets/images/dashboard-1/img-3.png')}}" alt=""/>
                                <img class="position-absolute img-4 img-fluid" src="{{asset('assets/images/dashboard-1/img-4.png')}}" alt=""/>
                                <img class="position-absolute img-5 img-fluid" src="{{asset('assets/images/dashboard-1/img-5.png')}}" alt=""/>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-center">
                                <h1>Hello, Dear  <img src="{{asset('assets/images/dashboard-1/hand.png')}}" alt=""/></h1>
                            </div>
                            <p> Welcome back! Let’s start from where you left.</p>
                            <div class="d-flex align-center justify-content-between"><a class="btn btn-pill btn-primary" href="#">Whats New!</a><span>
                        <svg class="stroke-icon">
                          <use href="../assets/svg/icon-sprite.svg#watch"></use>
                        </svg> {{\Carbon\Carbon::now()->format('H:i a')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
