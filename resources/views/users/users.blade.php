@extends('app')

@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('settings')}}">Settings</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="#">Users &
                                Permissions</a></li>

                            </ol>
                </nav>
                <br />

                <h2 class="page-title">
                    User Roles
                </h2>
                <div class="text-secondary mt-1" id="pagination_code"></div>
            </div>
            <!-- Page title actions -->

        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <!-- <div class="col-md-6 col-lg-3">

                </div> -->
        <div id="alert-site"></div>
                        
        @if(in_array(13, $user_permissions))

            <div class="row row-deck row-cards mb-3">
                @foreach ($roles as $role)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="subheader">Total {{ $role['users_count'] }} User</div>
                                </div>
                                <div class="h1 mb-2">{{$role['role_name']}}</div>
                                <div class="d-flex flex-wrap justify-content-between gap-1 mt-1">
                                    <a href="#" class="text-primary" onclick="edit_role({{$role['role_id']}})">
                                        Edit Role
                                    </a>

                                    <a href="#" class="text-muted" onclick="delete_role({{$role['role_id']}})">
                                        Delete Role
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        <div class="row mb-3">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <svg xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#"
                                xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                                xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg"
                                xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                                xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" width="70px" height="90px"
                                viewBox="0 0 170 209" version="1.1" id="svg86" sodipodi:docname="faq-illustrations.svg"
                                inkscape:version="0.92.3 (2405546, 2018-03-11)">
                                <metadata id="metadata92">
                                    <rdf:RDF>
                                        <cc:Work rdf:about="">
                                            <dc:format>image/svg+xml</dc:format>
                                            <dc:type rdf:resource="http://purl.org/dc/dcmitype/StillImage" />
                                        </cc:Work>
                                    </rdf:RDF>
                                </metadata>
                                <defs id="defs90" />
                                <sodipodi:namedview pagecolor="#ffffff" bordercolor="#666666" borderopacity="1"
                                    objecttolerance="10" gridtolerance="10" guidetolerance="10" inkscape:pageopacity="0"
                                    inkscape:pageshadow="2" inkscape:window-width="1366" inkscape:window-height="667"
                                    id="namedview88" showgrid="false" inkscape:zoom="1.596911" inkscape:cx="240.49167"
                                    inkscape:cy="42.070798" inkscape:window-x="0" inkscape:window-y="27"
                                    inkscape:window-maximized="1" inkscape:current-layer="svg86" />
                                <title id="title2">Illustration</title>
                                <path style="fill:#dfdfdf;fill-rule:evenodd;stroke:none;stroke-width:1"
                                    inkscape:connector-curvature="0" id="Rectangle"
                                    d="M 131.88864,127.5 H 70 v 0 66 c 0,2.20914 1.790861,4 4,4 h 78 c 2.20914,0 4,-1.79086 4,-4 V 151.61136 C 156,138.29502 145.20498,127.5 131.88864,127.5 Z" />
                                <polygon style="fill:#d1d1d1;fill-rule:evenodd;stroke:none;stroke-width:1"
                                    points="84,197.5 22,197.5 22,188.5 84,188.5 " id="polygon5"
                                    transform="matrix(-1,0,0,1,170,0)" />
                                <polygon style="fill:#dfdfdf;fill-rule:evenodd;stroke:none;stroke-width:1"
                                    points="87,208.5 90.292585,198.5 102.06958,198.5 106,208.5 " id="Path"
                                    transform="matrix(-1,0,0,1,170,0)" />
                                <polygon style="fill:#f1f1f1;fill-rule:evenodd;stroke:none;stroke-width:1"
                                    points="22,208.5 25.292585,197.5 37.069584,197.5 41,208.5 " id="polygon8"
                                    transform="matrix(-1,0,0,1,170,0)" />
                                <polygon style="fill:#dfdfdf;fill-rule:evenodd;stroke:none;stroke-width:1"
                                    points="151,208.5 154.29259,198.5 166.06958,198.5 170,208.5 " id="polygon10"
                                    transform="matrix(-1,0,0,1,170,0)" />
                                <path style="fill:#dfdfdf;fill-rule:evenodd;stroke:none;stroke-width:1"
                                    inkscape:connector-curvature="0" id="path12"
                                    d="M 83.419634,54.795607 70,54.5 v 0 80 h 37 V 78.901119 C 107,65.791696 96.525878,55.08431 83.419634,54.795607 Z" />
                                <path style="fill:#f2f2f2;fill-rule:evenodd;stroke:none;stroke-width:1"
                                    inkscape:connector-curvature="0" id="path14"
                                    d="M 75.88864,54.5 H 21.84 C 9.7781,54.5 0,64.278101 0,76.34 v 57.4128 C 0,134.71775 0.78225,135.5 1.7472,135.5 H 100 v 0 -56.88864 C 100,65.295024 89.204976,54.5 75.88864,54.5 Z" />
                                <path style="fill:#dfdfdf;fill-rule:evenodd;stroke:none;stroke-width:1"
                                    inkscape:connector-curvature="0" id="path16"
                                    d="m 14,54.5 c -7.73199,0 -14,6.268014 -14,14 v 57.2528 C 0,126.71775 0.78225,127.5 1.7472,127.5 H 28 v 0 -59 c 0,-7.731986 -6.26801,-14 -14,-14 z" />
                                <path style="fill:#f2f2f2;fill-rule:evenodd;stroke:none;stroke-width:1"
                                    inkscape:connector-curvature="0" id="path18"
                                    d="M 135.4,135.5 H 74 v 0 53 h 74 v -40.4 c 0,-6.95879 -5.64121,-12.6 -12.6,-12.6 z" />
                                <g style="fill:none;fill-rule:evenodd;stroke:none;stroke-width:1" id="Head"
                                    transform="translate(62.641267,0.878756)">
                                    <path
                                        d="M 8.1469457,46.318688 C -1.7852142,44.004016 -2.4393343,30.361061 5.1118283,25.62855 -2.6756104,9.2920319 15.332911,-6.9280072 27.668586,3.0751532 35.755572,-0.38898498 42.475963,13.128793 34.950965,23.627563 38.106061,41.654256 31.684804,46.313975 20.109494,46.511927 Z"
                                        id="path20" inkscape:connector-curvature="0" style="fill:#33373e" />
                                    <path
                                        d="m 8.2705118,43.060367 c 0,0 4.8315222,-1.135088 4.9991362,-9.057598 0.167613,-7.92251 0.04995,-10.62685 0.04995,-10.62685 l 10.642415,-0.192175 c 0,0 0.116009,8.82951 0.117662,12.023175 0.0044,8.577747 5.976917,7.853448 5.976917,7.853448 0,0 -1.241563,6.955158 -10.884879,7.497804 -7.529279,0.42434 -10.9012022,-7.497804 -10.9012022,-7.497804 z"
                                        id="path22" inkscape:connector-curvature="0" style="fill:#edc2c2" />
                                    <path
                                        d="m 10.838731,19.419763 c -4.7475645,-0.183844 -3.9731816,6.771331 0.958646,6.761889 0,0 2.864481,9.880238 12.809591,9.880238 8.076712,0 8.602116,-11.515601 8.675377,-13.812818 0.07881,-2.449401 0.0888,-10.496325 0.0888,-10.496325 L 10.65391,11.742197 Z"
                                        id="path24" inkscape:connector-curvature="0" style="fill:#ffd7d7" />
                                    <path d="m 22.865664,28.632725 c 0,0 1.632597,2.640968 4.822553,1.701195"
                                        id="path26" transform="rotate(-18,25.27694,29.584425)"
                                        inkscape:connector-curvature="0"
                                        style="stroke:#f77b7b;stroke-width:1.5;stroke-linecap:round" />
                                    <path
                                        d="m 24.249364,31.785076 c 0.748486,0.314379 1.458419,0.314397 2.079641,-0.04683"
                                        id="path28" transform="rotate(2,25.289184,31.87678)"
                                        inkscape:connector-curvature="0" style="stroke:#f49494;stroke-linecap:round" />
                                    <path
                                        d="m 11.057378,23.277297 c 0.29853,-1.076092 0.166477,-2.01592 -0.901371,-2.445173"
                                        id="Path-8" transform="rotate(-13,10.6761,22.05471)"
                                        inkscape:connector-curvature="0" style="stroke:#f77b7b;stroke-linecap:round" />
                                    <path
                                        d="m 10.087581,18.560419 c 0,0 2.602203,3.494297 3.129311,3.512857 0.527108,0.01856 0.711683,-4.54451 0.711683,-4.54451 3.192106,-0.244035 11.270665,-1.853938 13.250967,-5.604425 1.384882,3.309214 4.032234,4.779103 5.771639,4.496839 l 0.329676,7.030426 0.811902,-14.1341442 H 9.451102 Z"
                                        id="path31" inkscape:connector-curvature="0" style="fill:#33373e" />
                                </g>
                                <g style="fill:none;fill-rule:evenodd;stroke:none;stroke-width:1" id="LLeg"
                                    transform="translate(66.040367,107.75)">
                                    <path
                                        d="m 53.496927,75.899687 c 0,0 -4.259124,8.608602 -0.767606,11.321383 3.496769,2.713306 12.733277,7.797865 12.733277,7.797865 L 40.992034,93.479959 46.431453,74.704865 Z"
                                        id="path34" inkscape:connector-curvature="0" style="fill:#ffd7d7" />
                                    <path
                                        d="m 43.359032,84.09215 c 1.207593,0.14134 -0.0821,4.210059 2.532606,4.519536 2.609451,0.308951 3.877729,-3.545844 6.838957,-2.323775 2.961228,1.222069 13.76097,7.540331 14.186252,10.123331 0.430533,2.582476 -3.593187,3.342395 -9.111362,2.759171 -5.518174,-0.583224 -6.535253,-2.547799 -10.677822,-1.756505 -4.137318,0.790768 -7.236714,-0.469804 -7.100203,-3.495214 0.13651,-3.024884 2.123979,-9.967358 3.331572,-9.826544 z"
                                        id="path36" inkscape:connector-curvature="0" style="fill:#2b2e35" />
                                    <path
                                        d="m 54.081263,86.914706 -0.42621,0.639614 c -0.306254,0.459594 -0.181947,1.080437 0.277648,1.38669 0.02177,0.01451 0.0441,0.02815 0.06694,0.04091 l 7.038346,3.930612 c 0.290778,0.162387 0.643317,0.169354 0.940283,0.01858 l 1.045002,-0.530559 v 0 C 61.243442,91.110507 59.78803,90.141223 58.17972,89.189478 56.945,88.458811 55.578014,87.705535 54.081259,86.914704 Z"
                                        id="Path-14" inkscape:connector-curvature="0"
                                        style="fill:#ffffff;fill-opacity:0.5409747" />
                                    <path
                                        d="M 16.634589,0.02568881 C 24.04291,0.35670797 65.275533,9.4831806 72.766803,11.033705 c 7.49127,1.550523 13.824654,9.940518 8.112214,19.655668 -6.415994,10.905768 -22.970433,41.877896 -26.989722,48.85978 -1.98938,3.45574 -12.025467,1.518191 -9.668036,-4.282007 4.394676,-10.81261 6.435567,-37.974918 17.63993,-47.878697 0,0 -37.680148,6.562623 -53.9564004,-0.954665 C -3.924372,20.969341 -1.2482872,-0.77453689 16.634589,0.02568881 Z"
                                        id="path39" inkscape:connector-curvature="0" style="fill:#33373e" />
                                </g>
                                <path style="fill:#ffd7d7;fill-rule:evenodd;stroke:none;stroke-width:1"
                                    inkscape:connector-curvature="0" id="path42"
                                    d="m 135.16614,63.93535 c 0,0 -0.0837,-6.032346 2.02484,-9.184878 2.10855,-3.152533 2.19227,-6.501214 3.78807,-6.391602 1.5958,0.109613 0.0157,7.893132 0.0157,7.893132 0,0 2.02484,-0.774104 3.47937,-1.753272 1.45454,-0.979168 5.86523,-5.806303 6.89597,-4.950907 1.74753,1.457476 -1.06736,9.67892 -2.60038,11.322579 -1.53825,1.644184 -9.94107,7.050848 -9.94107,7.050848 z" />
                                <path style="fill:#fa6d3f;fill-rule:evenodd;stroke:none;stroke-width:1;fill-opacity:1"
                                    inkscape:connector-curvature="0" id="path44"
                                    d="m 89.639622,60.320647 c 3.446175,7.998913 9.756206,22.693203 12.357538,27.077177 3.26003,5.490237 8.40065,7.909113 14.41952,3.835619 6.32435,-4.280322 23.73865,-20.974851 24.24937,-24.756495 0.50595,-3.781643 -3.75643,-8.318946 -7.61309,-5.969808 -3.85666,2.349137 -19.88198,15.695262 -19.88198,15.695262 0,0 -6.46754,-16.591082 -11.67022,-26.202101 C 96.994961,41.685176 84.393991,48.16035 89.639622,60.320647 Z" />
                                <path
                                    style="fill:#000000;fill-opacity:0.30280265;fill-rule:evenodd;stroke:none;stroke-width:1"
                                    inkscape:connector-curvature="0" id="path46"
                                    d="m 113.2378,76.211 c 1.15804,3.930739 1.87241,5.782313 2.14312,5.554721 0.27071,-0.227591 0.16729,-2.59281 -0.31025,-7.095656 z" />
                                <g style="fill:none;fill-rule:evenodd;stroke:none;stroke-width:1" id="PhoneMini4"
                                    transform="matrix(-0.95105652,-0.30901699,-0.30901699,0.95105652,158.48682,46.090021)">
                                    <g id="Group-3">
                                        <path
                                            d="M 2.8340193,1.0087998 H 11.67397 c 1.325483,0 2.4,1.0745167 2.4,2.4 V 25.9088 c 0,1.325483 -1.074517,2.4 -2.4,2.4 H 2.8340193 c -1.3254834,0 -2.40000003,-1.074517 -2.40000003,-2.4 V 3.4087998 c 0,-1.3254833 1.07451663,-2.4 2.40000003,-2.4 z"
                                            id="path49" inkscape:connector-curvature="0"
                                            style="fill:#7596ff;fill-rule:nonzero" />
                                        <rect id="rect51" x="1.4614233" y="0.64999998" width="13.639951"
                                            height="27.299999" style="fill:#93c2f9" />
                                        <path
                                            d="m 3.8994671,1.625 h 1.0344715 c 0.210747,0 0.3860248,0.1519734 0.4223736,0.352384 l 0.00692,0.077222 c 0,0.237265 0.1921996,0.4296063 0.42929,0.4296063 h 4.9882028 c 0.210747,0 0.386025,-0.1519733 0.422373,-0.352384 l 0.0069,-0.077222 c 0,-0.237265 0.1922,-0.4296063 0.42929,-0.4296063 h 1.02925 c 0.764576,0 1.391626,0.5892549 1.45242,1.3387191 l 0.0048,0.120895 v 0 l -0.01962,22.2003449 c -0.0024,0.968652 -0.787319,1.753447 -1.755259,1.755002 H 4.1669534 C 3.240518,27.041443 2.4818671,26.322607 2.4176487,25.411845 l -0.0044,-0.125335 c 0,-5.17e-4 0,-0.001 0.00155,-0.0016 L 2.4344109,3.0898395 C 2.4351261,2.2806215 3.0908445,1.625 3.8994671,1.625 Z"
                                            id="path53" inkscape:connector-curvature="0"
                                            style="fill:#e6f3ff;fill-rule:nonzero" />
                                    </g>
                                </g>
                                <path style="fill:#fa6d3f;fill-rule:evenodd;stroke:none;stroke-width:1;fill-opacity:1"
                                    inkscape:connector-curvature="0" id="path57"
                                    d="m 55.199222,50.682546 c 0,0 8.304709,27.828442 8.550658,33.096156 0.245949,5.268237 -6.792383,20.751408 -5.594035,24.664878 2.763003,9.04346 38.038393,12.93756 39.386119,0.77191 0.628535,-5.67367 -0.679493,-10.765847 0.8276,-17.451167 1.50186,-6.68532 7.538706,-16.619798 4.114696,-25.959946 -3.424016,-9.340148 -2.506591,-17.981237 -4.955617,-19.614496 -2.449026,-1.633259 -8.173885,-3.367797 -8.173885,-3.367797 -2.783935,4.099904 -12.182333,4.040204 -16.666981,-0.289072 0,0 -11.140973,2.162805 -17.488555,8.149534 z" />
                                <path
                                    style="fill:#000000;fill-opacity:0.19935536;fill-rule:evenodd;stroke:none;stroke-width:1"
                                    inkscape:connector-curvature="0" id="path59"
                                    d="m 62.641267,55.189659 c 5.535716,8.791552 5.519073,24.098469 8.492151,26.103149 2.973078,2.00468 14.54458,0.03742 14.54458,1.625 0,1.587579 -15.991088,16.136843 -13.365925,23.092072 1.374584,3.64189 1.001719,6.9 -1.118596,9.77434 l -0.692103,-0.15093 c -6.300619,-1.42496 -11.366035,-3.98377 -12.345529,-7.18971 -1.198348,-3.91347 6.651886,-19.396641 6.405937,-24.664878 -0.208779,-4.471597 -6.80956,-25.199957 -8.799962,-31.363234 1.620502,-2.861091 3.913259,-1.936563 6.879447,2.774191 z" />
                                <path style="fill:#ffd7d7;fill-rule:evenodd;stroke:none;stroke-width:1"
                                    inkscape:connector-curvature="0" id="path62"
                                    d="m 72.080917,78.514143 c 0,0 6.994997,-6.195554 9.136323,-6.91454 2.141325,-0.718986 14.68262,-1.582714 14.603312,0.04195 -0.08988,1.740566 -6.825806,1.640401 -7.52372,2.496786 -0.697913,0.855861 -0.85653,6.708441 -3.494855,7.365545 -2.633037,0.657109 -10.526862,1.789866 -10.526862,1.789866 z" />
                                <path style="fill:#fa6d3f;fill-rule:evenodd;stroke:none;stroke-width:1;fill-opacity:1"
                                    inkscape:connector-curvature="0" id="path64"
                                    d="M 53.471467,52.281816 C 46.101809,62.69053 39.809776,78.545539 37.39459,84.726951 34.979404,90.908364 37.415728,100.2319 48.035864,98.401503 58.636907,96.575882 75.504072,86.65629 77.370353,83.762619 c 1.866279,-2.893671 -0.968939,-8.158998 -4.539214,-7.469733 -3.307754,0.637677 -19.714926,7.619241 -19.714926,7.619241 0,0 10.555358,-18.72343 13.132829,-23.742693 4.305331,-8.382475 -6.286166,-17.058712 -12.777575,-7.887618 z" />
                                <path
                                    style="fill:#000000;fill-opacity:0.30280265;fill-rule:evenodd;stroke:none;stroke-width:1"
                                    inkscape:connector-curvature="0" id="path66"
                                    d="m 53.283271,83.784113 c -3.685686,1.832482 -5.303765,2.36446 -4.854237,1.595934 0.449527,-0.768525 2.770842,-2.502776 6.963945,-5.202753 z" />
                                <g style="fill:none;fill-rule:evenodd;stroke:none;stroke-width:1" id="RLeg"
                                    transform="translate(53.86184,104.5)">
                                    <path
                                        d="m 91.407663,79.4953 c 0,0 -0.128399,10.132339 8.214493,13.920669 8.337644,3.787805 14.277944,3.55977 13.521884,6.488501 -0.75606,2.92821 -22.458159,2.80999 -24.484815,0.51965 -1.727383,-1.948285 -5.483672,-20.090762 -6.518002,-18.703634 z"
                                        id="path69" inkscape:connector-curvature="0" style="fill:#ffd7d7" />
                                    <path
                                        d="m 84.806928,90.837172 c 0.931672,-1.801412 0.99024,3.266306 4.665063,2.149448 2.982229,-0.906364 4.001664,-6.093426 5.886156,-4.957406 1.884492,1.13602 18.472263,9.94491 18.566773,9.997978 2.04241,1.10077 1.47162,4.436108 -1.9779,5.018278 -3.8328,0.64628 -23.6926,0.21123 -24.758432,-0.81125 -1.065832,-1.02248 -3.128761,-9.952508 -2.38166,-11.397048 z"
                                        id="path71" inkscape:connector-curvature="0" style="fill:#2b2e35" />
                                    <path
                                        d="m 97.811733,91.05889 c 0,0 0,0 0,0 -0.531815,0 -0.962937,0.431122 -0.962937,0.962937 0,0.390123 0.235387,0.741697 0.596073,0.890362 l 8.690141,3.580684 c 0.33285,0.137124 0.71386,-0.02152 0.85101,-0.354371 0.0703,-0.17073 0.065,-0.363285 -0.0148,-0.529831 0,0 0,0 0,0 -0.16181,-0.337931 -8.534567,-4.549781 -9.159517,-4.549781 z"
                                        id="path73" inkscape:connector-curvature="0"
                                        style="fill:#ffffff;fill-opacity:0.5409747" />
                                    <path
                                        d="M 4.7885777,0.14337409 C -2.3916511,15.318415 -0.93648928,25.511334 9.1540631,30.722129 c 14.6375939,7.558904 58.4575649,-1.38125 58.4575649,-1.38125 0,0 -0.783025,6.308893 0,11.935665 2.045069,14.695745 11.771227,39.179607 13.829041,42.256064 2.845719,4.254384 11.514347,1.045919 11.677633,-2.496524 C 93.281588,77.493642 86.583449,32.250683 85.56487,23.623168 84.551542,14.995127 81.35235,13.741873 72.008327,11.38334 69.861668,10.8415 44.476109,4.52813 42.150573,4.7121459 28.829399,5.7662293 16.3754,4.2433053 4.7885777,0.14337409 Z"
                                        id="path75" inkscape:connector-curvature="0" style="fill:#42474f" />
                                    <path
                                        d="m 16.595273,28.372964 c 14.491707,1.625 52.857904,-1.724578 54.398776,-0.202526 1.47111,1.453143 1.225659,26.73457 4.525699,41.36724 L 75.017868,68.1559 c -3.10356,-8.626272 -6.326155,-19.117928 -7.40624,-26.879356 -0.783025,-5.626772 0,-11.935665 0,-11.935665 l -1.766875,0.342256 C 57.515061,31.24893 22.035146,37.373965 9.1540631,30.722129 2.1746515,27.117937 -0.67343163,21.130207 0.60981369,12.758938 2.8194978,22.220856 8.1479704,27.425742 16.595273,28.372964 Z"
                                        id="path77" inkscape:connector-curvature="0" style="fill:#52565e" />
                                </g>
                                <path style="fill:#dfdfdf;fill-rule:evenodd;stroke:none;stroke-width:1"
                                    inkscape:connector-curvature="0" id="path81"
                                    d="M 61.88864,127.5 H 0 v 0 68.2528 C 0,196.71775 0.78225,197.5 1.7472,197.5 H 86 v 0 -45.88864 C 86,138.29502 75.204976,127.5 61.88864,127.5 Z" />
                            </svg>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modal-role" class="btn btn-primary">
                                New Role
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-auto ms-auto d-print-none">
                <div class="d-flex">
                    <!-- <input type="search" class="form-control d-inline-block w-9 me-3" placeholder="Search user…"/> -->

                    <a href="{{route('user-add')}}" class="btn btn-primary">
                        New user
                    </a>


                </div>
            </div>
        </div>
        <div class="row row-deck row-cards">
            <div class="table-responsive">
                <table id="branch_table" class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr>
                            <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox"
                                    aria-label="Select all invoices"></th>

                            <th>User Name</th>
                            <th>Phone No</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!--
            <div class="d-flex mt-4">
              <ul class="pagination ms-auto" id="paginationLinks">

              </ul>
            </div> -->
    </div>
</div>


<div class="modal modal-blur fade" id="modal-role" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="alert-container"></div>
            <div class="model-body">


            </div>
            <div class="modal-body overflow-x-auto">
                <div id="save-role-container"></div>

                <div class="mb-3">
                    <label class="form-label">Role Name</label>
                    <input type="text" id="role_name" class="form-control" placeholder="Role Name">
                </div>

                <table class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>Module Name</th>
                            <th>Read</th>
                            <th>Write</th>
                            <th>Create</th>
                            <th>Update</th>
                            <th>Order Transfer</th>
                            <th>Order Approve</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($modules as $module)

                                            <tr>
                                                <td>{{ $module['module_name'] }}</td>
                                                @foreach (['read', 'update', 'create', 'delete', 'order transfer', 'order approve'] as $permission_name)
                                                                        @php
                                                                            $permission = collect($module['permissions'])->firstWhere('permission_name', $permission_name);
                                                                        @endphp

                                                                        @if ($permission)

                                                                            <td>
                                                                                <input type="checkbox" id="role_permission_{{ $permission['permission_id'] }}"
                                                                                    name="permission_{{ $permission['permission_id'] }}"
                                                                                    name="permission_{{ $permission['permission_id'] }}"
                                                                                    data-module-id="{{ $module['module_id'] }}" @if (in_array($permission, array_column($module['permissions'], 'permission_name'))) @endif>
                                                                            </td>
                                                                        @else
                                                                            <td></td>
                                                                        @endif
                                                @endforeach
                                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>

                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-secondary ms-auto" data-bs-dismiss="modal">
                    Cancel
                </a>
                <a id="saveRole" href="#" class="btn btn-primary ">
                    Create Role
                </a>
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="" id="edit_role_id">
<div class="modal modal-blur fade" id="update-role" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="update-role-container"></div>

            <div class="modal-body overflow-x-auto">
                <div class="mb-3">
                    <label class="form-label">Role Name</label>
                    <input type="text" id="edit_role_name" class="form-control" placeholder="User Name">
                </div>

                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>Module Name</th>
                                <th>Read</th>
                                <th>Write</th>
                                <th>Create</th>
                                <th>Update</th>
                                <th>Order Transfer</th>
                                <th>Order Approve</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($modules as $module)

                                <tr>
                                    <td>{{ $module['module_name'] }}</td>
                                    @foreach (['read', 'update', 'create', 'delete', 'order transfer', 'order approve'] as $permission_name)
                                    @php
                                        $permission = collect($module['permissions'])->firstWhere('permission_name', $permission_name);
                                    @endphp

                                    @if ($permission)

                                        <td>
                                            <input
                                                type="checkbox"
                                                id="role_permission_{{ $permission['permission_id'] }}"
                                                name="permission_{{ $permission['permission_id'] }}"
                                                name="permission_{{ $permission['permission_id'] }}"
                                                data-module-id="{{ $module['module_id'] }}"
                                                @if (in_array($permission, array_column($module['permissions'], 'permission_name')))  @endif
                                            >
                                        </td>
                                    @else
                                        <td></td>
                                    @endif
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>

                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel
                </a>
                <a id="UpdateRole" href="#" class="btn btn-primary">
                    Update Role
                </a>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="add_user" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">

                        <div class="mb-3">

                            <label class="form-label">User Name</label>
                            <input type="text" id="user_name" class="form-control" placeholder="User Name">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" id="user_phone_no" class="form-control" placeholder="User Phone Number">
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">User Role</label>

                        </div>

                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">User Address</label>
                            <textarea id="user_address" name="user_address" class="form-control" rows="3"></textarea>

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                    Cancel
                </a>
                <a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal" id="updateOrderBtn">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 5l0 14" />
                        <path d="M5 12l14 0" />
                    </svg>
                    Save User
                </a>

            </div>
        </div>
    </div>
</div>


<input type="hidden" name="" id="delete_user_id">
<div class="modal modal-blur fade" id="delete_user" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    Do you want to delete this user?
                </div>
            </div>

            <div class="modal-footer">
                <a href="#" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel
                </a>
                <a id="DeleteUserBtn" href="#" class="btn btn-primary" data-bs-dismiss="modal">
                    Delete This User
                </a>
            </div>
        </div>
    </div>
</div>


<input type="hidden" name="" id="delete_role_id">
<div class="modal modal-blur fade" id="delete_role" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                Do you want to delete this role?

            </div>

            <div class="modal-footer">
                <a href="#" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel
                </a>
                <a id="DeleteRoleBtn" href="#" class="btn btn-primary" data-bs-dismiss="modal">
                    Delete This Role
                </a>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script> -->

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>


        $(document).ready(function () {
            document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
                checkbox.checked = false; // Uncheck all checkboxes
            });
            $('#saveRole').on('click', function (e) {

            e.preventDefault();
            const userName = $('#role_name').val();

            // Validate data
            if (!userName) {
                showAlertSaveRole('warning', 'Please fill all fields and select at least one permission.');
                return;
            }
            const permissionIds = [];
            const moduleIds = [];
            $('input[type="checkbox"]:checked').each(function () {

                const permissionId = $(this).attr('id').replace('save_permission_', '');  // Extract permission_id from id
                const moduleId = $(this).data('module-id');
                permissionIds.push(permissionId);
                if (!moduleIds.includes(moduleId)) {
                    moduleIds.push(moduleId);
                }
            });
            // Prepare data to be sent
            const data = {
                _token: $('meta[name="csrf-token"]').attr('content'),
                role_id: null,
                role_name: userName,
                user_permission: permissionIds.join(','),
                user_module: moduleIds.join(','),

            };

            $.ajax({
                url: "{{ route('role_add_and_edit') }}",
                type: 'POST',
                data: data,
                success: function (response) {
                    if (response.status == 200) {
                        
                        location.href = "{{route('user-master')}}";
                        $('#modal-role').modal('hide');
                        showAlertSaveRole('success', response.message);
                    } else {

                        showAlertSaveRole('warning', response.message);

                    }
                },
                error: function (xhr, status, error) {
                    // Handle error
                    showAlertSaveRole('warning', xhr.responseJSON.message);

                }
            });
        });
    });

    $(document).ready(function () {
        // Fetch users on page load
        // fetchUsers();

        // Search event
        // $('input[type="search"]').on('input', function () {
        //     fetchUsers(1, $(this).val());
        // });

        // Pagination event
        // $(document).on('click', '.pagination a', function (e) {
        //     e.preventDefault();
        //     const page = $(this).attr('data-page');
        //     fetchUsers(page);
        // });

        // function fetchUsers(page = 1, search = '') {
        //     const perPage = 5;

        //     $.ajax({
        //         url: '{{ route("user-list")}}',
        //         type: 'POST',
        //         data: {
        //             _token: $('meta[name="csrf-token"]').attr('content'),
        //             search: search,
        //             per_page: perPage,
        //             page: page,
        //         },
        //         success: function (response) {
        //             // Update user list
        //             let usersHtml = '';
        //             response.data.users.forEach(user => {
        //                 usersHtml += `
        //                     <div class="col-md-6 col-lg-3">
        //                         <div class="card">
        //                             <div class="card-body p-4 text-center">
        //                                 <span class="avatar avatar-xl mb-3 rounded" style="background-image: url(/path/to/user/image)"></span>
        //                                 <h3 class="m-0 mb-1"><a href="#">${user.user_name}</a></h3>
        //                                 <div class="text-secondary">${user.role_name}</div>

        //                             </div>
        //                             <div class="d-flex">
        //                                 <a href="#" class="card-btn" onclick="editUser(${user.id})">Edit</a>
        //                                 <a href="#" class="card-btn" onclick="delete_user(${user.id})">Delete</a>
        //                             </div>
        //                         </div>
        //                     </div>
        //                 `;
        //             });
        //             $('.row-cards').html(usersHtml);

        //             // Update pagination
        //             let paginationHtml = '';
        //             for (let i = 1; i <= response.data.total_pages; i++) {
        //                 paginationHtml += `
        //                     <li class="page-item ${response.data.current_page == i ? 'active' : ''}">
        //                         <a class="page-link" href="#" data-page="${i}">${i}</a>
        //                     </li>
        //                 `;
        //             }
        //             $('#paginationLinks').html(paginationHtml);
        //             const userCountText = `${1} - ${response.data.total} of ${response.data.total_pages}`;
        //             $('#pagination_code').text(userCountText);

        //         },
        //     });
        // }


        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $('#branch_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('user-list') }}",
                type: 'POST',
                data: function (d) {
                    d.search = d.search.value;
                    d.per_page = d.length;
                    d.page = d.start / d.length + 1;
                    d.draw = d.draw;
                    d.sort = d.order[0].column === 1 ? 'user_name' : 'id';
                    d.sortOrder = d.order[0].dir;

                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken  // Add CSRF token in the header
                },
                dataSrc: function (response) {
                    console.log(response.data);
                    if (response.status === 200) {
                        return response.data.users;
                    }
                    return [];  // Return an empty array if no data
                }
            },
            columns: [
                { data: 'serial_number', name: 'serial_number', orderable: true },
                { data: 'user_name', name: 'user_name', orderable: true },
                { data: 'user_phone_number', name: 'user_phone_number', orderable: false },
                { data: 'role_name', name: 'role_name', orderable: false },
                {
                    data: 'user_id',
                    name: 'operations',
                    render: function (data, type, row) {
                        console.log(row);
                        return `
                                
                                 <ul class="action-list d-flex list-unstyled">
                                    <li class="action-item" title="Edit User" onclick="editUser(${row.id})">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.441 9.78804L10.8714 9.22624L10.8714 9.22625L11.441 9.78804ZM16.6693 4.48756L16.0997 3.92577L16.0997 3.92577L16.6693 4.48756ZM19.5785 4.51064L18.9998 5.06299L18.9998 5.06299L19.5785 4.51064ZM19.656 4.59183L20.2347 4.03949L20.2347 4.03948L19.656 4.59183ZM19.6081 7.36308L19.0484 6.79151L19.6081 7.36308ZM14.3024 12.5589L14.8621 13.1305L14.3024 12.5589ZM13.3468 13.082L13.1649 12.3029L13.3468 13.082ZM10.8871 13.194L10.3401 13.7778H10.3401L10.8871 13.194ZM10.9166 10.7596L11.6991 10.926V10.926L10.9166 10.7596ZM10.8687 13.1763L10.3069 13.7458H10.3069L10.8687 13.1763ZM20.6015 5.99343L19.8016 5.9796V5.97961L20.6015 5.99343ZM18.1329 3.4431L18.1392 2.64312H18.1392L18.1329 3.4431ZM11.0742 10.2149L10.3716 9.83235L10.3702 9.8349L11.0742 10.2149ZM11.0708 10.2212L10.3668 9.84121L10.3654 9.84378L11.0708 10.2212ZM13.8821 12.9184L14.2668 13.6198L14.2673 13.6196L13.8821 12.9184ZM13.8803 12.9194L14.2641 13.6213L14.265 13.6208L13.8803 12.9194ZM13.5882 3.8C14.0301 3.8 14.3882 3.44183 14.3882 3C14.3882 2.55817 14.0301 2.2 13.5882 2.2V3.8ZM21.8 11.4706C21.8 11.0288 21.4418 10.6706 21 10.6706C20.5582 10.6706 20.2 11.0288 20.2 11.4706H21.8ZM4.17157 19.8284L4.73726 19.2627H4.73726L4.17157 19.8284ZM19.8284 19.8284L19.2627 19.2627L19.8284 19.8284ZM12.0105 10.3498L17.2388 5.04936L16.0997 3.92577L10.8714 9.22624L12.0105 10.3498ZM18.9998 5.06299L19.0773 5.14418L20.2347 4.03948L20.1572 3.95829L18.9998 5.06299ZM19.0484 6.79151L13.7426 11.9874L14.8621 13.1305L20.1678 7.93466L19.0484 6.79151ZM13.1649 12.3029C12.4515 12.4695 12.0023 12.5723 11.6798 12.6003C11.3673 12.6274 11.383 12.5624 11.4341 12.6103L10.3401 13.7778C10.7861 14.1957 11.3434 14.2354 11.8179 14.1943C12.2824 14.1541 12.8656 14.0158 13.5287 13.861L13.1649 12.3029ZM10.134 10.5932C9.99523 11.2461 9.87001 11.8247 9.84142 12.285C9.81195 12.7595 9.86929 13.3142 10.3069 13.7458L11.4304 12.6067C11.4828 12.6584 11.4197 12.6837 11.4383 12.3842C11.4578 12.0707 11.5491 11.631 11.6991 10.926L10.134 10.5932ZM11.4341 12.6103C11.4329 12.6091 11.4317 12.6079 11.4304 12.6067L10.3069 13.7458C10.3178 13.7566 10.3289 13.7672 10.3401 13.7778L11.4341 12.6103ZM19.0773 5.14418C19.4103 5.49305 19.6037 5.69811 19.7228 5.86171C19.8285 6.00687 19.8009 6.02119 19.8016 5.9796L21.4014 6.00726C21.4091 5.56204 21.2262 5.2082 21.0162 4.9198C20.8196 4.64984 20.5367 4.35592 20.2347 4.03949L19.0773 5.14418ZM20.1678 7.93466C20.4806 7.62832 20.7734 7.34399 20.9791 7.08078C21.1988 6.79971 21.3937 6.45237 21.4014 6.00726L19.8016 5.97961C19.8023 5.93814 19.8293 5.95363 19.7185 6.09546C19.5937 6.25517 19.3932 6.45384 19.0484 6.79151L20.1678 7.93466ZM17.2388 5.04936C17.5995 4.68368 17.8139 4.46885 17.9866 4.33569C18.1406 4.21698 18.162 4.24335 18.1265 4.24307L18.1392 2.64312C17.6738 2.63943 17.3079 2.83874 17.0098 3.06847C16.7305 3.28375 16.4281 3.59286 16.0997 3.92577L17.2388 5.04936ZM20.1572 3.95829C19.8346 3.62025 19.5374 3.3063 19.2617 3.08655C18.9674 2.85198 18.6048 2.64682 18.1392 2.64312L18.1265 4.24307C18.091 4.24279 18.1126 4.21668 18.2644 4.33768C18.4347 4.47349 18.6453 4.6916 18.9998 5.06299L20.1572 3.95829ZM10.8714 9.22625C10.7027 9.39725 10.5048 9.58771 10.3716 9.83236L11.7768 10.5974C11.772 10.6063 11.7729 10.6 11.8072 10.5611C11.8477 10.5153 11.9047 10.4571 12.0105 10.3498L10.8714 9.22625ZM11.6991 10.926C11.7302 10.7794 11.7473 10.7007 11.7631 10.6424C11.7764 10.5933 11.781 10.5896 11.7762 10.5986L10.3654 9.84378C10.2336 10.0901 10.1837 10.3598 10.134 10.5932L11.6991 10.926ZM10.3702 9.8349L10.3668 9.84121L11.7748 10.6012L11.7782 10.5949L10.3702 9.8349ZM13.7426 11.9874C13.6371 12.0907 13.5798 12.1464 13.5347 12.1861C13.4965 12.2197 13.4896 12.2212 13.4969 12.2172L14.2673 13.6196C14.5066 13.4881 14.6931 13.2959 14.8621 13.1305L13.7426 11.9874ZM13.5287 13.861C13.7615 13.8066 14.025 13.752 14.2641 13.6213L13.4965 12.2174C13.5039 12.2134 13.4985 12.2186 13.4482 12.2332C13.3893 12.2502 13.3101 12.269 13.1649 12.3029L13.5287 13.861ZM13.4974 12.217L13.4956 12.218L14.265 13.6208L14.2668 13.6198L13.4974 12.217ZM19.5656 7.43426L16.565 4.43422L15.4337 5.5657L18.4344 8.56574L19.5656 7.43426ZM13 20.2H11V21.8H13V20.2ZM3.8 13V11H2.2V13H3.8ZM11 3.8H13.5882V2.2H11V3.8ZM20.2 11.4706V13H21.8V11.4706H20.2ZM11 20.2C9.09177 20.2 7.74107 20.1983 6.71751 20.0607C5.71697 19.9262 5.14963 19.6751 4.73726 19.2627L3.60589 20.3941C4.36509 21.1533 5.32635 21.488 6.50431 21.6464C7.65927 21.8017 9.137 21.8 11 21.8V20.2ZM2.2 13C2.2 14.863 2.1983 16.3407 2.35358 17.4957C2.51195 18.6737 2.84669 19.6349 3.60589 20.3941L4.73726 19.2627C4.32489 18.8504 4.07383 18.283 3.93931 17.2825C3.8017 16.2589 3.8 14.9082 3.8 13H2.2ZM13 21.8C14.863 21.8 16.3407 21.8017 17.4957 21.6464C18.6737 21.488 19.6349 21.1533 20.3941 20.3941L19.2627 19.2627C18.8504 19.6751 18.283 19.9262 17.2825 20.0607C16.2589 20.1983 14.9082 20.2 13 20.2V21.8ZM20.2 13C20.2 14.9082 20.1983 16.2589 20.0607 17.2825C19.9262 18.283 19.6751 18.8504 19.2627 19.2627L20.3941 20.3941C21.1533 19.6349 21.488 18.6737 21.6464 17.4957C21.8017 16.3407 21.8 14.863 21.8 13H20.2ZM3.8 11C3.8 9.09177 3.8017 7.74107 3.93931 6.71751C4.07383 5.71697 4.32489 5.14963 4.73726 4.73726L3.60589 3.60589C2.84669 4.36509 2.51195 5.32635 2.35358 6.50431C2.1983 7.65927 2.2 9.137 2.2 11H3.8ZM11 2.2C9.137 2.2 7.65927 2.1983 6.50431 2.35358C5.32635 2.51195 4.36509 2.84669 3.60589 3.60589L4.73726 4.73726C5.14963 4.32489 5.71697 4.07383 6.71751 3.93931C7.74107 3.8017 9.09177 3.8 11 3.8V2.2Z" fill="black"/>
                                        </svg>                            
                                    </li>
                                    <li class="action-item" title="Delete User" onclick="delete_user(${row.id})"">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.8 6.60007V5.80007H4V6.60007H4.8ZM19.2 6.60007H20V5.80007H19.2V6.60007ZM3 5.80007C2.55817 5.80007 2.2 6.15824 2.2 6.60007C2.2 7.04189 2.55817 7.40007 3 7.40007V5.80007ZM21 6.60007V7.40007C21.4418 7.40007 21.8 7.0419 21.8 6.60007C21.8 6.15825 21.4418 5.80007 21 5.80007L21 6.60007ZM11 11.1C11 10.6582 10.6418 10.3 10.2 10.3C9.75815 10.3 9.39998 10.6582 9.39998 11.1H11ZM9.39998 16.5C9.39998 16.9419 9.75815 17.3 10.2 17.3C10.6418 17.3 11 16.9419 11 16.5H9.39998ZM14.6001 11.1C14.6001 10.6582 14.2419 10.3 13.8001 10.3C13.3582 10.3 13.0001 10.6582 13.0001 11.1H14.6001ZM13.0001 16.5C13.0001 16.9419 13.3582 17.3 13.8001 17.3C14.2419 17.3 14.6001 16.9419 14.6001 16.5H13.0001ZM4.8 7.40007H19.2V5.80007H4.8V7.40007ZM18.4 6.60007V15.0001H20V6.60007H18.4ZM13.2 20.2001H10.8V21.8001H13.2V20.2001ZM5.6 15.0001V6.60007H4V15.0001H5.6ZM10.8 20.2001C9.36317 20.2001 8.36603 20.1984 7.61478 20.0974C6.88655 19.9995 6.51029 19.8216 6.24437 19.5557L5.11299 20.6871C5.72575 21.2998 6.49593 21.5613 7.40159 21.6831C8.28423 21.8018 9.4084 21.8001 10.8 21.8001V20.2001ZM4 15.0001C4 16.3917 3.9983 17.5158 4.11697 18.3985C4.23873 19.3041 4.50024 20.0743 5.11299 20.6871L6.24437 19.5557C5.97844 19.2898 5.80061 18.9135 5.7027 18.1853C5.6017 17.434 5.6 16.4369 5.6 15.0001H4ZM18.4 15.0001C18.4 16.4369 18.3983 17.434 18.2973 18.1853C18.1994 18.9135 18.0216 19.2898 17.7556 19.5557L18.887 20.6871C19.4998 20.0743 19.7613 19.3041 19.883 18.3985C20.0017 17.5158 20 16.3917 20 15.0001H18.4ZM13.2 21.8001C14.5916 21.8001 15.7158 21.8018 16.5984 21.6831C17.5041 21.5613 18.2743 21.2998 18.887 20.6871L17.7556 19.5557C17.4897 19.8216 17.1134 19.9995 16.3852 20.0974C15.634 20.1984 14.6368 20.2001 13.2 20.2001V21.8001ZM3 7.40007H21V5.80007H3V7.40007ZM8.29997 6.6V5H6.69997V6.6H8.29997ZM9.49997 3.8H14.5V2.2H9.49997V3.8ZM15.7 5V6.6H17.3V5H15.7ZM14.5 3.8C15.1627 3.8 15.7 4.33726 15.7 5H17.3C17.3 3.4536 16.0464 2.2 14.5 2.2V3.8ZM8.29997 5C8.29997 4.33726 8.83723 3.8 9.49997 3.8V2.2C7.95357 2.2 6.69997 3.4536 6.69997 5H8.29997ZM3 7.40007C5.62184 7.40005 7.70721 7.40004 9.74999 7.40003C11.8212 7.40002 13.8497 7.40001 16.5 7.4L16.5 5.8C13.8639 5.80001 11.807 5.80002 9.74998 5.80003C7.69301 5.80004 5.63603 5.80005 3 5.80007L3 7.40007ZM16.5 7.4L21 7.40007L21 5.80007L16.5 5.8L16.5 7.4ZM9.39998 11.1V16.5H11V11.1H9.39998ZM13.0001 11.1V16.5H14.6001V11.1H13.0001Z" fill="black"/>
                                        </svg>
                        
                                    </li>
                                </ul>
                                
                                `;

                    },
                }
            ],
            order: [[0, 'desc']],
            "pageLength": 10,
            "lengthMenu": [10, 25, 50, 100]
        });
        $('input[aria-controls="branch_table"]').on('keyup', function () {
            table.search(this.value).draw();
        });

        $('#DeleteUserBtn').click(function (e) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            e.preventDefault();

            var userId = $('#delete_user_id').val();
            if (userId) {
                $.ajax({
                    url: "{{ route('user_remove') }}",
                    type: 'POST',
                    data: {
                        _token: csrfToken,
                        user_id: userId,
                    },
                    success: function (response) {
                        if (response.status == 200) {
                            $('#delete_user_id').val();
                            $('#delete_user').modal('hide');
                            location.reload();
                            showAlert('success',response.message );

                        } else {
                            showAlert('warning',response.message );
                        }
                    },
                    error: function (xhr, status, error) {
                        showAlert('warning',error );
                    }
                });
            } else {
                showAlert('success','Please fill in both fields' );
            }
        });

            $('input[type="checkbox"]').on('change', function () {
                console.log(`Checkbox ${$(this).attr('id')} is now: ${$(this).is(':checked')}`);
            });

        $('#UpdateRole').on('click', function (e) {

            e.preventDefault();
            const role_id = $('#edit_role_id').val();
            const role_name = $('#edit_role_name').val();


                // Validate data
                if (!role_name ) {
                    showAlertUpdateRole('warning', 'Please fill all fields and select at least one permission.');
                    return;
                }
                const permissionIds = [];
                const moduleIds = [];
                $('input[type="checkbox"]:checked').each(function () {

                    const permissionId = $(this).attr('id').replace('role_permission_', '');  // Extract permission_id from id
                    const moduleId = $(this).data('module-id');
                    permissionIds.push(permissionId);
                    if (!moduleIds.includes(moduleId)) {
                        moduleIds.push(moduleId);
                    }
                });
                // Prepare data to be sent
                const data = {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    role_id          : role_id,
                    role_name        : role_name,

                    user_permission  : permissionIds.join(','),
                    user_module      : moduleIds.join(','),
                };

            $.ajax({
                url: "{{ route('role_add_and_edit') }}",
                type: 'POST',
                data: data,
                success: function (response) {
                    if (response.status == 200) {

                        showAlertUpdateRole('success', 'Role Updated Successfully');
                        $('#update-role').modal('hide');
                        location.href = "{{route('user-master')}}";

                    } else {

                        showAlertUpdateRole('warning', response.message);
                    }
                },
                error: function (xhr, status, error) {
                    // Handle error
                    showAlertUpdateRole('warning',xhr.responseJSON.message);
                }
            });
        });


        $('#DeleteRoleBtn').click(function (e) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            e.preventDefault();

            var userId = $('#delete_role_id').val();

            if (userId) {
                $.ajax({
                    url: "{{ route('role_remove') }}",
                    type: 'POST',
                    data: {
                        _token: csrfToken,
                        role_id: userId,
                    },
                    success: function (response) {
                        if (response.status == 200) {
                            $('#delete_role_id').val();
                            $('#delete_role').modal('hide');
                            location.reload();
                            showAlert('success', response.message);

                        } else {
                            showAlert('warning', response.message);

                        }
                    },
                    error: function (xhr, status, error) {
                        showAlert('warning', error);


                    }
                });
            } else {
                showAlert('warning', 'Please fill in both fields.');

            }
        });




    });
    function edit_role(role_id) {

            // window.location.href = `/edit-role/${userId}`;
            document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
                checkbox.checked = false; // Uncheck all checkboxes
            });

        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{ route('role-details') }}",
            type: 'POST',
            data: {
                _token: csrfToken,
                role_id: role_id,
            },
            success: function (response) {
                // Handle success

                if (response.status == 200) {

                        var role_permission_ids = response.data.role_permission_ids;
                        if (role_permission_ids != null){
                            const permissionArray   = role_permission_ids.split(',');
                            document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
                                const permissionId = checkbox.id.replace('role_permission_', '');
                                if (permissionArray.includes(permissionId)) {
                                    checkbox.checked = true;
                                }
                            });
                        }
                        $('#edit_role_id').val(role_id);
                        $('#edit_role_name').val(response.data.role_name);
                        $('#update-role').modal('show');
                    } else {

                        showAlertUpdateRole('warning',response.message);
                    }
                },
                error: function(xhr, status, error) {

                    showAlertUpdateRole('warning',error);
                }
            });

    }

    function delete_role(order_id) {
        $('#delete_role_id').val(order_id);
        $('#delete_role').modal('show');
    }




    function editUser(userId) {

        // Redirect to the edit page and pass the user ID
        window.location.href = `/edit-user/${userId}`;
    }

    function delete_user(order_id) {
        $('#delete_user_id').val(order_id);
        $('#delete_user').modal('show');

    }


    function showAlert(type, message) {
        const alertContainer = document.getElementById('role-container');
        const alertHTML = `
                <div class="alert alert-${type} alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div>
                            ${type === 'success' ? `
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M5 12l5 5l10 -10" />
                            </svg>` : `
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" />
                                <path d="M12 9v4" />
                                <path d="M12 17h.01" />
                            </svg>`}
                        </div>
                        <div>${message}</div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            `;
        alertContainer.innerHTML = alertHTML;
        console.log("here");
    }


    function showAlertUpdateRole(type, message) {
        const alertContainer = document.getElementById('update-role-container');
        const alertHTML = `
                <div class="alert alert-${type} alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div>
                            ${type === 'success' ? `
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M5 12l5 5l10 -10" />
                            </svg>` : `
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" />
                                <path d="M12 9v4" />
                                <path d="M12 17h.01" />
                            </svg>`}
                        </div>
                        <div>${message}</div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            `;
        alertContainer.innerHTML = alertHTML;
        console.log("here");
    }

    function showAlertSaveRole(type, message) {
        const alertContainer = document.getElementById('save-role-container');
        const alertHTML = `
                <div class="alert alert-${type} alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div>
                            ${type === 'success' ? `
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M5 12l5 5l10 -10" />
                            </svg>` : `
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" />
                                <path d="M12 9v4" />
                                <path d="M12 17h.01" />
                            </svg>`}
                        </div>
                        <div>${message}</div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            `;
        alertContainer.innerHTML = alertHTML;
        console.log("here");
    }




</script>
@endsection
