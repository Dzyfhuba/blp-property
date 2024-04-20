{{-- Modal content --}}
@if ($model)
{{-- Normalized Pairwise Comparison --}}
<div class="overflow-x-auto">
    <h2 class="text-xl font-black">Normalized Paiwise Comparison</h2>
    <table class="table-auto">
        <thead>
            <tr>
                <th class="px-1">#</th>
                @foreach ($criterion as $criteria)
                    <th class="px-1">C:{{ $criteria }}</th>
                @endforeach
                <th class="px-1">Priority</th>
                <th class="px-1">Line Quality</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($model['pairwise_comparison_normalized'] as $key => $row)
                <tr>
                    <td class="px-1 font-black">{{$key}}</td>
                    @foreach ($row as $item)
                        <td class="px-1">{{$item}}</td>
                    @endforeach
                    <td class="px-1 font-black">{{$model['pairwise_comparison_priority'][$key]}}</td>
                    <td class="px-1 font-black">{{$model['pairwise_comparison_line_quality'][$key]}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Consistency Ratio --}}
<div>
    @php
        $cr = $model['pairwise_comparison_consistency_ratio'];
    @endphp
    <h2 class="text-xl font-black">Consistency Ratio: {{$cr}} @if ($cr<=0.1) (<span class="text-green-500">Consistent</span>) @else(<span class="text-red-500">Inconsistent</span>)@endif</h2>
    <small>Consistency Ratio must be below 0.1</small>
</div>

{{-- Criterion --}}
<div class="overflow-x-auto">
    <h2 class="text-xl font-black">Criterion and Score Alternatives</h2>
    <table class="table-auto">
        <thead>
            <tr>
                <th class="px-1">Criteria</th>
                <th class="px-1">Value</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($model['criterion'] as $key => $value)
                <tr>
                    <td>{{$key}}</td>
                    <td>{{$value}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
