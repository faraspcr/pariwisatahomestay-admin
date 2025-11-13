<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Warga - Bina Desa</title>

    {{-- ====================== START CSS ====================== --}}
    @include('layouts.css')
    {{-- ====================== END CSS ====================== --}}

</head>
<body>
    <div class="container-scroller">

        {{-- ====================== START HEADER ====================== --}}
        @include('layouts.header')
        {{-- ====================== END HEADER ====================== --}}

        <div class="container-fluid page-body-wrapper">

            {{-- ====================== START SIDEBAR ====================== --}}
            @include('layouts.sidebar')
            {{-- ====================== END SIDEBAR ====================== --}}

           @yield('content')

                    <!-- {{-- end main content --}} -->
                    {{-- ====================== END MAIN CONTENT ====================== --}}

                </div>
                <!-- content-wrapper ends -->

                {{-- ====================== START FOOTER ====================== --}}
               @include('layouts.footer')
                {{-- ====================== END FOOTER ====================== --}}

            </div>
        </div>
    </div>

    {{-- ====================== START JS ====================== --}}
    @include('layouts.js')
    {{-- ====================== END JS ====================== --}}
</body>
</html>
