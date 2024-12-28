@extends('installer::layouts.master')

@section('content')
<div class="requirements-check">
    <h3 class="mb-4">System Requirements</h3>
    
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Requirement</th>
                    <th>Current</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requirements as $requirement)
                <tr>
                    <td>{{ $requirement['name'] }}</td>
                    <td>{{ $requirement['current'] }}</td>
                    <td>
                        @if($requirement['status'])
                            <span class="badge bg-success">✓</span>
                        @else
                            <span class="badge bg-danger">✗</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <button class="btn btn-secondary" disabled>Previous</button>
        <button class="btn btn-primary next-step" 
                {{ collect($requirements)->contains('status', false) ? 'disabled' : '' }}>
            Next Step
        </button>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('.next-step').click(function() {
            window.location.href = "{{ route('installer.permissions') }}";
        });
    });
</script>
@endpush
@endsection 