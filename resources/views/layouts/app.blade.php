<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Warga - Bina Desa</title>

    {{-- ====================== START CSS ====================== --}}
    @include('admin.layouts.css')
    {{-- ====================== END CSS ====================== --}}

</head>
<body>
    <div class="container-scroller">

        {{-- ====================== START HEADER ====================== --}}
        @include('admin.layouts.header')
        {{-- ====================== END HEADER ====================== --}}

        <div class="container-fluid page-body-wrapper">

            {{-- ====================== START SIDEBAR ====================== --}}
            @include("admin.layouts.sidebar")
            {{-- ====================== END SIDEBAR ====================== --}}

           @yield('content');

                    <!-- {{-- end main content --}} -->
                    {{-- ====================== END MAIN CONTENT ====================== --}}

                </div>
                <!-- content-wrapper ends -->

                {{-- ====================== START FOOTER ====================== --}}
               @include('admin.layouts.footer')
                {{-- ====================== END FOOTER ====================== --}}

            </div>
        </div>
    </div>

    {{-- ====================== START JS ====================== --}}
    @include('admin.layouts.js')
    {{-- ====================== END JS ====================== --}}
</body>
</html>
