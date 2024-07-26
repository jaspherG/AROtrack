@extends('layouts.user_type.guest')

@section('content')

  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-dark text-gradient">AROTrack: Documents Tracking and Monitoring System</h3>
                </div>

                <div class="card-body">
                 <div class="mb-3">
                  <p  id="error-message" class="text-danger mt-2"></p>
                  <div id="timer" style="display:none;">
                      Too many attempts. Please try again in <span id="countdown"></span>
                  </div>
                 </div>

                  <form id="loginForm">
                    @csrf
                    <label>Username</label>
                    <div class="mb-3">
                      <input required type="email" class="form-control" name="email" id="email" placeholder="Email" value="" aria-label="Email" aria-describedby="email-addon">
                    </div>
                    <label>Password</label>
                    <div class="mb-3">
                      <input required type="password" class="form-control" name="password" id="password" placeholder="Password" value=""
                        aria-label="Password" aria-describedby="password-addon">
                    </div>
                    <div class="">
                      <span id="togglePasswordIcon" class="toggle-password" onclick="togglePassword()">Show Password</span>
                    </div>
                    <div class="text-center">
                      <button type="submit"  id="submit" class="btn bg-danger  w-100 mt-4 mb-0 text-white">Sign in</button>
                    </div>
                  </form>
                
                </div>
    </section>
  </main>

@endsection

<style>
    body 

    .toggle-password {
        display: inline-block;
        margin-top: 5px;
        cursor: pointer;
        color: #800000;
        text-decoration: underline;
        font-size: 0.9em;
    }

    .btn {
        width: 100%;
        padding: 10px;
        margin-top: 20px;
        border: none;
        border-radius: 4px;
        color: white;
        font-size: 16px;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #c82333;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    
        function togglePassword() {
            var passwordInput = document.getElementById('password');
            var toggleIcon = document.getElementById('togglePasswordIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.textContent = 'Hide Password';
            } else {
                passwordInput.type = 'password';
                toggleIcon.textContent = 'Show Password';
            }
        }

        function formatTime(seconds) {
            const hours = Math.floor(seconds / 3600);
            const minutes = Math.floor((seconds % 3600) / 60);
            const secs = seconds % 60;

            return [
                hours > 0 ? String(hours).padStart(2, '0') : '00',
                String(minutes).padStart(2, '0'),
                String(secs).padStart(2, '0')
            ].join(':');
        }

        function disableForm() {
            $('#loginForm input, #loginForm button').prop('disabled', true);
        }

        function enableForm() {
            $('#loginForm input, #loginForm button').prop('disabled', false);
        }

        function updateFailedLogin(seconds) {
           $.post('/enabled_login', {
            email: $('#email').val()
           }, function(response){
            if(response.status == 'success'){
              enableForm();
            }
           });
        }

        $(document).ready(function () {

          
          $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }); 


            $('#loginForm').on('submit', function (e) {
                e.preventDefault();
                $('#error-message').text('');
                $.ajax({
                    url: '/login',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response.error) {
                            $('#error-message').text(response.error);
                        } else {
                            window.location.href = '/dashboard';
                        }
                    },
                    error: function (xhr) {
                      if (xhr.status === 429) {
                            disableForm();
                            let lockoutTime = xhr.responseJSON.lockout_time * 1000; // Convert to milliseconds
                            let currentTime = new Date().getTime();
                            let countdown = Math.ceil((lockoutTime - currentTime) / 1000);

                            $('#timer').show();
                            $('#countdown').text(formatTime(countdown));

                            let interval = setInterval(function () {
                                countdown--;
                                $('#countdown').text(formatTime(countdown));

                                if (countdown <= 0) {
                                    clearInterval(interval);
                                    $('#timer').hide();
                                    updateFailedLogin();
                                }
                            }, 1000);
                        } else {
                            $('#error-message').text(xhr.responseJSON.error);
                        }
                    }
                });
            });
        });
    </script>

