@extends('admin.layout')

@section('title', 'Create QA Report')
@section('header', 'Create QA Report')

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
            <div style="font-size:18px;font-weight:700;">New QA Evaluation</div>
            <div style="color:#606776;">Fill in the details below.</div>
        </div>
        <a class="btn btn-secondary" href="{{ route('qa-evaluation-reports.index') }}">Back</a>
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

    <form method="POST" action="{{ route('qa-evaluation-reports.store') }}" class="page-card form-grid">
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
                    <label>Client Name</label>
                    <input type="text" name="client_name" value="{{ old('client_name') }}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Reporting Manager</label>
                    <input type="text" name="reporting_manager" value="{{ old('reporting_manager') }}" required>
                </div>
                <div class="form-group">
                    <label>Evaluation Date</label>
                    <input type="date" name="evaluation_date" value="{{ old('evaluation_date') }}" required>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3>Period & Audit</h3>
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
            <div class="form-row">
                <div class="form-group">
                    <label>Total Audits Done</label>
                    <input type="number" name="total_audits_done" value="{{ old('total_audits_done') }}" required>
                </div>
                <div class="form-group">
                    <label>Audit Type</label>
                    <select name="audit_type" required>
                        <option value="">Select</option>
                        <option value="calls" @selected(old('audit_type') === 'calls')>Calls</option>
                        <option value="chats" @selected(old('audit_type') === 'chats')>Chats</option>
                        <option value="both" @selected(old('audit_type') === 'both')>Both</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3>Work Performance (1-5)</h3>
            @php $ratings = [
                ['audit_accuracy_rating','Audit Accuracy','audit_accuracy_remarks'],
                ['process_knowledge_rating','Process Knowledge','process_knowledge_remarks'],
                ['compliance_sop_rating','Compliance SOP','compliance_sop_remarks'],
                ['reporting_accuracy_rating','Reporting Accuracy','reporting_accuracy_remarks'],
                ['productivity_rating','Productivity','productivity_remarks'],
                ['escalation_handling_rating','Escalation Handling','escalation_handling_remarks'],
                ['documentation_skills_rating','Documentation Skills','documentation_skills_remarks'],
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
            <h3>QA Skill Assessment</h3>
            <div class="form-row">
                <div class="form-group">
                    <label>Monitoring Quality</label>
                    <select name="monitoring_quality" required>
                        <option value="">Select</option>
                        <option value="excellent" @selected(old('monitoring_quality') === 'excellent')>Excellent</option>
                        <option value="good" @selected(old('monitoring_quality') === 'good')>Good</option>
                        <option value="average" @selected(old('monitoring_quality') === 'average')>Average</option>
                        <option value="poor" @selected(old('monitoring_quality') === 'poor')>Poor</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Error Identification</label>
                    <select name="error_identification" required>
                        <option value="">Select</option>
                        <option value="excellent" @selected(old('error_identification') === 'excellent')>Excellent</option>
                        <option value="good" @selected(old('error_identification') === 'good')>Good</option>
                        <option value="average" @selected(old('error_identification') === 'average')>Average</option>
                        <option value="poor" @selected(old('error_identification') === 'poor')>Poor</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Correct Parameter Marking</label>
                    <select name="correct_parameter_marking" required>
                        <option value="">Select</option>
                        <option value="1" @selected(old('correct_parameter_marking') === '1')>Yes</option>
                        <option value="0" @selected(old('correct_parameter_marking') === '0')>No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Score Calculation Accuracy</label>
                    <select name="score_calculation_accuracy" required>
                        <option value="">Select</option>
                        <option value="1" @selected(old('score_calculation_accuracy') === '1')>Yes</option>
                        <option value="0" @selected(old('score_calculation_accuracy') === '0')>No</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3>Feedback & Coaching</h3>
            <div class="form-row">
                <div class="form-group">
                    <label>Agent Coaching Quality</label>
                    <select name="agent_coaching_quality" required>
                        <option value="">Select</option>
                        <option value="excellent" @selected(old('agent_coaching_quality') === 'excellent')>Excellent</option>
                        <option value="good" @selected(old('agent_coaching_quality') === 'good')>Good</option>
                        <option value="average" @selected(old('agent_coaching_quality') === 'average')>Average</option>
                        <option value="poor" @selected(old('agent_coaching_quality') === 'poor')>Poor</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Feedback Professionalism</label>
                    <select name="feedback_professionalism" required>
                        <option value="">Select</option>
                        <option value="excellent" @selected(old('feedback_professionalism') === 'excellent')>Excellent</option>
                        <option value="good" @selected(old('feedback_professionalism') === 'good')>Good</option>
                        <option value="average" @selected(old('feedback_professionalism') === 'average')>Average</option>
                        <option value="poor" @selected(old('feedback_professionalism') === 'poor')>Poor</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Improvement Tracking</label>
                    <select name="improvement_tracking" required>
                        <option value="">Select</option>
                        <option value="1" @selected(old('improvement_tracking') === '1')>Yes</option>
                        <option value="0" @selected(old('improvement_tracking') === '0')>No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Repeat Error Follow-up</label>
                    <select name="repeat_error_followup" required>
                        <option value="">Select</option>
                        <option value="1" @selected(old('repeat_error_followup') === '1')>Yes</option>
                        <option value="0" @selected(old('repeat_error_followup') === '0')>No</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3>Compliance & Discipline</h3>
            <div class="form-row">
                <div class="form-group">
                    <label>Attendance Adherence</label>
                    <select name="attendance_adherence" required>
                        <option value="">Select</option>
                        <option value="1" @selected(old('attendance_adherence') === '1')>Yes</option>
                        <option value="0" @selected(old('attendance_adherence') === '0')>No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Punctuality</label>
                    <select name="punctuality" required>
                        <option value="">Select</option>
                        <option value="1" @selected(old('punctuality') === '1')>Yes</option>
                        <option value="0" @selected(old('punctuality') === '0')>No</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Data Confidentiality Awareness</label>
                    <select name="data_confidentiality_awareness" required>
                        <option value="">Select</option>
                        <option value="strong" @selected(old('data_confidentiality_awareness') === 'strong')>Strong</option>
                        <option value="moderate" @selected(old('data_confidentiality_awareness') === 'moderate')>Moderate</option>
                        <option value="weak" @selected(old('data_confidentiality_awareness') === 'weak')>Weak</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Policy Compliance</label>
                    <select name="policy_compliance" required>
                        <option value="">Select</option>
                        <option value="strong" @selected(old('policy_compliance') === 'strong')>Strong</option>
                        <option value="moderate" @selected(old('policy_compliance') === 'moderate')>Moderate</option>
                        <option value="weak" @selected(old('policy_compliance') === 'weak')>Weak</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3>Observations</h3>
            <div class="form-row">
                <div class="form-group">
                    <label>Strengths</label>
                    <textarea name="strengths">{{ old('strengths') }}</textarea>
                </div>
                <div class="form-group">
                    <label>Improvement Areas</label>
                    <textarea name="improvement_areas">{{ old('improvement_areas') }}</textarea>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3>Score Summary</h3>
            <div class="form-row">
                <div class="form-group">
                    <label>Average Quality Score</label>
                    <input type="number" step="0.01" name="average_quality_score" value="{{ old('average_quality_score') }}">
                </div>
                <div class="form-group">
                    <label>Error Count</label>
                    <input type="number" name="error_count" value="{{ old('error_count') }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Critical Errors</label>
                    <input type="number" name="critical_errors" value="{{ old('critical_errors') }}">
                </div>
                <div class="form-group">
                    <label>Repeat Errors</label>
                    <input type="number" name="repeat_errors" value="{{ old('repeat_errors') }}">
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
            </div>
        </div>

        <div class="form-section">
            <h3>Evaluator</h3>
            <div class="form-row">
                <div class="form-group">
                    <label>Evaluator Name</label>
                    <input type="text" name="evaluator_name" value="{{ old('evaluator_name') }}" required>
                </div>
            </div>
        </div>

        <div style="display:flex;justify-content:flex-end;gap:10px;flex-wrap:wrap;">
            <button type="submit" class="btn">Save</button>
            <a class="btn btn-secondary" href="{{ route('qa-evaluation-reports.index') }}">Back</a>
        </div>
    </form>
@endsection
