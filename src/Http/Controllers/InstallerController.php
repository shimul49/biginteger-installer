<?php

namespace BigInteger\LaravelInstaller\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use BigInteger\LaravelInstaller\Services\RequirementService;
use BigInteger\LaravelInstaller\Services\PermissionService;
use BigInteger\LaravelInstaller\Services\LicenseService;
use BigInteger\LaravelInstaller\Services\DatabaseService;

class InstallerController extends Controller
{
    public function requirements(RequirementService $requirementService)
    {
        $requirements = $requirementService->check();
        return view('installer::steps.requirements', compact('requirements'));
    }

    public function permissions(PermissionService $permissionService)
    {
        $permissions = $permissionService->check();
        return view('installer::steps.permissions', compact('permissions'));
    }

    public function purchase()
    {
        return view('installer::steps.purchase');
    }

    public function verifyPurchase(Request $request, LicenseService $licenseService)
    {
        $validated = $request->validate([
            'purchase_code' => 'required|string'
        ]);

        $result = $licenseService->verify($validated['purchase_code']);
        return response()->json($result);
    }

    public function database()
    {
        return view('installer::steps.database');
    }

    public function setupDatabase(Request $request, DatabaseService $databaseService)
    {
        $validated = $request->validate([
            'database_name' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|string',
            'host' => 'required|string'
        ]);

        $result = $databaseService->setup($validated);
        return response()->json($result);
    }

    public function application()
    {
        return view('installer::steps.application');
    }

    public function finalize(Request $request, LicenseService $licenseService)
    {
        $license = $licenseService->generate(
            $request->ip(),
            $request->getHost(),
            $licenseService->getMachineId()
        );

        return response()->json(['license' => $license]);
    }
} 