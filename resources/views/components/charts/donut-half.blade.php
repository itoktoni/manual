@props([
    'id' => 'donutHalfChart',
    'title' => 'Half Doughnut Chart',
    'data' => [],
    'height' => 400,
    'colors' => ['#5470c6', '#91cc75', '#fac858', '#ee6666', '#73c0de']
])

<div class="chart-container" style="display: flex; flex-direction: column;">
    <div id="{{ $id }}" style="width: 100%; height: {{ $height }}px;"></div>
    <div class="legend" style="width: 100%; padding: 20px;">
        <ul style="list-style: none; padding: 0; display: flex; flex-wrap: wrap; justify-content: flex-start; gap: 10px;">
            @foreach($data as $index => $item)
            <li style="display: flex; align-items: center;">
                <span style="width: 20px; height: 20px; background: {{ $colors[$index % count($colors)] }}; margin-right: 10px; border-radius: 3px;"></span>
                {{ $item['name'] }}
            </li>
            @endforeach
        </ul>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var chart = echarts.init(document.getElementById('{{ $id }}'));
    var colors = @json($colors);

    var option = {
        title: {
            text: '{{ $title }}',
            left: 'center',
            top: 20
        },
        tooltip: {
            trigger: 'item',
            formatter: '{a} <br/>{b}: {c}% ({d}%)'
        },
        series: [{
            name: 'Access From',
            type: 'pie',
            radius: ['40%', '70%'],
            center: ['50%', '60%'],
            startAngle: 180,
            endAngle: 360,
            data: @json($data).map(function(item, index) {
                return {
                    value: item.value,
                    name: item.name,
                    itemStyle: {
                        color: colors[index % colors.length]
                    }
                };
            }),
            emphasis: {
                itemStyle: {
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            },
            label: {
                show: true,
                position: 'outside',
                formatter: '{b}: {d}%'
            }
        }]
    };
    chart.setOption(option);

    // Resize handler
    window.addEventListener('resize', function() {
        chart.resize();
    });
});
</script>