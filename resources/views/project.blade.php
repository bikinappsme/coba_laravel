@extends('layouts.app')

@section('title', 'Home')  

@section('content')

<header class="masthead">
    <div class="container">
        <div class="masthead-subheading">Welcome To Our Studio!</div>
        <div class="masthead-heading text-uppercase">CRUD Sederhana</div>
        <a href="" class="btn btn-primary btn-xl text-uppercase" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Data</a>
    </div>
</header>

<!-- Modal Tambah Data -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form id="contactForm" action="{{ route('crud.store') }}" method="POST" class="needs-validation" novalidate>
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="addModalLabel">Tambah Data Baru</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-group mb-3">
              <label for="judul" class="form-label">Judul</label>
              <input type="text" class="form-control" id="judul" name="judul" required>
              <div class="invalid-feedback">Judul wajib diisi.</div>
            </div>
            <div class="mb-3">
              <label for="deskripsi" class="form-label">Deskripsi</label>
              <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
              <div class="invalid-feedback">Deskripsi wajib diisi.</div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<!-- Project--> 
<section class="page-section" id="project">
    <div class="container">
        @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    <div class="text-center">
        <h2 class="section-heading text-uppercase">Project</h2>
        <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
    </div>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Content</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $index => $post)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $post->judul }}</td>
                <td>{{ $post->deskripsi }}</td>
                <td>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-sm btn-info me-2" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $post->id }}" data-judul="{{ $post->judul }}" data-deskripsi="{{ $post->deskripsi }}">Edit</button>
                   <form action="{{ route('crud.destroy', $post->id) }}" method="POST" class="d-inline delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-sm btn-danger btn-delete">Delete</button>
                    </form>
                  </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>

<!-- Modal Edit Data -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="editForm" action="" method="POST" class="needs-validation" novalidate>
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group mb-3">
            <label for="editJudul" class="form-label">Judul</label>
            <input type="text" class="form-control" id="editJudul" name="judul" required>
            <div class="invalid-feedback">Judul wajib diisi.</div>
          </div>
          <div class="mb-3">
            <label for="editDeskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="editDeskripsi" name="deskripsi" rows="4" required></textarea>
            <div class="invalid-feedback">Deskripsi wajib diisi.</div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
    (function () {
      'use strict';
  
      const forms = document.querySelectorAll('.needs-validation');
  
      Array.from(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }
  
          form.classList.add('was-validated');
        }, false);
      });

      const editModal = document.getElementById('editModal');

    editModal.addEventListener('show.bs.modal', function (event) {
      const button = event.relatedTarget;
      const id = button.getAttribute('data-id');
      const judul = button.getAttribute('data-judul');
      const deskripsi = button.getAttribute('data-deskripsi');

      const form = document.getElementById('editForm');
      form.action = `/crud/update/${id}`;

      document.getElementById('editJudul').value = judul;
      document.getElementById('editDeskripsi').value = deskripsi;
    });
    })();
  </script>
  @push('scripts')
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif
@if($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops!',
        html: `{!! implode('<br>', $errors->all()) !!}`,
    });
</script>
@endif
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif
<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.btn-delete');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            const form = this.closest('form');

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>
@endpush

@endsection