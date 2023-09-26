@extends('layouts.default')

<body>
    @section('content')
    <div>
        @if($errors->any())
        <ul class="alert alert-danger col-md-3 m-2 " role="alert">
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
        @endif
    </div>
    <section class="h-80 bg-dark">
        <div class="container py-3 h-80">
          <div class="row d-flex justify-content-center align-items-center h-80">
            <div class="col">
              <div class="card card-registration my-4">
                <div class="row g-0">
                  <div class="col-xl-12">
                    <div class="card-body p-md-5 text-black">
                      <h3 class="mb-5 text-uppercase">Security registration form</h3>
                    <form  method="post" action="{{route('security-guards.store')}}">
                        @csrf
                         @method('post')
                      <div class="row">
                        <div class="col-md-6 mb-4">
                          <div class="form-outline">
                            <input type="text" name="fullname" class="form-control form-control-lg" />
                            <label class="form-label">Full name</label>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 mb-4">
                          <div class="form-outline">
                            <input type="text" name="cin" class="form-control form-control-lg" />
                            <label class="form-label" >CIN</label>
                          </div>
                        </div>
                      </div>
                      <div class="form-outline mb-4">
                        <input type="text" name="adresse" class="form-control form-control-lg" />
                        <label class="form-label" >Address</label>
                      </div>
                      <div class="d-md-flex justify-content-start align-items-center mb-4 py-2">
                        <h6 class="mb-0 me-4">Categorie</h6>
                        <input type="text" name="categorie" class="form-control form-control-lg" />
                      </div>      
                      <div class="col-md-6 mb-4">
                        <div class="form-outline">
                          <input type="file" name="image" class="form-control form-control-lg" />
                          <label class="form-label" >Photo</label>
                        </div>
                      </div>   
                      <div class="d-flex justify-content-end pt-3">
                        <button type="submit" class="btn btn-success btn-lg ms-2">Submit form</button>
                      </div>
                     </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      @endsection
</body>

