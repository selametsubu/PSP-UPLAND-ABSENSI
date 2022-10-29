<table>
    <tr>
        <td>Judul</td>
        <td><b>Laporan Timesheet Bulanan</b></td>
    </tr>
    <tr>
        <td>Personil</td>
        <td><b>{{ $p_user_name }}</b></td>
    </tr>
    <tr>
        <td>Bulan </td>
        <td><b>{{ $p_bulan_name }}</b></td>
    </tr>
</table>
<table>
    <thead>
        <tr>
            <th><b>Personil</b></th>
            <th><b>Peran</b></th>
            @for ($i = 0; $i < $eofMonth; $i++)
                <th><b>{{ $i + 1 }}</b></th>
            @endfor
            <th><b>Total Hari Kehadiran</b></th>
            <th><b>Total Hari Izin dan Cuti</b></th>
            <th><b>Total Alpa</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr>
                <td><b>{{ $row->nama }}</b></td>
                <td>{{ $row->peran }}</td>
                @for ($i = 0; $i < $eofMonth; $i++)
                @php
                    $v = ($i+1);
                    $bg_color = isset($ref[$row->$v]) ? $ref[$row->$v] : '';
                @endphp
                    <td style="background: {{ $bg_color }}">{{ $row->$v }}</td>
                @endfor
                <td>{{ $row->total_hari_kehadiran }}</td>
                <td>{{ $row->total_hari_izin_cuti }}</td>
                <td>{{ $row->total_hari_alpa }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
