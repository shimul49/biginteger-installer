@extends('installer::layouts.master')

@section('content')
<div class="permissions-check">
    <h3 class="mb-4">Directory Permissions</h3>
    
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Directory/File</th>
                    <th>Permission</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($permissions as $permission)
                <tr>
                    <td>
                        {{ $permission['name'] }}
                        <small class="d-block text-muted">{{ $permission['path'] }}</small>
                    </td>
                    <td>{{ $permission['permission'] }}</td>
                    <td>
                        @if($permission['writable'])
                            <span class="badge bg-success">Writable</span>
                        @else
                            <span class="badge bg-danger">Not Writable</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('installer.requirements') }}" class="btn btn-secondary">Previous</a>
        <a href="{{ route('installer.purchase') }}" class="btn btn-primary next-step"
           {{ collect($permissions)->contains('writable', false) ? 'disabled' : '' }}>
            Next Step
        </a>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('.next-step').click(function(e) {
            if ($(this).attr('disabled')) {
                e.preventDefault();
                return false;
            }
        });
    });
</script>
@endpush
@endsection 