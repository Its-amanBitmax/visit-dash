@extends('admin.layout')

@section('title', 'QA Evaluation Reports')
@section('header', 'QA Evaluation Reports')

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
            <div style="font-size:18px;font-weight:700;">All QA Reports</div>
            <div style="color:#606776;">Manage QA evaluation reports.</div>
        </div>
        <div style="display:flex;gap:10px;flex-wrap:wrap;align-items:center;">
            <form method="GET" action="{{ route('qa-evaluation-reports.index') }}" data-live-search
                  style="display:flex;gap:8px;align-items:center;">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name / employee / project / client"
                       style="padding:10px 12px;border-radius:12px;border:1px solid #e5e7eb;font-size:14px;">
            </form>
            <a class="btn btn-secondary" href="{{ route('qa-evaluation-reports.pdf.all') }}">Download All PDF</a>
            <a class="btn" href="{{ route('qa-evaluation-reports.create') }}">Create New</a>
        </div>
    </div>

    @if (session('status'))
        <div class="page-card" style="border-color:#bfdbfe;background:#eff6ff;color:#1e3a8a;">
            {{ session('status') }}
        </div>
    @endif

    <div class="page-card">
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Employee ID</th>
                        <th>Project</th>
                        <th>Eval Date</th>
                        <th>Overall</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reports as $report)
                        <tr>
                            <td>{{ $loop->iteration + ($reports->currentPage() - 1) * $reports->perPage() }}</td>
                            <td>{{ $report->name }}</td>
                            <td>{{ $report->employee_id }}</td>
                            <td>{{ $report->process_project }}</td>
                            <td>{{ $report->evaluation_date }}</td>
                            <td>{{ $report->overall_rating }}</td>
                            <td style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
                                <a class="btn" href="{{ route('qa-evaluation-reports.pdf', $report->id) }}">PDF</a>
                                <a class="btn btn-secondary" href="{{ route('qa-evaluation-reports.show', $report->id) }}">View</a>
                                <a class="btn btn-secondary" href="{{ route('qa-evaluation-reports.edit', $report->id) }}">Edit</a>
                                <form method="POST" action="{{ route('qa-evaluation-reports.destroy', $report->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit" onclick="return confirm('Delete this report?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center;color:#606776;">No reports found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="margin-top:14px;">
            {{ $reports->links() }}
        </div>
    </div>
@endsection

@push('scripts')
<script>
    (function () {
        const form = document.querySelector('form[data-live-search]');
        if (!form) return;
        const input = form.querySelector('input[name="search"]');
        let timer;
        input.addEventListener('input', () => {
            clearTimeout(timer);
            timer = setTimeout(() => form.submit(), 300);
        });
    })();
</script>
@endpush
