<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login V4</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="../Content/Login/images/icons/favicon.ico" />

    <link rel="stylesheet" type="text/css" href="../Content/Login/vendor/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="../Content/Login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="../Content/Login/fonts/iconic/css/material-design-iconic-font.min.css">

    <link rel="stylesheet" type="text/css" href="../Content/Login/vendor/animate/animate.css">

    <link rel="stylesheet" type="text/css" href="../Content/Login/vendor/css-hamburgers/hamburgers.min.css">

    <link rel="stylesheet" type="text/css" href="../Content/Login/vendor/animsition/css/animsition.min.css">

    <link rel="stylesheet" type="text/css" href="../Content/Login/vendor/select2/select2.min.css">

    <link rel="stylesheet" type="text/css" href="../Content/Login/vendor/daterangepicker/daterangepicker.css">

    <link rel="stylesheet" type="text/css" href="../Content/Login/css/util.css">
    <link rel="stylesheet" type="text/css" href="../Content/Login/css/main.css">
    <script src="../Content/Admin/Cookie.js"></script>
    <script src="../Content/Admin/Validation.js"></script>

    <meta name="robots" content="noindex, follow">
    <script nonce="5af911df-0c54-4912-9ce2-587ae6c430c3">
    try {
        (function(w, d) {
            ! function(b$, ca, cb, cc) {
                b$[cb] = b$[cb] || {};
                b$[cb].executed = [];
                b$.zaraz = {
                    deferred: [],
                    listeners: []
                };
                b$.zaraz.q = [];
                b$.zaraz._f = function(cd) {
                    return async function() {
                        var ce = Array.prototype.slice.call(arguments);
                        b$.zaraz.q.push({
                            m: cd,
                            a: ce
                        })
                    }
                };
                for (const cf of ["track", "set", "debug"]) b$.zaraz[cf] = b$.zaraz._f(cf);
                b$.zaraz.init = () => {
                    var cg = ca.getElementsByTagName(cc)[0],
                        ch = ca.createElement(cc),
                        ci = ca.getElementsByTagName("title")[0];
                    ci && (b$[cb].t = ca.getElementsByTagName("title")[0].text);
                    b$[cb].x = Math.random();
                    b$[cb].w = b$.screen.width;
                    b$[cb].h = b$.screen.height;
                    b$[cb].j = b$.innerHeight;
                    b$[cb].e = b$.innerWidth;
                    b$[cb].l = b$.location.href;
                    b$[cb].r = ca.referrer;
                    b$[cb].k = b$.screen.colorDepth;
                    b$[cb].n = ca.characterSet;
                    b$[cb].o = (new Date).getTimezoneOffset();
                    if (b$.dataLayer)
                        for (const cm of Object.entries(Object.entries(dataLayer).reduce(((cn, co) => ({
                                ...cn[1],
                                ...co[1]
                            })), {}))) zaraz.set(cm[0], cm[1], {
                            scope: "page"
                        });
                    b$[cb].q = [];
                    for (; b$.zaraz.q.length;) {
                        const cp = b$.zaraz.q.shift();
                        b$[cb].q.push(cp)
                    }
                    ch.defer = !0;
                    for (const cq of [localStorage, sessionStorage]) Object.keys(cq || {}).filter((cs => cs
                        .startsWith("_zaraz_"))).forEach((cr => {
                        try {
                            b$[cb]["z_" + cr.slice(7)] = JSON.parse(cq.getItem(cr))
                        } catch {
                            b$[cb]["z_" + cr.slice(7)] = cq.getItem(cr)
                        }
                    }));
                    ch.referrerPolicy = "origin";
                    ch.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(b$[cb])));
                    cg.parentNode.insertBefore(ch, cg)
                };
                ["complete", "interactive"].includes(ca.readyState) ? zaraz.init() : b$.addEventListener(
                    "DOMContentLoaded", zaraz.init)
            }(w, d, "zarazData", "script");
        })(window, document)
    } catch (err) {
        console.error('Failed to run Cloudflare Zaraz: ', err)
        fetch('/cdn-cgi/zaraz/t', {
            credentials: 'include',
            keepalive: true,
            method: 'GET',
        })
    };
    </script>
</head>

<body>
    <div class="limiter">
        <div class="container-login100" style="background-image: url('../Content/Login/images/bg-01.jpg');">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                <form class="login100-form validate-form">
                    <span class="login100-form-title p-b-49">
                        Login
                    </span>
                    <div class="wrap-input100 validate-input m-b-23" data-validate="Username is reauired">
                        <span class="label-input100">Username</span>
                        <input class="input100" type="text" name="username" id="txtUserName"
                            placeholder="Type your username">
                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="pass" id="txtPassword"
                            placeholder="Type your password">
                        <span class="focus-input100" data-symbol="&#xf190;"></span>
                    </div>
                    <div class="text-right p-t-8 p-b-31">
                        <a href="#" data-toggle="modal" data-target="#ForgotPasswdModel" class="dropdown-item"><i
                                class="bx bx-user font-15" aria-hidden="true"></i>
                            Forgot password?
                        </a>
                    </div>
                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button type="button" class="login100-form-btn" id="btnSignIn">
                                Login
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="dropDownSelect1"></div>

    <script src="../Content/Login/vendor/jquery/jquery-3.2.1.min.js"></script>

    <script src="../Content/Login/vendor/animsition/js/animsition.min.js"></script>

    <script src="../Content/Login/vendor/bootstrap/js/popper.js"></script>
    <script src="../Content/Login/vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="../Content/Login/vendor/select2/select2.min.js"></script>

    <script src="../Content/Login/vendor/daterangepicker/moment.min.js"></script>
    <script src="../Content/Login/vendor/daterangepicker/daterangepicker.js"></script>

    <script src="../Content/Login/vendor/countdowntime/countdowntime.js"></script>

    <script src="../Content/Login/js/main.js"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-23581568-13');
    </script>
    <script defer
        src="https://static.cloudflareinsights.com/beacon.min.js/v84a3a4012de94ce1a686ba8c167c359c1696973893317"
        integrity="sha512-euoFGowhlaLqXsPWQ48qSkBSCFs3DPRyiwVu3FjR96cMPx+Fr+gpWRhIafcHwqwCqWS42RZhIudOvEI+Ckf6MA=="
        data-cf-beacon='{"rayId":"84b6e0904897f3fd","version":"2024.1.0","token":"cd0b4b3a733644fc843ef0b185f98241"}'
        crossorigin="anonymous"></script>
    <script>
    $(document).ready(function() {

        $("#btnSignIn").click(function() {
            var Cnt = 0;
            Cnt = IsEmpty("txtUserName", "lblUserName", Cnt);
            Cnt = IsEmpty("txtPassword", "lblPassword", Cnt);

            if (Cnt == 0) {
                $.ajax({
                    url: "../Controllers/StaffController.php?Choice=Authentication",
                    type: "POST",
                    contentType: "app/json",
                    data: JSON.stringify({
                        "UserName": $("#txtUserName").val(),
                        "Passwd": $("#txtPassword").val()
                    }),
                    success: function(res) {
                        if (res.trim() != "Fail") {
                            console.log(res);
                            res = JSON.parse(res);
                            setCookie('StaffFullName', res.FullName, 30);
                            setCookie('StaffId', res.StaffId, 30);
                            window.location.href = "Patient.php";
                        } else {
                            alert("Wrong Username or Password");
                        }
                    },
                    error: function(err) {
                        alert(err.message);
                    }
                });
            }

        });
    });
    </script>

    <div class="modal" id="ForgotPasswdModel">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="text-center">Forgot Password</h4>
                    <button type="button" class="btn-close" data-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <b>Email</b><span class='error' id='lblEmail'></span>
                            <input type="text" placeholder='Email' class="form-control" name="txtEmail" id="txtEmail" />
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" id="btnforgotPasswd">Send</button>
                    <button type="reset" class="btn btn-danger" id="btnCANCLE" data-bs-dismiss="modal">CANCLE</button>
                </div>
            </div>
        </div>
    </div>

</body>

<script>
$(document).ready(function() {
    $("#btnforgotPasswd").click(function() {
        var Cnt = 0;
        Cnt = IsEmpty("txtEmail", "lblEmail", Cnt);
        if (Cnt == 0) {
            $.ajax({
                url: "../Controllers/StaffController.php?Choice=forgotPasswd",
                type: "POST",
                contentType: "app/json",
                data: JSON.stringify({
                    "Email": $("#txtEmail").val()
                }),
                success: function(res) {
                    alert(res);
                },
                error: function(err) {
                    alert(err.message);
                }
            });
        }
    });
});
</script>

</html>