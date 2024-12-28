<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installation - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .step-indicator {
            margin-bottom: 2rem;
        }
        .step-indicator .step {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        .step-indicator .step.active {
            background: #0d6efd;
            color: white;
        }
        .step-indicator .step.completed {
            background: #198754;
            color: white;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="step-indicator d-flex justify-content-between mb-4">
                            @foreach(['Requirements', 'Permissions', 'Purchase', 'Database', 'Application'] as $index => $step)
                                <div class="step {{ $currentStep === ($index + 1) ? 'active' : '' }} 
                                           {{ $currentStep > ($index + 1) ? 'completed' : '' }}">
                                    {{ $index + 1 }}
                                </div>
                            @endforeach
                        </div>
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('scripts')
</body>
</html> 