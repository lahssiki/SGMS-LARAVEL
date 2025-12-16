@extends('layouts.default')

@section('content')
<div class="container">
    <h6 class="text-center mb-4">Security Guard Management</h6>

    <div class="row">
        <!-- TABLE -->
        <div class="col-md-8">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fullname</th>
                        <th>CIN</th>
                        <th>Adresse</th>
                        <th>Catégorie</th>
                        <th>Created</th>
                        <th colspan="3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($securityGuards as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->fullname }}</td>
                        <td>{{ $item->cin }}</td>
                        <td>{{ $item->adresse }}</td>
                        <td>{{ $item->categorie }}</td>
                        <td>{{ $item->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('security-guards.show', $item->id) }}" class="btn btn-sm btn-primary">Détails</a>
                        </td>
                        <td>
                            <a href="{{ route('security-guards.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('security-guards.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- CHART -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">
                    Guards by Category
                </div>
                <div class="card-body">
                    <canvas id="guardsChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('guardsChart');

new Chart(ctx, {
    type: 'pie',
    data: {
        labels: {!! json_encode($categories->keys()) !!},
        datasets: [{
            data: {!! json_encode($categories->values()) !!},
            backgroundColor: ['#0d6efd', '#198754']
        }]
    },
    options: {
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
</script>

@endsection

