@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="mb-3">Daftar Artikel</h1>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">
                        Tambah Artikel
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ url('artikel') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah artikel</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Judul artikel</label>
                                                <input type="text" class="form-control" name="judul">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Foto artikel</label>
                                                <input type="file" class="form-control" name="foto">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Isi artikel</label>
                                                <input type="text" class="form-control" name="isi">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Kategori</label>
                                                <select name="kategori_id" class="form-select">
                                                    @foreach ($kategoris as $kategori)
                                                        <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Isi</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Editor</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($artikels as $artikel)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $artikel->judul }}</td>
                                    <td><img src="{{ asset('storage/'.$artikel->foto) }}" alt="" class="img img-thumbnail"></td>
                                    <td>{{ $artikel->isi }}</td>
                                    <td>{{ $artikel->kategori->name }}</td>
                                    <td>{{ $artikel->user->name }}</td>
                                    <td>{{ $artikel->tanggal }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $artikel->id }}">
                                            Edit
                                        </button>

                                        <!-- Modal Edit-->
                                        <div class="modal fade" id="editModal{{ $artikel->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ url('artikel/'.$artikel->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit artikel</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label">Judul artikel</label>
                                                                <input type="text" class="form-control" name="judul" value="{{ $artikel->judul }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Foto artikel</label>
                                                                <input type="file" class="form-control" name="foto">
                                                                <input type="hidden" class="form-control" name="oldfoto" value="{{ $artikel->foto }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Isi artikel</label>
                                                                <input type="text" class="form-control" name="isi" value="{{ $artikel->isi }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Kategori</label>
                                                                <select name="kategori_id" class="form-select">
                                                                    @foreach ($kategoris as $kategori)
                                                                        <option value="{{ $kategori->id }}" @selected($artikel->kategori_id == $kategori->id)>{{ $kategori->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-danger" onclick="event.preventDefault();
                                        document.getElementById('delete-form{{ $artikel->id }}').submit();">Delete</button>

                                        {{-- Form Delete --}}
                                        <form id="delete-form{{ $artikel->id }}" action="{{ url('artikel/'. $artikel->id) }}" method="POST" class="d-none">
                                            @csrf
                                            @method('delete')
                                        </form>
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
@endsection
