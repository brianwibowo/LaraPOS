@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Product</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">
                EditProduct
            </h2>
            <p class="section-lead">
                Halaman untuk mengedit produk.
            </p>

            <div class="card">
                <form action="{{ route('product.update', $item->id) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger col-lg-3">
                                @foreach ($errors->all() as $error)
                                    {{ $error }} <br/>
                                @endforeach    
                            </div>                
                        @endif

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Foto</label>
                                    <br/>
                                    <img src="{{ Storage::url($item->photo) }}" alt="{{ $item->name }}" class="img-responsive" width="80">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-file-image"></i>
                                            </div>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="photo" id="file">
                                            <label class="custom-file-label" id="fileName">Choose File</label>
                                          </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-pencil-alt"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="name" value="{{ $item->name }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-tag"></i>
                                            </div>
                                        </div>
                                        <select class="form-control" name="category_id">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ ($item->category_id || old('category_id')) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Stok</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-layer-group"></i>
                                            </div>
                                        </div>
                                        <input type="number" class="form-control currency" name="stock" value="{{ $item->stock }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>
                                        Harga Beli (<code>Cukup angka saja, tidak perlu titik atau koma.</code>)
                                    </label>
                                    
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <b>Rp</b>
                                            </div>
                                        </div>
                                        <input type="number" class="form-control" name="purchase_price" value="{{ $item->purchase_price }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>
                                        Harga Jual (<code>Cukup angka saja, tidak perlu titik atau koma.</code>)
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <b>Rp</b>
                                            </div>
                                        </div>
                                        <input type="number" class="form-control" name="selling_price" value="{{ $item->selling_price }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@section('addon-script')
<script type="text/javascript">
$('#file').change(function() {
    $('#fileName').html(this.files && this.files.length ? this.files[0].name : '');
})
</script>
@endsection