<html>
<style>
    @page { margin: 100px 25px; }
    footer {
        position: fixed;
        bottom: -60px;
        left: 0px;
        right: 0px;
        height: 50px;
        text-align: center;
    }
</style>

<body>
    <footer>
        Printed on: <?php echo date('Y-m-d H:i:s'); ?>
    </footer>
    <main>
        <table id="table" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Kategori</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Supplier</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $data_search__)
                    <tr>
                        <td>{{ $data_search__['kode'] }}</td>
                        <td>{{ $data_search__['nama'] }}</td>
                        <td>{{ $data_search__['jenis'] }}</td>
                        <td>{{ ($data_search__['category']['kode'] ?? '') }}.{{ ($data_search__['category']['nama'] ?? '') }}</td>
                        <td>{{ $data_search__['harga_beli'] }}</td>
                        <td>{{ $data_search__['harga_beli'] }}</td>
                        <td>{{ $data_search__['supplier'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</body>
</html>