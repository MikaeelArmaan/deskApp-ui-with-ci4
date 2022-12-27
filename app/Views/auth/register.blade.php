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
                    <li><a href="{{ route_to('login') }}">{{ 'Login' }}</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="vendors/images/register-page-img.png" alt="">
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

                            <div class="input-group custom">
                                <input id="name" type="text" class="form-control form-control-user" name="name"
                                    required autocomplete="name" autofocus autofocus placeholder="Enter Username...">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                            </div>

                            <div class="input-group custom">
                                <input id="email" type="email" class="form-control form-control-user" name="email"
                                    required autocomplete="email" autofocus placeholder="Enter Email Address...">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-email"></i></span>
                                </div>
                            </div>


                            <div class="input-group custom">
                                <input id="password" type="password" class="form-control form-control-user" name="password"
                                    required autocomplete="new-password" autofocus placeholder="Enter Password...">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input id="repeat_password" type="password" class="form-control form-control-user"
                                    name="repeat_password" required autocomplete="new-password"autofocus
                                    placeholder="Enter Repeat Password...">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>


                            <div class="form-group">
                                <button type="submit" id="register" class="btn btn-primary btn-user btn-block">
                                    REGISTER <i class="fas fa-arrow-circle-right"></i>
                                </button>
                                <hr>
                            </div>

                            <div class="form-group text-center">
                                <a class="small" href="{{ route_to('login') }}">
                                    {{ 'Already Have an Account?' }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            @endsection

            @push('scripts')
                <script type="text/javascript">
                    $(document).on('submit', '.user', (e) => {
                        e.preventDefault();
                        $(".pre-loader").show();
                        let data = $('form').serialize();
                        let url = '{{ route_to('register.post') }}';

                        $.ajax({
                                data: data,
                                url: url,
                                type: 'POST',
                                beforeSend: () => {
                                    $('#register').prop('disabled', true);
                                    $('.invalid-feedback').remove();
                                    $('.form-control').removeClass('is-invalid');
                                    $('#status').collapse('hide')
                                        .find('div')
                                        .attr('class', 'alert')
                                        .html('');
                                },
                                success: (response) => {
                                    Cookies.set('token', response.data.access_token, {
                                        expires: response.data.expires_in
                                    });
                                    $(".pre-loader").hide();
                                    $('#status').collapse('show')
                                        .find('.alert')
                                        .addClass('alert-success')
                                        .html(response.message);

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
                                $('#register').prop('disabled', false);
                            });
                    });
                </script>
            @endpush
