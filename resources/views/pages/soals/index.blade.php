@extends('layouts.app')

@section('title', 'Bank Soal')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Bank Soal</h1>
                <div class="section-header-button">
                    <a href="{{ route('soal.create') }}" class="btn btn-primary">Add New</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Bank Soal</a></div>
                    <div class="breadcrumb-item">All Bank Soal</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <h2 class="section-title">Bank Soal</h2>
                <p class="section-lead">
                    You can manage all Bank Soal, such as editing, deleting and more.
                </p>


                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Bank Soal</h4>
                            </div>
                            <div class="card-body">
                                <div class="float-left">
                                    <select class="form-control selectric">
                                        <option>Action For Selected</option>
                                        <option>Move to Draft</option>
                                        <option>Move to Pending</option>
                                        <option>Delete Pemanently</option>
                                    </select>
                                </div>
                                <div class="float-right">
                                    <form method="GET" action="{{ route('soal.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="pertanyaan">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>

                                            <th>ID</th>
                                            <th>Soal</th>
                                            <th>Jawaban A</th>
                                            <th>Jawaban B</th>
                                            <th>Jawaban C</th>
                                            <th>Jawaban D</th>
                                            {{-- <th>Created At</th> --}}
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($soals as $s)
                                            <tr>
                                                <td>{{ $s->id }}</td>
                                                <td>{{ $s->pertanyaan }}</td>
                                                <td>{{ $s->jawaban_a }}</td>
                                                <td>{{ $s->jawaban_b }}</td>
                                                <td>{{ $s->jawaban_c }}</td>
                                                <td>{{ $s->jawaban_d }}</td>
                                                {{-- <td>{{ $s->created_at }}</td> --}}
                                                <td>
                                                    <div class="d-flex justify-content-center">

                                                        <a href="{{ route('soal.edit', $s->id) }}"
                                                            class="btn btn-primary btn-action mr-1" data-toggle="tooltip"
                                                            title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('soal.destroy', $s->id) }}" method="post"
                                                            class="ml-2">



                                                            <input type="hidden" name="_method" value="DELETE">

                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                                            <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                <i class="fas fa-times"></i>Delete
                                                            </button>

                                                        </form>

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $soals->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
