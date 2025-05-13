<!DOCTYPE html>
<!-- Coding by CodingNepal | www.codingnepalweb.com -->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }} - Statistics</title>
    <link rel="stylesheet" href="style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/statistics.css') }}">
</head>

<body>
    <section class="home-section">
        <div class="home-content">
            <div class="overview-boxes">
                @foreach ($statistics as $key => $value)
                    <div class="box">
                        <div class="right-side">
                            <div class="box-topic">{{ strtr(Str::title($key), '_', ' ') }}</div>
                            <div class="statistics-value">{{ $value }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
            
        </div>
    </section>
    <script>
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");
        sidebarBtn.onclick = function () {
            sidebar.classList.toggle("active");
            if (sidebar.classList.contains("active")) {
                sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
            } else
                sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        }
    </script>
</body>

</html>