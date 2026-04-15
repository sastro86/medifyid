<table id="table" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Jenis</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Supplier</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data_search as $data_search__)
            <tr>
                <td>{{ $data_search__->kode }}</td>
                <td>{{ $data_search__->nama }}</td>
                <td>{{ $data_search__->jenis }}</td>
                <td>{{ $data_search__->harga_beli }}</td>
                <td>{{ $data_search__->harga_beli }}</td>
                <td>{{ $data_search__->supplier }}</td>
            </tr>
        @endforeach
    </tbody>
</table>