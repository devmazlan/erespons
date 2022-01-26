@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

            <h5 class="mb-0 text-uppercase">Data Jenis Kaduan</h5>
            <div class="ps-3">
                <nav aria-label="breadcrumb">

                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Data</button>


                </div>
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
                                <th>Id</th>
                                <th class="text-center">Icon Pengaduan</th>
                                <th>Jenis Pengaduan</th>
                                <th>Keterangan</th>
                                <th class="text-center">Aksi</th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jk as $p)
                            <tr>
                                <td>{{ $p->id }}</td>
                                <td class="text-center"> <img src="{{ asset('jeniskaduan/'.$p->logo_jenis_pengaduan) }}" height="50" alt="boe93"> </td>
                                <td>{{ $p->JenisPengaduan }}</td>
                                <td>{{ $p->description }}</td>
                                <td class="text-center">

                                    <div class="col">
                                        <form action="{{ route('jeniskaduan.destroy', $p->id) }}" method="POST">
                                            <!-- <a class="btn btn-info btn-sm" href="{{ route('opd.edit',$p->id) }}"><i class='bx bx-edit me-0'></i></a> -->

                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class='bx bx-trash me-0'></i></button>

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


<div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('jeniskaduan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title " id="exampleModalLabel">Form Tambah Jenis Pengaduan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Jenis Kaduan:</label>
                        <input type="text" name="JenisPengaduan" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan:</label>
                        <input type="text" name="description" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon:</label>
                        <input type="file" name="image" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="validationCustom04" class="form-label">Pilih OPD</label>
                        <select class="form-select" name="opd" id="validationCustom04" required>
                            <option selected disabled value="">pilih...</option>
                            @foreach($opds as $p)
                            <option value="{{ $p->id }}">{{ $p->nama_opd }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">mohon di isi.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection