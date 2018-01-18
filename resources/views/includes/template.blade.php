<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title></title>

    <link rel="stylesheet" href="/css/app.css">

    <script type="application/javascript" src="/js/app.js"></script>
    <script type="application/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>

<div class="sidebar">
    <div class="logo">
        <a href="/">
            <span>ETL DataView</span>
        </a>
    </div>

    <nav class="nav">
        <ul>
            <li class="{{ Request::segment(1) == "" || Request::segment(1) == "logboek" ? "selected" : null }}">
                <a href="/logboek/">
                    <span>Logs</span>
                </a>
            </li>

            <li class="{{ Request::segment(1) == "movies" ? "selected" : null }}">
                <a href="/movies/">
                    <span>Movies</span>
                </a>
            </li>
        </ul>
    </nav>
</div>

<div class="header">
    <ul>
        <li>
            <a href="/{{Request::segment(1) ?: "logboek"}}/analytic/"
               class="{{ Request::segment(2) == "" || Request::segment(2) == "analytic" ? "selected" : null }}">
                <span>Analyse</span>
            </a>
        </li>

        <li>
            <a href="/{{Request::segment(1)?: "logboek"}}/report/"
               class="{{ Request::segment(2) == "report" ? "selected" : null }}">
                <span>Rapportage</span>
            </a>
        </li>
    </ul>
</div>

<div id="main">
    @yield('content')
</div>

</body>
</html>