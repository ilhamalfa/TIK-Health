@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Data Diri') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col p-3">
                            <h3 class="mb-3">Input Data</h3>
                            <form action="{{ url('biodata') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Nama :</label>
                                    <input type="text" class="form-control" name="nama">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tinggi Badan :</label>
                                    <input type="text" class="form-control" name="tb">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Berat Badan :</label>
                                    <input type="text" class="form-control" name="bb">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Hobi :</label>
                                    <input type="text" class="form-control" name="hobi">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tahun Lahir :</label>
                                    <input type="text" class="form-control" name="tahun">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
    
                        @isset($data)
                        <div class="col p-3">
                            <h3 class="mb-3">Hasil Data Diri</h3>
                            <table class="table">
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $data['nama'] }}</td>
                                </tr>
                                <tr>
                                    <th>Tinggi Badan</th>
                                    <td>{{ $data['tb'] }} M</td>
                                </tr>
                                <tr>
                                    <th>Berat Badan</th>
                                    <td>{{ $data['bb'] }} Kg</td>
                                </tr>
                                <tr>
                                    <th>BMI</th>
                                    <td>{{ $data['bmi'] }}</td>
                                </tr>
                                <tr>
                                    <th>Status Berat Badan</th>
                                    <td>{{ $data['status'] }}</td>
                                </tr>
                                <tr>
                                    <th>Hobi</th>
                                    <td>{{ $data['hobi'] }}</td>
                                </tr>
                                <tr>
                                    <th>Umur</th>
                                    <td>{{ $data['umur'] }}</td>
                                </tr>
                                <tr>
                                    <th>Konsultasi Gratis</th>
                                    <td>{{ $data['konsul'] }}</td>
                                </tr>
                            </table>
                        </div>
                        @endisset

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
