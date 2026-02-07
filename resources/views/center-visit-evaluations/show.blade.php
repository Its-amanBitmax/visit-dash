@extends('admin.layout')

@section('title', 'Center Visit Details')
@section('header', 'Center Visit Details')

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
            <div style="font-size:18px;font-weight:700;">Center Visit #{{ $evaluation->id }}</div>
            <div style="color:#606776;">{{ $evaluation->center_name }} - {{ $evaluation->location }}</div>
        </div>
        <div style="display:flex;gap:10px;flex-wrap:wrap;">
            <a class="btn" href="{{ route('center-visit-evaluations.pdf', $evaluation->id) }}">Download PDF</a>
            <a class="btn btn-secondary" href="{{ route('center-visit-evaluations.edit', $evaluation->id) }}">Edit</a>
            <a class="btn" href="{{ route('center-visit-evaluations.index') }}">Back</a>
        </div>
    </div>

    @if (session('status'))
        <div class="page-card" style="border-color:#bfdbfe;background:#eff6ff;color:#1e3a8a;">
            {{ session('status') }}
        </div>
    @endif

    <div class="page-card" style="display:grid;gap:18px;">
        <div style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px;">
            <div class="card" style="box-shadow:none;border:1px solid #eef2f7;">
                <div style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:10px;">Basic Details</div>
                <div style="display:grid;gap:6px;">
                    <div>Center Name: <strong>{{ $evaluation->center_name }}</strong></div>
                    <div>Location: <strong>{{ $evaluation->location }}</strong></div>
                    <div>Visit Date: <strong>{{ $evaluation->visit_date }}</strong></div>
                    <div>Duration: <strong>{{ $evaluation->duration }}</strong></div>
                </div>
            </div>
            <div class="card" style="box-shadow:none;border:1px solid #eef2f7;">
                <div style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:10px;">Evaluator</div>
                <div style="display:grid;gap:6px;">
                    <div>Name: <strong>{{ $evaluation->evaluator_name }}</strong></div>
                    <div>Remarks: <strong>{{ $evaluation->evaluator_remarks }}</strong></div>
                </div>
            </div>
        </div>

        <div class="card" style="box-shadow:none;border:1px solid #eef2f7;">
            <div style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:10px;">Infrastructure</div>
            <div style="display:grid;gap:6px;">
                <div>Status: <strong>{{ $evaluation->infrastructure_by_client }}</strong></div>
                <div>Remarks: <strong>{{ $evaluation->remarks1 }}</strong></div>
            </div>
        </div>

        <div style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px;">
            <div class="card" style="box-shadow:none;border:1px solid #eef2f7;">
                <div style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:10px;">System Required</div>
                <div style="display:grid;gap:6px;">
                    <div>Status: <strong>{{ $evaluation->system_required_by_client }}</strong></div>
                    <div>Remarks: <strong>{{ $evaluation->remarks2 }}</strong></div>
                </div>
            </div>

            <div class="card" style="box-shadow:none;border:1px solid #eef2f7;">
                <div style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:10px;">Manpower Required</div>
                <div style="display:grid;gap:6px;">
                    <div>Status: <strong>{{ $evaluation->manpower_required_by_client }}</strong></div>
                    <div>Remarks: <strong>{{ $evaluation->remarks3 }}</strong></div>
                </div>
            </div>
        </div>
    </div>
@endsection
