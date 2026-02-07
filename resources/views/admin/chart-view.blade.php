@extends('admin.layout')

@section('title', 'Chart View')
@section('header', 'Agent Score Chart')

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

        .chart-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .chart-controls {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
        }

        .chart-controls__group {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            width: 100%;
        }

        .chart-canvas {
            width: 100%;
            max-height: 360px;
        }

        .chart-panel {
            min-height: 360px;
        }

        .chart-panel canvas {
            height: 360px;
        }

        .chart-table .table {
            min-width: 0;
        }

        .page-card {
            min-width: 0;
        }

        .chart-panel {
            height: clamp(240px, 40vh, 360px);
            overflow: hidden;
        }

        .chart-panel canvas {
            height: 100%;
            display: block;
        }

        .chart-canvas {
            max-height: none;
        }

        .chart-controls__group .btn {
            flex: 0 1 auto;
        }

        @media (max-width: 1200px) {
            .chart-controls__group .btn {
                flex: 1 1 120px;
            }
        }

        @media (max-width: 980px) {
            .chart-controls {
                flex-direction: column;
                align-items: stretch;
            }

            .chart-controls__group {
                justify-content: flex-start;
            }
        }

        @media (max-width: 768px) {
            .chart-header {
                flex-direction: column;
                align-items: stretch;
            }

            .chart-header .btn {
                width: 100%;
            }

            .chart-controls__group .btn {
                flex: 1 1 140px;
                justify-content: center;
            }

            .chart-panel {
                height: clamp(220px, 38vh, 320px);
            }
        }

        @media (max-width: 520px) {
            .chart-controls__group .btn {
                width: 100%;
            }

            .chart-panel {
                height: clamp(200px, 34vh, 280px);
            }

            .chart-table .table th,
            .chart-table .table td {
                font-size: 12px;
            }
        }
    </style>
    @php
        $logoPath = public_path('yello.png');
        $logoData = '';
        if (is_file($logoPath)) {
            $logoData = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));
        }
    @endphp
    <div class="page-card chart-header">
        <div>
            <div style="font-size:18px;font-weight:700;">Evaluation Charts</div>
            <div style="color:#606776;">Switch between Agent, QA, and TL averages.</div>
        </div>
        <div>
            <button id="downloadChartPdf" class="btn">Download PDF</button>
        </div>
        
    </div>

    <div id="chartPdfArea">
        <div id="chartPdfHeader" class="page-card" style="display:none;table-layout:fixed;width:100%;border-top:0;border-bottom:2px solid #dbeafe;background:linear-gradient(90deg,#eff6ff,#ffffff);padding:12px 14px;border-radius:0;">
            <div style="display:table-cell;vertical-align:top;width:50%;">
                <div style="display:inline-flex;align-items:center;gap:8px;padding:3px 8px;border-radius:999px;background:#e0e7ff;color:#1e40af;font-size:10px;font-weight:700;letter-spacing:0.6px;text-transform:uppercase;">Confidential</div>
                <div id="chartHeaderTitle" style="font-size:20px;font-weight:800;letter-spacing:0.4px;margin-top:6px;">Agent Score Chart</div>
                <div style="display:inline-block;margin-top:6px;padding:3px 8px;border-radius:999px;background:#e0e7ff;color:#1e40af;font-size:10px;font-weight:700;letter-spacing:0.3px;">Generated on {{ date('Y-m-d H:i:s') }}</div>
            </div>
            <div style="display:table-cell;vertical-align:top;width:50%;text-align:right;">
                @if ($logoData)
                    <img src="{{ $logoData }}" alt="Logo" style="height:60px;width:auto;margin-bottom:4px;opacity:0.9;">
                @endif
              </div>
        </div>

        <div class="page-card" style="display:grid;gap:18px;">
            <div class="chart-controls">
                <div class="chart-controls__group">
                    <button class="btn btn-toggle chart-toggle" data-target="pie">Pie</button>
                    <button class="btn btn-toggle chart-toggle" data-target="bar">Bar</button>
                    <button class="btn btn-toggle chart-toggle" data-target="line">Line</button>
                </div>
                <div class="chart-controls__group">
                    <button class="btn btn-toggle chart-scope" data-scope="agent">Agent</button>
                    <button class="btn btn-toggle chart-scope" data-scope="qa">QA</button>
                    <button class="btn btn-toggle chart-scope" data-scope="tl">TL</button>
                </div>
            </div>
            <div data-chart="pie" class="chart-panel">
                <div class="chart-title" style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:8px;">Pie Chart</div>
                <canvas id="agentScoreChartPie" width="900" height="360" class="chart-canvas"></canvas>
            </div>
            <div data-chart="bar" class="chart-panel" style="display:none;">
                <div class="chart-title" style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:8px;">Bar Chart</div>
                <canvas id="agentScoreChartBar" width="900" height="360" class="chart-canvas"></canvas>
            </div>
            <div data-chart="line" class="chart-panel" style="display:none;">
                <div class="chart-title" style="font-size:13px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:8px;">Line Chart</div>
                <canvas id="agentScoreChartLine" width="900" height="360" class="chart-canvas"></canvas>
            </div>
        </div>

        <div class="page-card chart-table" style="margin-top: 20px;">
            <div style="font-size:14px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:10px; ">Data</div>
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
                <tfoot>
                    <tr>
                        <td style="font-weight:700;">Overall Average</td>
                        <td style="font-weight:700;" id="chartOverallAverage">-</td>
                    </tr>
                    <tr>
                        <td style="font-weight:700;">Total Count</td>
                        <td style="font-weight:700;" id="chartOverallCount">0</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jspdf@2.5.1/dist/jspdf.umd.min.js"></script>
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
        const totalCount = labels.length;
        const overallAverage = totalCount
            ? (scores.reduce((sum, val) => sum + (Number(val) || 0), 0) / totalCount)
            : 0;
        dataTableBody.innerHTML = '';
        const overallAvgCell = document.getElementById('chartOverallAverage');
        const overallCountCell = document.getElementById('chartOverallCount');
        if (overallAvgCell) {
            overallAvgCell.textContent = totalCount ? overallAverage.toFixed(2) : '-';
        }
        if (overallCountCell) {
            overallCountCell.textContent = totalCount;
        }
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

    const getLegendPosition = () => (window.innerWidth <= 768 ? 'bottom' : 'right');

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
            responsive: true,
            maintainAspectRatio: false,
            radius: '82%',
            layout: {
                padding: 8
            },
            plugins: {
                legend: { position: getLegendPosition() }
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
            responsive: true,
            maintainAspectRatio: false,
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
            responsive: true,
            maintainAspectRatio: false,
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
        const scopeLabel = document.getElementById('chartScopeLabel');
        if (scopeLabel) {
            scopeLabel.textContent = scope.toUpperCase();
        }
        const headerTitle = document.getElementById('chartHeaderTitle');
        if (headerTitle) {
            const titleMap = { agent: 'Agent Score Chart', qa: 'QA Score Chart', tl: 'TL Score Chart' };
            headerTitle.textContent = titleMap[scope] || 'Score Chart';
        }
        const scopeCount = document.getElementById('chartScopeCount');
        if (scopeCount) {
            scopeCount.textContent = data.labels.length;
        }
        renderTable(data.labels, data.scores);
    };
    scopeButtons.forEach(btn => {
        btn.addEventListener('click', () => setScope(btn.dataset.scope));
    });
    setScope('agent');

    window.addEventListener('resize', () => {
        pieChart.options.plugins.legend.position = getLegendPosition();
        pieChart.update();
    });

    const downloadButton = document.getElementById('downloadChartPdf');
    downloadButton?.addEventListener('click', async () => {
        const area = document.getElementById('chartPdfArea');
        if (!area) return;

        const header = document.getElementById('chartPdfHeader');
        if (header) {
            header.style.display = 'table';
        }

        const allToggleButtons = area.querySelectorAll('.chart-toggle');
        const allScopeButtons = area.querySelectorAll('.chart-scope');
        const previousButtonDisplay = [];
        allToggleButtons.forEach((btn, idx) => {
            previousButtonDisplay[idx] = btn.style.display;
            btn.style.display = 'none';
        });
        allScopeButtons.forEach((btn, idx) => {
            previousButtonDisplay[idx + allToggleButtons.length] = btn.style.display;
            btn.style.display = 'none';
        });

        const roundedNodes = area.querySelectorAll('.page-card, .table-wrap, .table');
        const previousRadius = [];
        roundedNodes.forEach((node, idx) => {
            previousRadius[idx] = node.style.borderRadius;
            node.style.borderRadius = '0';
        });

        const chartTitles = area.querySelectorAll('.chart-title');
        const previousTitleDisplay = [];
        chartTitles.forEach((node, idx) => {
            previousTitleDisplay[idx] = node.style.display;
            node.style.display = 'none';
        });

        const canvas = await html2canvas(area, {
            scale: 2,
            useCORS: true,
            backgroundColor: '#ffffff'
        });

        chartTitles.forEach((node, idx) => {
            node.style.display = previousTitleDisplay[idx] || '';
        });
        roundedNodes.forEach((node, idx) => {
            node.style.borderRadius = previousRadius[idx] || '';
        });
        allToggleButtons.forEach((btn, idx) => {
            btn.style.display = previousButtonDisplay[idx] || '';
        });
        allScopeButtons.forEach((btn, idx) => {
            btn.style.display = previousButtonDisplay[idx + allToggleButtons.length] || '';
        });
        if (header) {
            header.style.display = 'none';
        }

        const imgData = canvas.toDataURL('image/png');
        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF({ orientation: 'p', unit: 'pt', format: 'a4' });
        const pageWidth = pdf.internal.pageSize.getWidth();
        const pageHeight = pdf.internal.pageSize.getHeight();
        const imgWidth = pageWidth;
        const imgHeight = canvas.height * (pageWidth / canvas.width);

        let yOffset = 0;
        const pageContentHeight = pageHeight - 40;
        while (yOffset < imgHeight) {
            if (yOffset > 0) {
                pdf.addPage();
            }
            pdf.addImage(imgData, 'PNG', 0, 20 - yOffset, imgWidth, imgHeight);
            yOffset += pageContentHeight;
        }

        pdf.save(`chart-report-${activeScope}.pdf`);
    });

</script>
@endpush
