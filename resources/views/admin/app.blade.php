<!doctype html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $tags['title'] }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <style>
        [data-bs-theme=dark] {color-scheme: dark;}
        img {max-width: 100%;height:auto}
        .bi {
            width: 1em;
            height: 1em;
            vertical-align: -0.125em;
            fill: currentcolor;
        }
        body {overflow-y: scroll}
        .truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            display: block;
        }
    </style>
    <script src="/assets/js/misc/admin-theme.js"></script>
    <script async>
        var _csrf = '{{ csrf_token() }}';

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script defer src="/assets/js/uajax/b5toast.js"></script>
    <script defer src="/assets/js/uajax/b5alert.js"></script>
    <script defer src="/assets/js/uajax/notifications.js"></script>
    <script defer src="/assets/js/uajax/uajax.settings.js?"></script>
    <script defer src="/assets/js/uajax/uajax.js?v"></script>


    <script defer src="/assets/js/post-data.js"></script>
    <script defer src="/assets/js/js-ajax-button.js"></script>



</head>
<body class="bg-body-secondary">
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
    </symbol>

    <symbol id="circle-half" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
    </symbol>
    <symbol id="moon-stars-fill" viewBox="0 0 16 16">
        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
    </symbol>
    <symbol id="sun-fill" viewBox="0 0 16 16">
        <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
    </symbol>
</svg>

<nav class="navbar navbar-expand-sm navbar-dark bg-dark" aria-label="Third navbar example">
    <div class="container">
        <a class="navbar-brand" href="/">
            MyApp
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('admin') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.posts.index') }}">Posts</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>

            <form class="d-flex" role="search" method="post" action="{{ route('logout') }}">
                @csrf
                <button class="ms-2 btn btn-outline-secondary" type="submit">Logout</button>
            </form>

            <ul class="navbar-nav mb-2 mb-sm-0">
                <li class="nav-item py-2 py-lg-1 col-12 col-lg-auto">
                    <div class="vr d-none d-lg-flex h-100 mx-lg-2 text-white"></div>
                    <hr class="d-lg-none my-2 text-white-50">
                </li>

                <li class="nav-item dropdown">
                    <button class="btn btn-link nav-link py-2 px-0 px-lg-2 dropdown-toggle d-flex align-items-center"
                            id="bd-theme"
                            type="button"
                            aria-expanded="false"
                            data-bs-toggle="dropdown"
                            data-bs-display="static">
                        <svg class="bi my-1 theme-icon-active"><use href="#circle-half"></use></svg>
                        <span class="d-lg-none ms-2">Change theme</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme" style="--bs-dropdown-min-width: 8rem;">
                        <li>
                            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light">
                                <svg class="bi me-2 opacity-50 theme-icon"><use href="#sun-fill"></use></svg>
                                Day
                                <svg class="bi ms-auto d-none"><use href="#check2"></use></svg>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark">
                                <svg class="bi me-2 opacity-50 theme-icon"><use href="#moon-stars-fill"></use></svg>
                                Night
                                <svg class="bi ms-auto d-none"><use href="#check2"></use></svg>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto">
                                <svg class="bi me-2 opacity-50 theme-icon"><use href="#circle-half"></use></svg>
                                Auto
                                <svg class="bi ms-auto d-none"><use href="#check2"></use></svg>
                            </button>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 d-md-block">
            <div class="position-sticky pt-3">
                <div class="list-group mb-3">
                    <a href="{{ route('admin') }}" class="list-group-item list-group-item-action <?=($tags['active'] ?? null) == 'admin' ?'active' : ''?>">Quick actions</a>
                    <a href="{{ route('admin.posts.index') }}" class="list-group-item list-group-item-action <?=($tags['active'] ?? null) == 'admin.posts' ?'active' : ''?>">Posts</a>
                    <a href="{{ route('admin.posts.create') }}" class="list-group-item list-group-item-action <?=($tags['active'] ?? null) == 'admin.posts.create' ?'active' : ''?>">Create Post</a>

                </div>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-3 pb-2 mb-3">

            @if ($message = session('flash_message'))
                <div class="alert alert-{{ $message['type'] }}" role="alert">
                    {{ $message['message'] }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (isset($tags['breadcrumb']))
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
                        @foreach($tags['breadcrumb'] as $breadcrumbItemKey => $breadcrumbItemValue)
                            @if ($breadcrumbItemKey)
                                <li class="breadcrumb-item"><a href="/admin/{{ $breadcrumbItemKey }}">{{ $breadcrumbItemValue }}</a></li>
                            @else
                                <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumbItemValue }}</li>
                            @endif
                        @endforeach
                    </ol>
                </nav>
            @endif

            @yield('navigation')
            <h2>{{ $tags['title'] }} <?= isset($total) ? "({$total})" : '' ?></h2>
            @yield('content')

        </main>
    </div>
</div>


<div class="position-fixed bottom-0 start-0 p-3" style="z-index: 1111" id="toast-container"></div>
@yield('footer')
</body>
</html>
