@extends('layouts.default')

@section('content')
    <section class="h-80 bg-dark">
        <div class="container py-3 h-80">
            <div class="row d-flex justify-content-center align-items-center h-80">
                <div class="col">
                    <div class="card card-registration my-4">
                        <div class="row g-0">
                            <div class="col-xl-12">
                                <div class="card-body p-md-5 text-black">
                                    <h1>Security Guard Details</h1>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <p>ID : {{ $securityGuard->id }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <p>Full Name : {{ $securityGuard->fullname }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <p>CIN : {{ $securityGuard->cin }}</p>
                                        </div>
                                        <div class="d-md-flex justify-content-start align-items-center mb-4 py-2">
                                            <p>Address : {{ $securityGuard->adresse }}</p>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <p>Category : {{ $securityGuard->categorie }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <p>Created At : {{ $securityGuard->created_at->format('Y-m-d') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4 ">
                                            <div class="form-outline ">
                                                <img src="{{ asset('storage/' . $securityGuard->image) }}"
                                                    alt="{{ $securityGuard->fullname }}" class=" w-50">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end pt-3 ">
                                            <a href="{{ route('security-guards.index')}}" class="btn btn-primary">Ok</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
