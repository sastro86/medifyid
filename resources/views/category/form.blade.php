@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-group mb-2">
                <a href="{{url('ctg')}}" class="btn btn-secondary">Kembali Kategori</a>
            </div>
            <div class="card">

                @if($method == 'new')
                <div class="card-header">Buat Kategori Baru</div>
                @else
                <div class="card-header">Edit Kategori</div>
                @endif

                <div class="card-body">
                    <form method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Kode</label>
                            <input type="text" class="form-control" name="kode" required  value="{{$item->kode ?? ''}}">
                        </div>

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" required  value="{{$item->nama ?? ''}}">
                        </div>

                        <button class="btn btn-primary mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
@endsection