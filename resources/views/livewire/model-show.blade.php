<div class="overflow-x-auto">
    <table class="table-auto">
        <thead>
            <tr>
                @foreach ($columns as $column)
                    <th>C:{{$column}}</th>
                @endforeach
            </tr>
        </thead>
    </table>
</div>
