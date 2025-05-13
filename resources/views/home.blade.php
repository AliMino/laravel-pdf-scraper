<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name') }}</title>


    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>

    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>

    <!-- Bootstrap 4 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

    <!-- Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />

    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>

<body>
    <div class="input-box">
        <i class="uil uil-search"></i>
        <input type="text" placeholder="Enter a webpage to scan..." />
        <button class="button">Scan</button>
    </div>
    <div class="details-box">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">URL</th>
                    <th scope="col">Status</th>
                    <th scope="col">Last Change</th>
                    <th class="text-center" scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($urlScans as $urlScan)
                    <tr>
                        <!-- URL -->
                         <th scope="row">{{ $urlScan->url }}</th>
                        
                        <!-- Status -->
                         <td>{{ $urlScan->urlScanStatus->enumCase->name }}</td>
                        
                        <!-- Last Change -->
                        <td>{{ Carbon\Carbon::parse($urlScan->updated_at)->diffForHumans() }}</td>
                        
                        <!-- Actions -->
                        <td class="text-center">
                            
                            <!-- Download -->
                            @if ($urlScan->urlScanStatus->enumCase == App\Enum\UrlScanStatus::Processed)
                                <a target="_blank" href="{{ route('download-url-scan:web', [ 'urlScanId' => $urlScan->id]) }}">
                                    <button class="btn"><i class="uil uil-download-alt"></i> Download</button>
                                </a>
                            @endif
                            
                            <!-- Retry -->
                            @if ($urlScan->urlScanStatus->enumCase == App\Enum\UrlScanStatus::Failed)
                                <a>
                                    <button class="btn">
                                        <i class="uil uil-redo"></i> Retry
                                    </button>
                                </a>
                            @endif

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>