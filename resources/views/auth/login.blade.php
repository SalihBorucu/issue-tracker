<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Issue-Tracker - Log In</title>
    <meta name="description" content="Dashboard UI Kit" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600" rel="stylesheet" />

    <!-- Favicon -->
    <link rel="apple-touch-icon" href="apple-touch-icon.png" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

    <!-- Stylesheet -->
    <link rel="stylesheet" href="css/main.min.css" />
</head>

<body class="o-page o-page--center">


    <div class="o-page__card">
        <div class="c-card u-mb-xsmall">
            <header class="c-card__header u-pt-large">
                <a class="c-card__icon" href="#!">
                    <img src="img/logo-login.svg" alt="Dashboard UI Kit" />
                </a>
                <h1 class="u-h3 u-text-center u-mb-zero">
                    Welcome! Please login.
                </h1>
            </header>

            <form class="c-card__body" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="c-field u-mb-small">
                    <label class="c-field__label" for="email">Log in with your e-mail address</label>
                    <input id="email" type="email" class="c-input @error('email')c-input--danger @enderror" name="email"
                        value="example@example.com" autocomplete="email" autofocus placeholder="clark@dashboard.com" />
                    @error('email')
                    <small class="c-field__message u-color-danger" role="alert">
                        <i class="fa fa-times-circle"></i>
                        <span>{{ $message }}</span>
                    </small>
                    @enderror
                </div>

                <div class="c-field u-mb-small">
                    <label class="c-field__label" for="password">Password</label>
                    <input class="c-input @error('password')c-input--danger @enderror" name="password" type="password"
                        value="password" id="password" />
                    @error('password')
                    <small class="c-field__message u-color-danger" role="alert">
                        <i class="fa fa-times-circle"></i>
                        <span>{{ $message }}</span>
                    </small>
                    @enderror
                </div>

                <button class="c-btn c-btn--info c-btn--fullwidth" type="submit">
                    Sign in
                </button>
            </form>
        </div>


    </div>

    <script src="js/main.min.js"></script>
</body>

</html>