@extends('layouts.master')

@section('page-name','Laporan')

@section('content')
<div class="page-header">
    <h1 class="page-title">
        Laporan
    </h1>
</div>
<div class="row">
    <div class="col-12">
        <div class="card" id="print">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <h5>{{ $sitename }}</h5>
                    </div>
                    <div class="col-3">
                        <div class="d-flex">
                            <p class="ml-auto">
                                Tanggal : {{ now()->format('d-m-Y') }}<br>
                                Nama : {{ Auth::user()->name }}
                            </p>
                        </div>
                    </div>
                    <hr class="bg-color">
                    <table class="table card-table table-hover table-vcenter text-wrap title" id="print">
                        <thead>
                            <tr>
                                <th>Tanggal Awal</th>
                                <th>Tanggal Akhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" data-toggle="datepicker" id="tgl_awal" class="form-control"
                                        name="tanggal_awal" placeholder="Tanggal Awal">
                                </td>
                                <td>
                                    <input type="text" data-toggle="datepicker" id="tgl_akhir" class="form-control"
                                        name="tanggal_akhir" placeholder="Tanggal Akhir">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="card-footer">
                <div class="d-flex">
                    <a href="" onclick="this.href='cetak-data/'+$('#tgl_awal').val() + '/' + $('#tgl_akhir').val()"
                        target="_blank" id="submit_cetak" class="btn btn-primary ml-auto">Cetak</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    // const cetak = document.getElementById('submit_cetak');
    // cetak.addEventListener('click', function() {
    //     let tglawal = document.getElementById('tgl_awal').value;
    //     let tglakhir = document.getElementById('tgl_akhir').value;
    //     console.log(tglawal);
    //     $.ajax({
    //         type:'POST',
    //         url:'cetak-data/'+tglawal+'/'+tglakhir+'',
    //         data: {
    //             _token: $("meta[name='token']").attr('content'),
    //             tglAwal: tglawal,
    //             tglAkhir: tglakhir
    //         },
    //         success:function(respon) {
    //             console.log(respon);
    //         }
    //     })
    // })
    $(document).ready(function () {
        $('[data-toggle="datepicker"]').datepicker({
            format: 'yyyy-MM-dd'
        });
    });
</script>
@endpush