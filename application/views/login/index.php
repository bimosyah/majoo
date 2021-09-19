<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Signin Template for Bootstrap</title>
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/4.0/examples/sign-in/signin.css" rel="stylesheet">
    <link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" />

</head>

<body class="text-center">
<form class="form-signin">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <label class="sr-only">Username</label>
    <input type="text" id="username" class="form-control" placeholder="Username : admin" required autofocus>
    <label class="sr-only">Password</label>
    <input type="password" id="password" class="form-control" placeholder="Password : admin" required>
    <button class="btn btn-lg btn-primary btn-block" type="button" onclick="login()">Sign in</button>
</form>


<script src="https://code.jquery.com/jquery-3.5.1.js"</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function login() {
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;
        $.ajax({
            url: "<?php echo site_url("login/auth")?>",
            type: "post",
            data: {username,password},
            success: function (response) {
                console.log(response);
                const parse = JSON.parse(JSON.stringify(response))
                console.log(parse);
                let timerInterval
                Swal.fire({
                    title: 'Submit form!',
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                            b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                        if (parse.status == "0") {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: parse.msg,
                            })
                        } else {
                            console.log(parse.status);
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: parse.msg,
                            }).then(function () {
                                window.location = "<?php echo site_url("product")?>";
                            });
                        }
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                    }
                })
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        })
    }
</script>
</body>
</html>
