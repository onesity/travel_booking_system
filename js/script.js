import { success_modal, validateEmail, validatePassword, validateUsername } from './functions.js';
window.addEventListener('load', () => {

    const form_div = document.querySelector('.form-div');
    const signup_btn = document.getElementById('signup');

    const username = document.getElementById('username');
    const username_error = document.getElementById('username_error');

    const email = document.getElementById('email');
    const email_error = document.getElementById('email_error');

    const password = document.getElementById('password');
    const password_error = document.getElementById('password_error');

    signup_btn.addEventListener('click', () => {
        let errors = [];
        var usernameRes = validateUsername(username.value);

        if (usernameRes.status == true) {
            username_error.style.display = 'none';
            username.style.border = '1px solid green';
        } else {
            username_error.innerHTML = usernameRes.message;
            username.style.border = '1px solid red';
            username_error.style.display = 'block';
            errors['username'] = 'username_error';
        }

        var emailRes = validateEmail(email.value)
        if (emailRes.status == true) {
            email_error.style.display = 'none';
            email.style.border = '1px solid green';
        } else {
            email_error.innerHTML = emailRes.message;
            email.style.border = '1px solid red';
            email_error.style.display = 'block';
            errors['email'] = 'email_error';
        }

        var passswordRes = validatePassword(password.value);
        if (passswordRes.status == true) {
            password_error.style.display = 'none';
            password.style.border = '1px solid green';
        } else {
            password_error.innerHTML = passswordRes.message;
            password.style.border = '1px solid red';
            password_error.style.display = 'block';
            errors['password'] = 'password_error';
        }

        var data = { username: username.value, email: email.value, password: password.value, action: 'signup' };
        if (Object.keys(errors).length == 0) {

            fetch('http://localhost/travel_booking_system/travel_booking_system/html/ajax.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            }
            ).then(function (res) {
                return res.json();
            }).then((response) => {
                if (response.success == true) {

                    const otp_field = document.createElement('input');
                    const otp_submit_btn = document.createElement('button');
                    const otp_msg = document.createElement('h3');
                    const otp_error = document.createElement('h5');
                    const resend_otp_btn = document.createElement('a');

                    otp_field.setAttribute('type', 'number');
                    otp_field.setAttribute('id', 'otp_field');
                    otp_field.setAttribute('placeholder', 'Enter OTP');

                    otp_submit_btn.setAttribute('id', 'otp_submit_btn');
                    otp_msg.setAttribute('id', 'otp_msg');
                    otp_error.setAttribute('id', 'otp_error');
                    resend_otp_btn.setAttribute('id', 'resend_otp_btn');
                    resend_otp_btn.innerHTML = 'Resend OTP'
                    otp_submit_btn.innerHTML = 'Submit';
                    otp_msg.innerText = response.msg;

                    form_div.innerHTML = '';
                    form_div.append(otp_msg);
                    form_div.append(otp_field);
                    form_div.append(otp_error);
                    form_div.append(otp_submit_btn);
                    form_div.append(resend_otp_btn);


                    otp_submit_btn.addEventListener('click', () => {
                        if (otp_field.value.length != 6) {
                            otp_error.style.display = "block";
                            otp_error.innerHTML = 'Please enter correct OTP!'
                        } else {
                            otp_error.style.display = "none";
                            var otp_data = { action: 'otp_verification', otp: otp_field.value }
                            fetch('http://localhost/travel_booking_system/travel_booking_system/html/ajax.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify(otp_data)

                            }).then((res) => {
                                return res.json();
                            }).then((response) => {
                                if (response.success == true) {
                                    success_modal(response.msg);
                                    setTimeout(() => {
                                        window.location.href = "http://localhost/travel_booking_system/travel_booking_system/html/login.php";
                                    }, 3000)

                                } else {
                                    otp_error.style.display = "block";
                                    otp_error.innerHTML = response.msg;
                                }

                            })
                        }
                    })
                    resend_otp_btn.addEventListener('click', () => {
                        var resend_otp_data = { action: 'resend_otp' };
                        fetch('http://localhost/travel_booking_system/travel_booking_system/html/ajax.php', {
                            method: 'POST',
                            header: {
                                'Content-Type': 'application/JSON'
                            },
                            body: JSON.stringify(resend_otp_data)
                        }).then((r) => {
                            return r.json();
                        }).then((res) => {
                            if (res.success == true) {
                                otp_msg.innerText = res.msg;
                            }
                        })
                    })

                } else {
                    email_error.innerHTML = response.msg;
                    email.style.border = '1px solid red';
                    email_error.style.display = 'block';
                }
            })
        }

    })
})





