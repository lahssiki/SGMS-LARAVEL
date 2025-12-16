@extends('layouts.default')

@section('content')
<div class="container">
    <h4 class="text-center mb-4">Modifier Planning Hebdomadaire</h4>

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('weekly-plannings.update', $weeklyPlanning->id) }}">
        @csrf
        @method('PUT')

        <!-- Sélection de l'agent -->
        <div class="mb-3">
            <label class="form-label">Agent de sécurité</label>
            <select name="security_guard_id" class="form-control" required>
                @foreach($guards as $guard)
                    <option value="{{ $guard->id }}"
                        {{ $weeklyPlanning->security_guard_id == $guard->id ? 'selected' : '' }}>
                        {{ $guard->fullname }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Date de début de semaine -->
        <div class="mb-3">
            <label class="form-label">Début de la semaine (Lundi)</label>
            <input type="date" name="week_start" class="form-control" value="{{ $weeklyPlanning->week_start }}" required>
        </div>

        <!-- Tableau Planning -->
        @php
        $days = ['monday'=>'Lundi','tuesday'=>'Mardi','wednesday'=>'Mercredi','thursday'=>'Jeudi','friday'=>'Vendredi','saturday'=>'Samedi','sunday'=>'Dimanche'];
        @endphp

        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Jour</th>
                    <th>Shift</th>
                </tr>
            </thead>
            <tbody>
            @foreach($days as $key => $day)
                <tr>
                    <td>{{ $day }}</td>
                    <td>
                        <select name="{{ $key }}" class="form-control">
                            <option value="">Off</option>
                            <option value="Morning" {{ $weeklyPlanning->$key=='Morning' ? 'selected' : '' }}>Morning</option>
                            <option value="Night" {{ $weeklyPlanning->$key=='Night' ? 'selected' : '' }}>Night</option>
                            <option value="Full Day" {{ $weeklyPlanning->$key=='Full Day' ? 'selected' : '' }}>Full Day</option>
                        </select>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="text-center">
            <button class="btn btn-primary px-5">Modifier le planning</button>
        </div>
    </form>
</div>
@endsection
