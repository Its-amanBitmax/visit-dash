@extends('admin.layout')

@section('title', 'Create Center Visit Evaluation')
@section('header', 'Create Center Visit')

@section('content')
    <style>
        html, body {
            height: 100%;
        }

        body {
            overflow: hidden;
        }

        .layout,
        .content {
            height: 100vh;
        }

        .main {
            overflow-y: auto;
            min-height: 0;
        }
    </style>
    <div class="page-card" style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;">
        <div>
            <div style="font-size:18px;font-weight:700;">New Center Visit Evaluation</div>
            <div style="color:#606776;">Fill in the details below.</div>
        </div>
        <a class="btn btn-secondary" href="{{ route('center-visit-evaluations.index') }}">Back</a>
    </div>

    @if ($errors->any())
        <div class="page-card" style="border-color:#fecaca;background:#fef2f2;color:#991b1b;">
            <ul style="margin:0;padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('center-visit-evaluations.store') }}" class="page-card form-grid">
        @csrf

        <div class="form-section">
            <h3>Basic Details</h3>
            <div class="form-row">
                <div class="form-group">
                    <label>Center Name</label>
                    <input type="text" name="center_name" value="{{ old('center_name') }}" required>
                </div>
                <div class="form-group">
                    <label>Location</label>
                    <input type="text" name="location" value="{{ old('location') }}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Visit Date</label>
                    <input type="date" name="visit_date" value="{{ old('visit_date') }}" required>
                </div>
                <div class="form-group">
                    <label>Duration</label>
                    <input type="text" name="duration" value="{{ old('duration') }}" required>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3>Infrastructure</h3>
            <div class="form-row">
                <div class="form-group">
                    <label>Infrastructure by Client</label>
                    <select name="infrastructure_by_client" required>
                        <option value="">Select</option>
                        <option value="meet" @selected(old('infrastructure_by_client') === 'meet')>Meet</option>
                        <option value="not_meet" @selected(old('infrastructure_by_client') === 'not_meet')>Not Meet</option>
                        <option value="need_change" @selected(old('infrastructure_by_client') === 'need_change')>Need Change</option>
                        <option value="action_required" @selected(old('infrastructure_by_client') === 'action_required')>Action Required</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Remarks</label>
                    <textarea name="remarks1">{{ old('remarks1') }}</textarea>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3>Other Requirements</h3>
            <div class="form-row">
                <div class="form-group">
                    <label>System Required by Client</label>
                    <select name="system_required_by_client" required>
                        <option value="">Select</option>
                        <option value="meet" @selected(old('system_required_by_client') === 'meet')>Meet</option>
                        <option value="not_meet" @selected(old('system_required_by_client') === 'not_meet')>Not Meet</option>
                        <option value="need_change" @selected(old('system_required_by_client') === 'need_change')>Need Change</option>
                        <option value="action_required" @selected(old('system_required_by_client') === 'action_required')>Action Required</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Remarks</label>
                    <textarea name="remarks2">{{ old('remarks2') }}</textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Manpower Required by Client</label>
                    <select name="manpower_required_by_client" required>
                        <option value="">Select</option>
                        <option value="meet" @selected(old('manpower_required_by_client') === 'meet')>Meet</option>
                        <option value="not_meet" @selected(old('manpower_required_by_client') === 'not_meet')>Not Meet</option>
                        <option value="need_change" @selected(old('manpower_required_by_client') === 'need_change')>Need Change</option>
                        <option value="action_required" @selected(old('manpower_required_by_client') === 'action_required')>Action Required</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Remarks</label>
                    <textarea name="remarks3">{{ old('remarks3') }}</textarea>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3>Evaluator</h3>
            <div class="form-row">
                <div class="form-group">
                    <label>Evaluator Name</label>
                    <input type="text" name="evaluator_name" value="{{ old('evaluator_name') }}" required>
                </div>
                <div class="form-group">
                    <label>Evaluator Remarks</label>
                    <textarea name="evaluator_remarks">{{ old('evaluator_remarks') }}</textarea>
                </div>
            </div>
        </div>

        <div style="display:flex;justify-content:flex-end;gap:10px;flex-wrap:wrap;">
            <button type="submit" class="btn">Save</button>
            <a class="btn btn-secondary" href="{{ route('center-visit-evaluations.index') }}">Back</a>
        </div>
    </form>
@endsection
