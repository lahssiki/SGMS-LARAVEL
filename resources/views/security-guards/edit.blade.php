@extends('layouts.default')

@section('content')
<section class="bg-light py-4">
    <div class="container">

        <div class="card shadow">
            <div class="card-body p-4">

                <h3 class="mb-4 text-center text-uppercase">
                    Edit Security Guard
                </h3>

                {{-- Errors --}}
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST"
                      action="{{ route('security-guards.update', $securityGuard->id) }}"
                      enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="row">

                        <!-- Full Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text"
                                   name="fullname"
                                   value="{{ old('fullname', $securityGuard->fullname) }}"
                                   class="form-control"
                                   required>
                        </div>

                        <!-- CIN -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">CIN</label>
                            <input type="text"
                                   name="cin"
                                   value="{{ old('cin', $securityGuard->cin) }}"
                                   class="form-control"
                                   required>
                        </div>

                        <!-- Address -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Address</label>
                            <input type="text"
                                   name="adresse"
                                   value="{{ old('adresse', $securityGuard->adresse) }}"
                                   class="form-control">
                        </div>

                        <!-- Category -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category</label>
                            <select name="categorie" class="form-select" required>
                                <option value="chef" {{ old('categorie', $securityGuard->categorie)=='chef' ? 'selected' : '' }}>
                                    Chef
                                </option>
                                <option value="Security" {{ old('categorie', $securityGuard->categorie)=='Security' ? 'selected' : '' }}>
                                    Security
                                </option>
                            </select>
                        </div>

                        <!-- Image -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Photo</label>
                            <input type="file" name="image" class="form-control">
                            @if($securityGuard->image)
                                <img src="{{ asset('storage/'.$securityGuard->image) }}"
                                     class="img-thumbnail mt-2"
                                     width="120">
                            @endif
                        </div>

                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ route('security-guards.show',$securityGuard->id) }}"
                           class="btn btn-secondary">
                            Cancel
                        </a>

                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</section>
@endsection
