@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-group mb-2">
                <a href="{{url('master-items')}}" class="btn btn-sm btn-secondary">+ Master Items</a>
                <a href="{{url('ctg/form/new')}}" class="btn btn-sm btn-secondary">+ Kategori Baru</a>
            </div>
            <div class="card">
                <div class="card-header">Daftar Kategori</div>

                <div class="card-body">
                    <div id="filter-container">
                        <h4>Filter</h4>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group" id="filter-container">
                                    <label>Kode</label>
                                    <input type="text" class="form-control" id="filter-kode">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group" id="filter-container">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" id="filter-nama">
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-sm mt-1 btn-get-data">Filter</button>
                        <button class="btn btn-info btn-sm mt-1 btn-reset-data">Reset</button>
                        <span id="loading-filter" style="display: none;">Loading...</span>
                    </div>

                    <hr>
                    <table id="table" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th width="1">Kode</th>
                                <th>Nama</th>
                                <th width="1">View</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script>
    var start_date = '';
    var end_date = '';
    var data_per_fetch = 500;
    var data_fetched = 0;

    $(document).ready(function() {
        $('#table').DataTable({
            searching: false,
            order: [[0, 'desc']],
        });
        getData()
    });

    $('.btn-get-data').click(function() {
        getData()
    });

    $('.btn-reset-data').click(function() {
        $('#filter-kode').val('');
        $('#filter-nama').val('');
        getData();
    });

    function getData(){
        
        $('#loading-filter').show();
        var dataTableObj = $('#table').DataTable();
        var filter_kode = $('#filter-kode').val()
        var filter_nama = $('#filter-nama').val()
        dataTableObj.clear().draw();

        $.ajax({
            url: '{{url("ctg/search")}}',
            dataType: 'json',
            tryCount: 0,
            retryLimit: 3,
            data: 'kode=' + filter_kode + '&nama=' + filter_nama,
            success: function(results) {
                var data = results.data

                $.each(data, function(index, item) {
                    array_temp = [];
                    var kode = item.kode;
                    var html = `<a href="{{url('ctg/view/')}}/` + kode + `" class="btn btn-primary btn-sm">View</a>`

                    $.each(item, function(obj_name, obj_value) {
                        array_temp.push(obj_value)
                    })
                    array_temp.push(html)


                    dataTableObj.row.add(array_temp).draw(true);
                });
                $('#loading-filter').hide();
            },
            error: function(xhr, textStatus, errorThrown) {
                this.tryCount++;
                if (this.tryCount <= this.retryLimit) {
                    $.ajax(this);
                    return;
                }
                alert('Terjadi kesalahan server, tidak dapat mengambil data')
                $('#loading-filter').hide();

                return;
            }
        })
    }
</script>
@endsection