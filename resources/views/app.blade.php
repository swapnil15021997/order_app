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
   
  </body>
</html>