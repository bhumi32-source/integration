

$(document).ready(function() {
    var timer;

    $('#requestOtpBtn').click(function() {
        var email = $('input[name="email"]').val();
        $.ajax({
            url: '/send-otp', // Assuming this is the URL for send-otp route
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { email: email },
            success: function(response) {
                $('#otpForm').hide();
                $('#verifyOtpForm').show();
                startTimer();
            },
            error: function(xhr, status, error) {
                var errorMessage = xhr.responseJSON.error;
                alert(errorMessage);
            }
        });
    });

    $('#changeEmailLink').click(function(event) {
        event.preventDefault();
        $('#otpForm').show();
        $('#verifyOtpForm').hide();
    });

    $('#verifyOtpBtn').click(function() {
        var otp = $('input[name="otp"]').val();
        $.ajax({
            url: '/verify-otp', // Assuming this is the URL for verify-otp route
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { otp: otp },
            success: function(response) {
                if (response.redirect) {
                    window.location.href = response.redirect;
                }
            },
            error: function(xhr, status, error) {
                var errorMessage = xhr.responseJSON.error;
                alert(errorMessage);
            }
        });
    });

    function startTimer() {
        var timeLeft = 10;
        clearInterval(timer);

        timer = setInterval(function() {
            if (timeLeft <= 0) {
                clearInterval(timer);
                $('#timer').hide();
                $('#resendBtn').show();
            } else {
                $('#timer').text(timeLeft + ' seconds left');
                timeLeft--;
            }
        }, 1000);
    }

    $('#resendOtpBtn').click(function() {
        $('#resendBtn').hide();
        $('#timer').show();
        startTimer();

        var email = $('input[name="email"]').val();
        $.ajax({
            url: '/send-otp', // Assuming this is the URL for send-otp route
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { email: email },
            success: function(response) {
            },
            error: function(xhr, status, error) {
                var errorMessage = xhr.responseJSON.error;
                alert(errorMessage);
            }
        });
    });
});
