@extends('admin.layout')

@section('title', 'Agent Chat Evaluations')
@section('header', 'Agent Chat Evaluations')

@section('content')
    <div class="page-card" style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;">
        <div>
            <div style="font-size:18px;font-weight:700;">All Evaluations</div>
            <div style="color:#606776;">Manage and review agent chat evaluations.</div>
        </div>
        <div style="display:flex;gap:10px;flex-wrap:wrap;align-items:center;">
            <form method="GET" action="{{ route('agent-chat-evaluations.index') }}" data-live-search
                  style="display:flex;gap:8px;align-items:center;">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search agent / project / evaluator"
                       style="padding:10px 12px;border-radius:12px;border:1px solid #e5e7eb;font-size:14px;">
            </form>
            <a class="btn btn-secondary" href="{{ route('agent-chat-evaluations.pdf.all') }}">Download All PDF</a>
            <a class="btn" href="{{ route('agent-chat-evaluations.create') }}">Create New</a>
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
                        <th>ID</th>
                        <th>Agent</th>
                        <th>Eval Date</th>
                        <th>Overall</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($evaluations as $evaluation)
                        <tr>
                            <td>{{ $loop->iteration + ($evaluations->currentPage() - 1) * $evaluations->perPage() }}</td>
                            <td>{{ $evaluation->agent_id }} - {{ $evaluation->agent_name }}</td>
                            <td>{{ $evaluation->column001 }}</td>
                            <td>{{ $evaluation->overall_score }}</td>
                            <td>{{ $evaluation->created_at }}</td>
                            <td style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
                                <a class="btn" href="{{ route('agent-chat-evaluations.pdf', $evaluation->id) }}">PDF</a>
                                <a class="btn btn-secondary" href="{{ route('agent-chat-evaluations.show', $evaluation->id) }}">View</a>
                                <a class="btn btn-secondary" href="{{ route('agent-chat-evaluations.edit', $evaluation->id) }}">Edit</a>
                                <form method="POST" action="{{ route('agent-chat-evaluations.destroy', $evaluation->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit" onclick="return confirm('Delete this evaluation?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center;color:#606776;">No evaluations found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="margin-top:14px;">
            {{ $evaluations->links() }}
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
