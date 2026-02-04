<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminManagementController extends Controller
{
    public function index()
    {
        $admins = Admin::where('id', '!=', 1)->latest()->paginate(10);

        return view('admin-management.index', compact('admins'));
    }

    public function create()
    {
        return view('admin-management.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);
        $validated['password'] = Hash::make($validated['password']);

        Admin::create($validated);

        return redirect()
            ->route('admin.management.index')
            ->with('status', 'Admin created successfully.');
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);

        return view('admin-management.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $validated = $this->validateData($request, $admin->id, true);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $admin->update($validated);

        return redirect()
            ->route('admin.management.index')
            ->with('status', 'Admin updated successfully.');
    }

    public function destroy($id)
    {
        if ((int) $id === 1) {
            return back()->with('status', 'Default admin cannot be deleted.');
        }

        Admin::findOrFail($id)->delete();

        return redirect()
            ->route('admin.management.index')
            ->with('status', 'Admin deleted successfully.');
    }

    private function validateData(Request $request, ?int $adminId = null, bool $isUpdate = false): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('admins', 'username')->ignore($adminId),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('admins', 'email')->ignore($adminId),
            ],
            'password' => [$isUpdate ? 'nullable' : 'required', 'string', 'min:8', 'confirmed'],
        ]);
    }
}
