@include('head')

<body>
    @include('navbar')

    <div class="page-wrapper">
       
                    @yield('content')
                </div>
            </div>
        </div>
    </div>


<!-- Libs JS -->
<script src="{{ asset('libs/apexcharts/apexcharts.min.js')}}" defer></script>
<script src="{{ asset('libs/jsvectormap/js/jsvectormap.min.js')}}" defer></script>
<script src="{{ asset('libs/jsvectormap/maps/world.js')}}" defer></script>
<script src="{{ asset('libs/jsvectormap/maps/world-merc.js')}}" defer></script>
<!-- Tabler Core -->
<script src="{{ asset('js/tabler.min.js')}}" defer></script>
<script src="{{ asset('js/demo.min.js')}}" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

          

  </body>
</html>