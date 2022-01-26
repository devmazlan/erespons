@extends('layouts.opdlayout')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

            <h5 class="mb-0 text-uppercase">Data Kaduan </h5>
            <div class="ps-3">
                <nav aria-label="breadcrumb">

                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        @if(session()->has('message'))
        <div class="alert border-0 border-start border-2 border-success alert-dismissible fade show py-1">
            <div class="d-flex align-items-center">
                <div class="font-20 text-success"><i class='bx bxs-check-circle'></i>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0 text-success">Hore !! </h6>
                    <div> {{ session()->get('message') }}</div>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <br>
                        <thead>

                            <tr>
                                <th>Status Kaduan</th>
                                <th>Nama Pelapor</th>
                                <th>No Telp Pelapor</th>
                                <th>Lokasi</th>
                                <th>Kordinat</th>
                                <th>Jenis Pengadaun</th>
                                <th class="text-center">Aksi</th>



                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datakaduan as $p)
                            <tr>
                                <td>
                                    @if($p->status =='0')
                                    <div class="text-center"><i class="bx bx-circle text-danger"></i> </div>

                                    @elseif($p->status =='1')
                                    <div class="text-center"><i class="bx bx-circle text-warning"></i> </div>
                                    @else
                                    <div class="text-center"><i class="bx bx-circle text-success"></i> </div>
                                    @endif


                                </td>
                                <td>{{ $p->namauser }}</td>
                                <td>{{ $p->nohp }}</td>

                                <td>{{ $p->kelurahan }}-{{ $p->kecamatan }}</td>
                                <td>{{ $p->lat }} : {{ $p->lng }}</td>
                                <td>{{ $p->jenka }}</td>




                                <td class="text-center">

                                    <div class="col">
                                        <form action="{{ route('usatgas.destroy', $p->idPengaduan) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-info btn-sm"><i class='bx bx-info-square me-0'></i></button>

                                        </form>




                                    </div>

                                </td>





                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection