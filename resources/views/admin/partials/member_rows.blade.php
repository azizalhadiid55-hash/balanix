@if ($member->count())
    @foreach ($member as $i => $m)
        <tr>
            <td>{{ $member->firstItem() + $i }}</td>
            <td>{{ $m->id }}</td>
            <td>{{ $m->name }}</td>
            <td>{{ $m->email }}</td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="6">
            <div class=" text-center">Data Member Tidak Ada</div>
        </td>
    </tr>
@endif
