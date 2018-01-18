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
        ETL
    </div>

    <nav class="nav">
        <ul>
            <li>
                <a href="/logboek/">
                    <span>Kijkcijfers</span>
                </a>
            </li>

            <li>
                <a href="/movies/">
                    <span>Films</span>
                </a>
            </li>
        </ul>
    </nav>
</div>

<div class="header">
    <ul>
        <li>
            <a href="/{{Request::segment(1) ?: "logboek"}}/data/">
                <span>Data</span>
            </a>
        </li>

        <li>
            <a href="/{{Request::segment(1) ?: "logboek"}}/analytic/">
                <span>Analyse</span>
            </a>
        </li>

        <li>
            <a href="/{{Request::segment(1)?: "logboek"}}/report/">
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