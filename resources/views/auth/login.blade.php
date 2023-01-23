@extends('layouts.app')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('css/intlTelInput.css') }}">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="mobile" class="col-md-4 col-form-label text-md-end">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <input  name="phone" id="phone" type="tel"  required
                                            autocomplete="phone" autofocus class="form-control floating @error('phone') error @enderror">
                                    <span id="valid-msg" class="hide"></span>
                                    <span id="error-msg" class="hide"></span>
                                    <span id="error-msg2" class="text-danger hide"></span>
                                    <span id="notifications" class="text-danger hide"></span>
                                </div>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row" id="recaptia_div">
                            <div class="alert alert-danger" id="error" style="display: none;"></div>

                            <div class="alert alert-success" id="sentSuccess" style="display: none;"></div>
                            <br>
                            <div class="col-md-12">
                                <div class="col-md-12" id="recaptcha-container" style="margin:2%;"></div>
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="button" id="phoneSendAuth" class="btn btn-primary px-5 my-2"
                                    onclick="phoneSendAuth22()">
                                    {{ __('next') }}
                                </button>
                            </div>
                        </div>
                        <div class="row" id="submit_div" style="display:none">
                            <div class="col-12 mt-5 mb-5">
                                <div class="form-group">
                                    <label for="ver">Enter Verification Code (OTP)</label>
                                    <input type="text" id="verificationCode" class="form-control"
                                        placeholder="Enter verification code">
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button type="button" class="btn btn-primary px-5" onclick="codeverify();">Verify For Submit</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="{{ asset('js/intlTelInput.js') }}"></script>
<script src="{{ asset('js/phone.js') }}"></script>

<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>


<script type="text/javascript">
    const firebaseConfig = {
        apiKey: "AIzaSyDbJDNytEsv8ykHcOv0aIHRDGp62SaJdlk",
        authDomain: "penta-42155.firebaseapp.com",
        projectId: "penta-42155",
        storageBucket: "penta-42155.appspot.com",
        messagingSenderId: "876613102098",
        appId: "1:876613102098:web:e1de64a1cd6d07ec0a46cb",
        measurementId: "G-7GTTGKTLCQ"
    };


    firebase.initializeApp(firebaseConfig);
    window.onload = function() {
        render();
    };

    function render() {
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
        recaptchaVerifier.render();
    }

    function phoneSendAuth22() {
        var number = $("#phone").val();
        firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(
            function(confirmationResult) {
                window.confirmationResult = confirmationResult;
                coderesult = confirmationResult;
                $('#recaptia_div').hide();
                $('#submit_div').show();
            }
        ).catch(function(error) {
            alert( error.message);
        });

    }

    function codeverify() {

        var code = $("#verificationCode").val();

        coderesult.confirm(code).then(function(result) {
            var user = result.user;
            $("#form").submit();
        }).catch(function(error) {
            // Swal.fire({
            //     icon: 'error',
            //     title: 'Error!',
            //     text: error.message,
            // });
            alert( error.message);
        });
    }

</script>
@endsection
