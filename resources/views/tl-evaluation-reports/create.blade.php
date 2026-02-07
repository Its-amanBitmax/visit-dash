@extends('admin.layout')

@section('title', 'Create TL Report')
@section('header', 'Create TL Report')

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
            <div style="font-size:18px;font-weight:700;">New TL Evaluation</div>
            <div style="color:#606776;">Fill in the details below.</div>
        </div>
        <a class="btn btn-secondary" href="{{ route('tl-evaluation-reports.index') }}">Back</a>
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

    <form method="POST" action="{{ route('tl-evaluation-reports.store') }}" class="page-card form-grid">
        @csrf

        <div class="form-section">
            <h3>Basic Details</h3>
            <div class="form-row">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label>Employee ID</label>
                    <input type="text" name="employee_id" value="{{ old('employee_id') }}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Process/Project</label>
                    <input type="text" name="process_project" value="{{ old('process_project') }}" required>
                </div>
                <div class="form-group">
                    <label>Team Strength</label>
                    <input type="number" name="team_strength" value="{{ old('team_strength') }}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Evaluation From</label>
                    <input type="date" name="evaluation_from" value="{{ old('evaluation_from') }}" required>
                </div>
                <div class="form-group">
                    <label>Evaluation To</label>
                    <input type="date" name="evaluation_to" value="{{ old('evaluation_to') }}" required>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3>TL Performance (1-5)</h3>
            @php $ratings = [
                ['team_handling_rating','Team Handling','team_handling_remarks'],
                ['productivity_achievement_rating','Productivity Achievement','productivity_achievement_remarks'],
                ['quality_improvement_rating','Quality Improvement','quality_improvement_remarks'],
                ['attendance_management_rating','Attendance Management','attendance_management_remarks'],
                ['training_coaching_rating','Training & Coaching','training_coaching_remarks'],
                ['escalation_handling_rating','Escalation Handling','escalation_handling_remarks'],
                ['client_communication_rating','Client Communication','client_communication_remarks'],
                ['reporting_documentation_rating','Reporting & Documentation','reporting_documentation_remarks'],
            ]; @endphp
            @foreach ($ratings as [$rate, $label, $remark])
                <div class="form-row">
                    <div class="form-group">
                        <label>{{ $label }} Rating</label>
                        <input type="number" min="1" max="5" name="{{ $rate }}" value="{{ old($rate) }}" required>
                    </div>
                    <div class="form-group">
                        <label>{{ $label }} Remarks</label>
                        <textarea name="{{ $remark }}">{{ old($remark) }}</textarea>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="form-section">
            <h3>KPI Performance Review</h3>
            @php $kpis = ['aht','qa','csat','attendance','productivity']; @endphp
            @foreach ($kpis as $kpi)
                <div class="form-row">
                    <div class="form-group">
                        <label>{{ strtoupper($kpi) }} Target</label>
                        <input type="text" name="kpi_{{ $kpi }}_target" value="{{ old('kpi_'.$kpi.'_target') }}">
                    </div>
                    <div class="form-group">
                        <label>{{ strtoupper($kpi) }} Achieved</label>
                        <input type="text" name="kpi_{{ $kpi }}_achieved" value="{{ old('kpi_'.$kpi.'_achieved') }}">
                    </div>
                    <div class="form-group">
                        <label>{{ strtoupper($kpi) }} Status</label>
                        <select name="kpi_{{ $kpi }}_status">
                            <option value="">Select</option>
                            <option value="met" @selected(old('kpi_'.$kpi.'_status') === 'met')>Met</option>
                            <option value="not_met" @selected(old('kpi_'.$kpi.'_status') === 'not_met')>Not Met</option>
                        </select>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="form-section">
            <h3>Leadership & Team Management</h3>
            <div class="form-row">
                <div class="form-group">
                    <label>Team Discipline Maintained</label>
                    <select name="team_discipline_maintained" required>
                        <option value="">Select</option>
                        <option value="1" @selected(old('team_discipline_maintained') === '1')>Yes</option>
                        <option value="0" @selected(old('team_discipline_maintained') === '0')>No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Shift Adherence</label>
                    <select name="shift_adherence" required>
                        <option value="">Select</option>
                        <option value="1" @selected(old('shift_adherence') === '1')>Yes</option>
                        <option value="0" @selected(old('shift_adherence') === '0')>No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Roster Planning</label>
                    <select name="roster_planning" required>
                        <option value="">Select</option>
                        <option value="1" @selected(old('roster_planning') === '1')>Yes</option>
                        <option value="0" @selected(old('roster_planning') === '0')>No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Attrition Control</label>
                    <select name="attrition_control" required>
                        <option value="">Select</option>
                        <option value="strong" @selected(old('attrition_control') === 'strong')>Strong</option>
                        <option value="moderate" @selected(old('attrition_control') === 'moderate')>Moderate</option>
                        <option value="weak" @selected(old('attrition_control') === 'weak')>Weak</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Regular Coaching Sessions</label>
                    <select name="regular_coaching_sessions" required>
                        <option value="">Select</option>
                        <option value="1" @selected(old('regular_coaching_sessions') === '1')>Yes</option>
                        <option value="0" @selected(old('regular_coaching_sessions') === '0')>No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Training Plan Prepared</label>
                    <select name="training_plan_prepared" required>
                        <option value="">Select</option>
                        <option value="1" @selected(old('training_plan_prepared') === '1')>Yes</option>
                        <option value="0" @selected(old('training_plan_prepared') === '0')>No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Performance Improvement Tracking</label>
                    <select name="performance_improvement_tracking" required>
                        <option value="">Select</option>
                        <option value="1" @selected(old('performance_improvement_tracking') === '1')>Yes</option>
                        <option value="0" @selected(old('performance_improvement_tracking') === '0')>No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Low Performer Management</label>
                    <select name="low_performer_management" required>
                        <option value="">Select</option>
                        <option value="strong" @selected(old('low_performer_management') === 'strong')>Strong</option>
                        <option value="moderate" @selected(old('low_performer_management') === 'moderate')>Moderate</option>
                        <option value="weak" @selected(old('low_performer_management') === 'weak')>Weak</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3>Communication & Coordination</h3>
            <div class="form-row">
                <div class="form-group">
                    <label>Client Communication</label>
                    <select name="client_communication" required>
                        <option value="">Select</option>
                        <option value="excellent" @selected(old('client_communication') === 'excellent')>Excellent</option>
                        <option value="good" @selected(old('client_communication') === 'good')>Good</option>
                        <option value="average" @selected(old('client_communication') === 'average')>Average</option>
                        <option value="poor" @selected(old('client_communication') === 'poor')>Poor</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Internal Reporting</label>
                    <select name="internal_reporting" required>
                        <option value="">Select</option>
                        <option value="excellent" @selected(old('internal_reporting') === 'excellent')>Excellent</option>
                        <option value="good" @selected(old('internal_reporting') === 'good')>Good</option>
                        <option value="average" @selected(old('internal_reporting') === 'average')>Average</option>
                        <option value="poor" @selected(old('internal_reporting') === 'poor')>Poor</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Escalation Closure Speed</label>
                    <select name="escalation_closure_speed" required>
                        <option value="">Select</option>
                        <option value="fast" @selected(old('escalation_closure_speed') === 'fast')>Fast</option>
                        <option value="moderate" @selected(old('escalation_closure_speed') === 'moderate')>Moderate</option>
                        <option value="slow" @selected(old('escalation_closure_speed') === 'slow')>Slow</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Coordination with HR/Operations</label>
                    <select name="coordination_with_hr" required>
                        <option value="">Select</option>
                        <option value="good" @selected(old('coordination_with_hr') === 'good')>Good</option>
                        <option value="average" @selected(old('coordination_with_hr') === 'average')>Average</option>
                        <option value="weak" @selected(old('coordination_with_hr') === 'weak')>Weak</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3>Major Observations</h3>
            <div class="form-row">
                <div class="form-group">
                    <label>Strengths 1</label>
                    <textarea name="strengths1">{{ old('strengths1') }}</textarea>
                </div>
                <div class="form-group">
                    <label>Strengths 2</label>
                    <textarea name="strengths2">{{ old('strengths2') }}</textarea>
                </div>
                <div class="form-group">
                    <label>Strengths 3</label>
                    <textarea name="strengths3">{{ old('strengths3') }}</textarea>
                </div>
                <div class="form-group">
                    <label>Improvement 1</label>
                    <textarea name="improvement1">{{ old('improvement1') }}</textarea>
                </div>
                <div class="form-group">
                    <label>Improvement 2</label>
                    <textarea name="improvement2">{{ old('improvement2') }}</textarea>
                </div>
                <div class="form-group">
                    <label>Improvement 3</label>
                    <textarea name="improvement3">{{ old('improvement3') }}</textarea>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3>Final Rating</h3>
            <div class="form-row">
                <div class="form-group">
                    <label>Overall Rating (1-5)</label>
                    <input type="number" min="1" max="5" name="overall_rating" value="{{ old('overall_rating') }}" required>
                </div>
                <div class="form-group">
                    <label>Final Remarks</label>
                    <textarea name="final_remarks">{{ old('final_remarks') }}</textarea>
                </div>
                <div class="form-group">
                    <label>Evaluator Name</label>
                    <input type="text" name="evaluator_name" value="{{ old('evaluator_name') }}" required>
                </div>
                <div class="form-group">
                    <label>Evaluation Date</label>
                    <input type="date" name="evaluation_date" value="{{ old('evaluation_date') }}" required>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3>Recommendations</h3>
            <div class="form-row">
                <div class="form-group">
                    <label>Promotion Recommended</label>
                    <select name="promotion_recommended" required>
                        <option value="">Select</option>
                        <option value="1" @selected(old('promotion_recommended') === '1')>Yes</option>
                        <option value="0" @selected(old('promotion_recommended') === '0')>No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Training Required</label>
                    <select name="training_required" required>
                        <option value="">Select</option>
                        <option value="1" @selected(old('training_required') === '1')>Yes</option>
                        <option value="0" @selected(old('training_required') === '0')>No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Warning Required</label>
                    <select name="warning_required" required>
                        <option value="">Select</option>
                        <option value="1" @selected(old('warning_required') === '1')>Yes</option>
                        <option value="0" @selected(old('warning_required') === '0')>No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>PIP Recommended</label>
                    <select name="pip_recommended" required>
                        <option value="">Select</option>
                        <option value="1" @selected(old('pip_recommended') === '1')>Yes</option>
                        <option value="0" @selected(old('pip_recommended') === '0')>No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Salary Revision</label>
                    <select name="salary_revision" required>
                        <option value="">Select</option>
                        <option value="1" @selected(old('salary_revision') === '1')>Yes</option>
                        <option value="0" @selected(old('salary_revision') === '0')>No</option>
                    </select>
                </div>
            </div>
        </div>

        <div style="display:flex;justify-content:flex-end;gap:10px;flex-wrap:wrap;">
            <button type="submit" class="btn">Save</button>
            <a class="btn btn-secondary" href="{{ route('tl-evaluation-reports.index') }}">Back</a>
        </div>
    </form>
@endsection
