@extends('layouts.default')

@section('content')
<div class="container">
    <h4 class="text-center mb-4">📊 Security Guard Dashboard</h4>

    <div class="row">

        <!-- TABLE -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    Guards List
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Fullname</th>
                                <th>CIN</th>
                                <th>Adresse</th>
                                <th>Catégorie</th>
                                <th>Created</th>
                                <th colspan="3" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($securityGuards as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->fullname }}</td>
                                <td>{{ $item->cin }}</td>
                                <td>{{ $item->adresse }}</td>
                                <td>
                                    <span class="badge {{ $item->categorie=='chef' ? 'bg-primary' : 'bg-success' }}">
                                        {{ $item->categorie }}
                                    </span>
                                </td>
                                <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('security-guards.show', $item->id) }}"
                                       class="btn btn-sm btn-primary">View</a>
                                </td>
                                <td>
                                    <a href="{{ route('security-guards.edit', $item->id) }}"
                                       class="btn btn-sm btn-warning">Edit</a>
                                </td>
                                <td>
                                    <form action="{{ route('security-guards.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Delete this guard?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- DASHBOARD STAT -->
        <div class="col-md-4">
            <div class="card shadow-sm">
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

