@extends('layouts.default')

@section('content')
<section class="bg-light py-4">
<div class="container">

<div class="card shadow">
<div class="card-body">

<h3 class="mb-4 text-center">Security Guard Details</h3>

<div class="row">
    <div class="col-md-4 text-center">
        @if($securityGuard->image)
            <img src="{{ asset('storage/'.$securityGuard->image) }}"
                 class="img-fluid rounded mb-3"
                 style="max-height:250px">
        @else
            <img src="{{ asset('images/default-user.png') }}"
                 class="img-fluid rounded mb-3">
        @endif
    </div>

    <div class="col-md-8">
        <p><strong>ID:</strong> {{ $securityGuard->id }}</p>
        <p><strong>Full Name:</strong> {{ $securityGuard->fullname }}</p>
        <p><strong>CIN:</strong> {{ $securityGuard->cin }}</p>
        <p><strong>Address:</strong> {{ $securityGuard->adresse ?? '---' }}</p>
        <p><strong>Category:</strong>
            <span class="badge bg-info">{{ $securityGuard->categorie }}</span>
        </p>
        <p><strong>Created At:</strong> {{ $securityGuard->created_at->format('Y-m-d') }}</p>
    </div>
</div>

<hr>
<h4 class="mt-4">Weekly Planning</h4>

@if($plannings->isEmpty())
    <div class="alert alert-warning">No planning found for this guard.</div>
@else
<table class="table table-bordered text-center">
<thead class="table-dark">
<tr>
    <th>Week</th>
    <th>Mon</th>
    <th>Tue</th>
    <th>Wed</th>
    <th>Thu</th>
    <th>Fri</th>
    <th>Sat</th>
    <th>Sun</th>
</tr>
</thead>
<tbody>
@foreach($plannings as $p)
<tr>
    <td>{{ $p->week_start }}</td>
    <td>{{ $p->monday ?? 'Off' }}</td>
    <td>{{ $p->tuesday ?? 'Off' }}</td>
    <td>{{ $p->wednesday ?? 'Off' }}</td>
    <td>{{ $p->thursday ?? 'Off' }}</td>
    <td>{{ $p->friday ?? 'Off' }}</td>
    <td>{{ $p->saturday ?? 'Off' }}</td>
    <td>{{ $p->sunday ?? 'Off' }}</td>
</tr>
@endforeach
</tbody>
</table>
@endif
<div class="d-flex justify-content-end gap-2">
    <a href="{{ route('security-guards.edit',$securityGuard->id) }}"
       class="btn btn-warning">Edit</a>

    <a href="{{ route('weekly-plannings.create',['guard'=>$securityGuard->id]) }}"
       class="btn btn-success">Add Planning</a>

    <a href="{{ route('security-guards.index') }}"
       class="btn btn-secondary">Back</a>
</div>

</div>
</div>

</div>
</section>
@endsection

