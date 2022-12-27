@extends('theme.main')

@section('content')
    <!-- Page Heading -->
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Dashboard</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>

    <div class="row clearfix progress-box">
        <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
            <div class="card-box pd-30 height-100-p">
                <div class="progress-box text-center">
                    <input type="text" class="knob dial1" value="{{ $roles }}" data-width="120" data-height="120"
                        data-linecap="round" data-thickness="0.12" data-bgColor="#fff" data-fgColor="#1b00ff"
                        data-angleOffset="180" readonly>
                    <h5 class="text-blue padding-top-10 h5">{{ 'Roles' }}</h5>
                    <span class="d-block">{{ $roles }} <i class="fa fa-line-chart text-blue"></i></span>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
            <div class="card-box pd-30 height-100-p">
                <div class="progress-box text-center">
                    <input type="text" class="knob dial2" value="{{ $permissions }}" data-width="120" data-height="120"
                        data-linecap="round" data-thickness="0.12" data-bgColor="#fff" data-fgColor="#00e091"
                        data-angleOffset="180" readonly>
                    <h5 class="text-light-green padding-top-10 h5">{{ 'Permissions' }}</h5>
                    <span class="d-block">{{ $permissions }} <i class="fa fa-line-chart text-blue"></i></span>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
            <div class="card-box pd-30 height-100-p">
                <div class="progress-box text-center">
                    <input type="text" class="knob dial3" value="{{ $activities }}" data-width="120" data-height="120"
                        data-linecap="round" data-thickness="0.12" data-bgColor="#fff" data-fgColor="#f56767"
                        data-angleOffset="180" readonly>
                    <h5 class="text-light-orange padding-top-10 h5">{{ 'Activities' }}</h5>
                    <span class="d-block">{{ $activities }} <i class="fa fa-line-chart text-blue"></i></span>
                </div>
            </div>
        </div>


        <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
            <div class="card-box pd-30 height-100-p">
                <div class="progress-box text-center">
                    <input type="text" class="knob dial4" value="{{ $users }}" data-width="120" data-height="120"
                        data-linecap="round" data-thickness="0.12" data-bgColor="#fff" data-fgColor="#a683eb"
                        data-angleOffset="180" readonly>
                    <h5 class="text-light-purple padding-top-10 h5">{{ 'Users' }}</h5>
                    <span class="d-block">{{ $users }} <i class="fa fa-line-chart text-blue"></i></span>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Row -->
@endsection

@push('scripts')
    <script src="{{ base_url('src/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="src/plugins/jQuery-Knob-master/jquery.knob.min.js"></script>
    <script src="{{ base_url('vendors/scripts/dashboard2.js') }}"></script>
@endpush
