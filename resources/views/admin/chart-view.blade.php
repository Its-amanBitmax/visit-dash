@extends('admin.layout')

@section('title', 'Chart View')
@section('header', 'Agent Score Chart')

@section('content')
    <div class="page-card" style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;">
        <div>
            <div style="font-size:18px;font-weight:700;">Evaluation Charts</div>
            <div style="color:#606776;">Switch between Agent, QA, and TL averages.</div>
        </div>
        
    </div>

    <div class="page-card" style="display:grid;gap:18px;">
        <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:space-between;align-items:center;">
            <div style="display:flex;gap:10px;flex-wrap:wrap;">
                <button class="btn btn-toggle chart-toggle" data-target="pie">Pie</button>
                <button class="btn btn-toggle chart-toggle" data-target="bar">Bar</button>
                <button class="btn btn-toggle chart-toggle" data-target="line">Line</button>
            </div>
            <div style="display:flex;gap:10px;flex-wrap:wrap;">
                <button class="btn btn-toggle chart-scope" data-scope="agent">Agent</button>
                <button class="btn btn-toggle chart-scope" data-scope="qa">QA</button>
                <button class="btn btn-toggle chart-scope" data-scope="tl">TL</button>
            </div>
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
                        <th>Name</th>
                        <th>Average</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2" style="text-align:center;color:#606776;">No data found.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    const datasets = @json($datasets);
    let activeScope = 'agent';
    const getData = (scope) => ({
        labels: datasets[scope]?.labels || [],
        scores: datasets[scope]?.scores || [],
        label: datasets[scope]?.label || 'Average'
    });
    const dataTableBody = document.querySelector('.table tbody');

    const renderTable = (labels, scores) => {
        dataTableBody.innerHTML = '';
        if (!labels.length) {
            const row = document.createElement('tr');
            row.innerHTML = '<td colspan="2" style="text-align:center;color:#606776;">No data found.</td>';
            dataTableBody.appendChild(row);
            return;
        }
        labels.forEach((label, idx) => {
            const row = document.createElement('tr');
            const score = scores[idx] ?? '';
            row.innerHTML = `<td>${label}</td><td>${score}</td>`;
            dataTableBody.appendChild(row);
        });
    };

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
            labels: getData(activeScope).labels,
            datasets: [{
                data: getData(activeScope).scores,
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
            labels: getData(activeScope).labels,
            datasets: [{
                label: getData(activeScope).label,
                data: getData(activeScope).scores,
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
            labels: getData(activeScope).labels,
            datasets: [{
                label: getData(activeScope).label,
                data: getData(activeScope).scores,
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

    const scopeButtons = document.querySelectorAll('.chart-scope');
    const setScope = (scope) => {
        activeScope = scope;
        const data = getData(scope);

        pieChart.data.labels = data.labels;
        pieChart.data.datasets[0].data = data.scores;
        pieChart.update();

        barChart.data.labels = data.labels;
        barChart.data.datasets[0].data = data.scores;
        barChart.data.datasets[0].label = data.label;
        barChart.update();

        lineChart.data.labels = data.labels;
        lineChart.data.datasets[0].data = data.scores;
        lineChart.data.datasets[0].label = data.label;
        lineChart.update();

        scopeButtons.forEach(btn => {
            btn.classList.toggle('active', btn.dataset.scope === scope);
        });
        renderTable(data.labels, data.scores);
    };
    scopeButtons.forEach(btn => {
        btn.addEventListener('click', () => setScope(btn.dataset.scope));
    });
    setScope('agent');

</script>
@endpush
