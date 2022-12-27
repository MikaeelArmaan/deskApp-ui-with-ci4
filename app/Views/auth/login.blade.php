@extends('theme.auth')

@section('content')
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="login.html">
                    <img src="vendors/images/deskapp-logo.svg" alt="">
                </a>
            </div>
            <div class="login-menu">
                <ul>
                    <li><a href="{{ route_to('register') }}">{{ 'Register' }}</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="vendors/images/login-page-img.png" alt="">
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Login To DeskApp</h2>
                        </div>
                        <form class="user" method="POST">
                            @csrf

                            <div id="status" class="collapse">
                                <div class="alert alert-danger" role="alert"></div>
                            </div>
                            @if ($err = session('error'))
                                <div id="status" class="">
                                    <div class="alert alert-danger" role="alert">{{ $err }}</div>
                                </div>
                            @endif

                            <div class="input-group custom">
                                <input id="email" type="email" class="form-control form-control-user" name="email"
                                    required autocomplete="email" autofocus placeholder="Enter Email Address...">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input id="password" type="password" class="form-control form-control-lg" name="password"
                                    required autocomplete="current-password" placeholder="Enter Password...">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            <div class="row pb-30">
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="remember" id="remember">
                                        <label class="custom-control-label" for="remember">Remember Me</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="forgot-password">
                                        @if (true)
                                            <a class="small" href="{{ route_to('password.request') }}">
                                                {{ 'Forgot Your Password?' }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <!-- use code for form submit  <input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In"> -->
                                        <button type="submit" id="login" class="btn btn-primary btn-lg btn-block">
                                            LOGIN <i class="fas fa-arrow-circle-right"></i>
                                        </button>
                                    </div>
                                    <div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">OR
                                    </div>
                                    <div class="input-group mb-0">
                                        <a class="small btn btn-outline-primary btn-lg btn-block"
                                            href="{{ route_to('register') }}">
                                            {{ 'Register To Create Account!' }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- js -->
    <script type="text/javascript">
        $(document).on('submit', '.user', (e) => {
            e.preventDefault();
            $(".pre-loader").show();
            let data = $('form').serialize();
            let url = '{{ route_to('login.post') }}';

            $.ajax({
                    data: data,
                    url: url,
                    type: 'POST',
                    beforeSend: () => {
                        $('#login').prop('disabled', true);
                        $('.invalid-feedback').remove();
                        $('.form-control').removeClass('is-invalid');
                        $('#status').collapse('hide')
                            .find('div')
                            .attr('class', 'alert')
                            .html('');

                    },
                    success: (response) => {
                        $(".pre-loader").hide();
                        Cookies.set('token', response.access_token, {
                            expires: new Date(new Date().getTime() + response.expires_in * 60 *
                                1000)
                        });

                        return setTimeout(() => {
                            window.location = "{{ route_to('dashboard.index') }}";
                        }, 1000);
                    },
                    error: (response) => {
                        $(".pre-loader").hide();
                        $.each(response.responseJSON.messages, (key, val) => {
                            if (key === 'error') {
                                $('#status').collapse('show')
                                    .find('.alert')
                                    .addClass('alert-danger')
                                    .html(val);
                            }

                            $('#' + key).addClass('is-invalid')
                                .after('<small class="invalid-feedback">' + val + '</small>');
                        });

                        if (response.responseJSON.message) {
                            $('#status').collapse('show')
                                .find('.alert')
                                .addClass('alert-danger')
                                .html(response.responseJSON.message);
                        }
                    }
                })
                .always(() => {
                    $('#login').prop('disabled', false);
                });
        });
    </script>
@endpush
