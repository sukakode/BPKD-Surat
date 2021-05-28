<li class="nav-item">
  <a href="{{ route('main') }}" class="nav-link active">
    <i class="nav-icon fas fa-home"></i>
    <p>
      Halaman Utama
    </p>
  </a>
</li>
{{-- <li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-edit"></i>
    <p>
      Master Data
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ route('jabatan.index') }}" class="nav-link">
        <i class="fas fa-cog nav-icon"></i>
        <p>Data Jabatan</p>
      </a>
    </li>  
    <li class="nav-item">
      <a href="{{ route('pengguna.index') }}" class="nav-link">
        <i class="fas fa-users nav-icon"></i>
        <p>Data Pengguna</p>
      </a>
    </li>  
  </ul>
</li> --}}
@if (auth()->user()->jabatan->nama == "Administrator")
<li class="nav-header">Master Data</li>
<li class="nav-item">
  <a href="{{ route('jabatan.index') }}" class="nav-link">
    <i class="fas fa-cog nav-icon"></i>
    <p>Data Jabatan</p>
  </a>
</li>  
<li class="nav-item">
  <a href="{{ route('pengguna.index') }}" class="nav-link">
    <i class="fas fa-users nav-icon"></i>
    <p>Data Pengguna</p>
  </a>
</li>  
@endif

@if (auth()->user()->jabatan->nama == "FO" || auth()->user()->jabatan->nama == "Administrator")
<li class="nav-header">Surat Masuk</li>
<li class="nav-item">
  <a href="{{ route('surat-masuk.create') }}" class="nav-link">
    <i class="nav-icon fas fa-sign-in-alt"></i>
    <p>
      Buat Surat Masuk
    </p>
  </a>
</li>
<li class="nav-item">
  <a href="{{ route('surat-masuk.index') }}" class="nav-link">
    <i class="nav-icon fas fa-table"></i>
    <p>
      Data Surat Masuk
    </p>
  </a>
</li>
@endif

<li class="nav-header">Disposisi</li>
<li class="nav-item">
  <a href="{{ route('disposisi.index') }}" class="nav-link">
    <i class="nav-icon fas fa-download"></i>
    <p>
      Data Disposisi
    </p>
  </a>
</li> 
@if (auth()->user()->jabatan->nama == "Administrator")
<li class="nav-item">
  <a href="{{ route('disposisi.index.admin') }}" class="nav-link">
    <i class="nav-icon fas fa-table"></i>
    <p>
      Seluruh Disposisi
    </p>
  </a>
</li> 
@endif

{{-- <li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-th"></i>
    <p>
      Simple Link
      <span class="right badge badge-danger">New</span>
    </p>
  </a>
</li> --}}