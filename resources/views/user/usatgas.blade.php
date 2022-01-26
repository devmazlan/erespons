@extends('layouts.opdlayout')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

            <h5 class="mb-0 text-uppercase">Data Satgas</h5>
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
                                <th>NIK</th>
                                <th>Nama Satgas</th>
                                <th>Username</th>
                                <th>Phone</th>
                                <th>Wilayah Kerja</th>
                                <th>Jenis Pengadaun</th>
                                <th class="text-center">Aksi</th>



                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datauser as $p)
                            <tr>
                                <td>{{ $p->nik }}</td>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->username }}</td>
                                <td>{{ $p->phone_number }}</td>

                                <td>Kelurahan {{ $p->kel }} </td>
                                <td>{{ $p->jeniskaduans }}</td>

                                <td class="text-center">

                                    <div class="col">
                                        <form action="{{ route('usatgas.destroy', $p->id) }}" method="POST">
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
        <form action="{{ route('usatgas.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title " id="exampleModalLabel">Form Tambah Satgas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="opd" value="{{ $user->opd }}" class="form-control" required>
                    <h6 class="font-weight-bold text-primary">1. Data Profil Satgas.</h6>
                    <br>
                    <div class="mb-3">
                        <label class="form-label">NIK Satgas:</label>
                        <input type="text" name="nik" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Satgas:</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="validationCustom04" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" name="jk" id="validationCustom04" required>
                            <option selected disabled value="">pilih...</option>

                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>

                        </select>
                        <div class="invalid-feedback">mohon di isi.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input type="text" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No Handphone:</label>
                        <input type="text" name="phone_number" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat:</label>
                        <input type="text" name="address" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Username:</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>


                    <br>
                    <h6 class="font-weight-bold text-primary">2. Wilayah Kerja Satgas.</h6>
                    <hr class="mb-2 mt-4">
                    <div class="mb-3">
                        <label for="validationCustom04" class="form-label">Kecamatan</label>
                        <select id="country-dd" name="kecamatan" class="form-control">
                            <option value="">Pilih Kecamatan</option>
                            @foreach ($countries as $data)
                            <option value="{{$data->id}}">
                                {{$data->kecamatan}}
                            </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">mohon di isi.</div>
                    </div>

                    <div class="mb-3">
                        <label for="validationCustom04" class="form-label">Kelurahan</label>
                        <select id="state-dd" required name="kelurahan" class="form-control">
                        </select>
                        <div class="invalid-feedback">mohon di isi.</div>
                    </div>
                    <div class="mb-3">
                        <label for="validationCustom04" class="form-label">Jenis Pengaduan</label>
                        <select id="country-dd" name="jenisPengaduan" class="form-control">
                            <option value="">Pilih Kaduan</option>
                            @foreach ($jenis as $data)
                            <option value="{{$data->id}}">
                                {{$data->JenisPengaduan}}
                            </option>
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



<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<script>
    $(document).ready(function() {
        $('#country-dd').on('change', function() {
            var idCountry = this.value;
            $("#state-dd").html('');
            $.ajax({
                url: "{{url('adminopd/anggota/api/fetch-cities')}}",
                type: "POST",
                data: {
                    kec_id: idCountry,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function(result) {
                    $('#state-dd').html('<option value="">Select Kelurahan</option>');
                    $.each(result.states, function(key, value) {
                        $("#state-dd").append('<option value="' + value
                            .id + '">' + value.kelurahan + '</option>');
                    });
                    $('#city-dd').html('<option value="">Pilih Kecamatan</option>');
                }
            });
        });


    });
</script>