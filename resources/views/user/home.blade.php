@extends('layouts.opdlayout')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <h5 class="mb-0 text-uppercase">Beranda Admin OPD | <span class="text-primary">{{ $datauser->namaopd }}</span> </h5>
        <hr>
        <div class="ps-3">
            <nav aria-label="breadcrumb">

            </nav>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3">
            <div class="col">
                <div class="card radius-5 bg-gradient-white">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-dark">{{ $jeniskaduans }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-book fs-3 text-dark'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-dark" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-dark">
                            <p class="mb-0">JENIS KADUAN</p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-5 bg-gradient-white">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-dark">{{ $satgas }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-user fs-3 text-dark'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-dark" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-dark">
                            <p class="mb-0">SATGAS</p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-5 bg-gradient-white">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-dark">83</h5>
                            <div class="ms-auto">
                                <i class='bx bx-map-pin fs-3 text-dark'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-dark" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-dark">
                            <p class="mb-0">WILAYAH KERJA</p>

                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <div class="card radius-5 bg-gradient-deepblue">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $pengaduan }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-envelope fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">TOTAL KADUAN</p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-5 bg-gradient-ibiza">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $belum }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-envelope fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">KADUAN BELUM DIPROSES</p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-5 bg-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $sedang }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-envelope fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">KADUAN SEDANG DIPROSES</p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-5 bg-gradient-ohhappiness">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $selesai }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-envelope fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">KADUAN SUDAH SELESAI</p>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--end row-->


        <!--End Row-->



    </div>
</div>
@endsection