@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach ($items as $item)
                <div class="card m-3" style="width: 18rem;">
                    <img src="{{ asset('storage/'.$item->foto) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h3 class="card-title">{{ $item->judul }}</h3>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Editor : {{ $item->user->name }}</li>
                        <li class="list-group-item">Kategori : {{ $item->kategori->name }}</li>
                        <li class="list-group-item">Tanggal : {{ $item->tanggal }}</li>
                    </ul>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#isiModal{{ $item->id }}">
                        Details
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="isiModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $item->judul }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="{{ asset('storage/'. $item->foto) }}" alt="" class="img" style="width: 250px"><br>
                                        <small class="text-secondary text-center">Kategori : {{ $item->kategori->name }}</small><br>
                                        <small class="text-secondary text-center">Editor : {{ $item->user->name }}</small><br>
                                        <small class="text-secondary text-center">Tanggal : {{ $item->tanggal }}</small><br>
                                        {{ $item->isi }}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach
    </div>
</div>
@endsection
