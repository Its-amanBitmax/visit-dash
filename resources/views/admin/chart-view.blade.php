@extends('admin.layout')

@section('title', 'Chart View')
@section('header', 'Agent Score Chart')

@section('content')
    <div class="page-card" style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;">
        <div>
            <div style="font-size:18px;font-weight:700;">Agent Average Scores</div>
            <div style="color:#606776;">Top 10 agents by average score.</div>
        </div>
        
    </div>

    <div class="page-card" style="display:grid;gap:18px;">
        <div style="display:flex;gap:10px;flex-wrap:wrap;">
            <button class="btn btn-toggle chart-toggle" data-target="pie">Pie</button>
            <button class="btn btn-toggle chart-toggle" data-target="bar">Bar</button>
            <button class="btn btn-toggle chart-toggle" data-target="line">Line</button>
        </div>
        <div data-chart="pie">
            <div style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:8px;">Pie Chart</div>
            <canvas id="agentScoreChartPie" width="900" height="360" style="width:100%;max-height:360px;"></canvas>
        </div>
        <div data-chart="bar" style="display:none;">
            <div style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:8px;">Bar Chart</div>
            <canvas id="agentScoreChartBar" width="900" height="360" style="width:100%;max-height:360px;"></canvas>
        </div>
        <div data-chart="line" style="display:none;">
            <div style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:8px;">Line Chart</div>
            <canvas id="agentScoreChartLine" width="900" height="360" style="width:100%;max-height:360px;"></canvas>
        </div>
    </div>

    <div class="page-card">
        <div style="font-size:14px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:10px;">Data</div>
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Agent</th>
                        <th>Average Score</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($labels as $i => $label)
                        <tr>
                            <td>{{ $label }}</td>
                            <td>{{ $scores[$i] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" style="text-align:center;color:#606776;">No data found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    const labels = @json($labels);
    const scores = @json($scores);

    const pieCtx = document.getElementById('agentScoreChartPie');
    const barCtx = document.getElementById('agentScoreChartBar');
    const lineCtx = document.getElementById('agentScoreChartLine');

    const colors = [
        '#2563eb', '#60a5fa', '#93c5fd', '#1d4ed8', '#3b82f6',
        '#7dd3fc', '#0ea5e9', '#38bdf8', '#0284c7', '#0ea5e9'
    ];

    const pieChart = new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels,
            datasets: [{
                data: scores,
                backgroundColor: colors,
                borderWidth: 1,
                borderColor: '#ffffff'
            }]
        },
        options: {
            plugins: {
                legend: { position: 'right' }
            }
        }
    });

    const barChart = new Chart(barCtx, {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label: 'Average Score',
                data: scores,
                backgroundColor: colors,
                borderColor: '#1d4ed8',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true, max: 100 }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });

    const lineChart = new Chart(lineCtx, {
        type: 'line',
        data: {
            labels,
            datasets: [{
                label: 'Average Score',
                data: scores,
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37, 99, 235, 0.15)',
                fill: true,
                tension: 0.3,
                pointRadius: 3
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true, max: 100 }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });

    const toggles = document.querySelectorAll('.chart-toggle');
    const sections = document.querySelectorAll('[data-chart]');
    const setActive = (target) => {
        sections.forEach(section => {
            section.style.display = section.dataset.chart === target ? 'block' : 'none';
        });
        toggles.forEach(btn => {
            btn.classList.toggle('active', btn.dataset.target === target);
        });
    };
    toggles.forEach(btn => {
        btn.addEventListener('click', () => setActive(btn.dataset.target));
    });
    setActive('pie');

</script>
@endpush
