<table>
    <tr>
        <td>Judul</td>
        <td><b>Laporan Timesheet</b></td>
    </tr>
    <tr>
        <td>Personil</td>
        <td><b>{{ $p_user_name }}</b></td>
    </tr>
    <tr>
        <td>Tanggal</td>
        <td><b>{{ $p_date_from }} - {{ $p_date_to }}</b></td>
    </tr>
</table>
<table>
    <thead>
        <tr>
            <th><b>Tanggal</b></th>
            <th><b>Hari</b></th>
            <th><b>Absen Datang</b></th>
            <th><b>Absen Pulang</b></th>
            <th><b>Telat (Jam)</b></th>
            <th><b>Total Jam Kerja</b></th>
            <th><b>Keterangan</b></th>
            <th><b>Aktifitas/Catatan</b></th>
            <th><b>Status Spot Datang</b></th>
            <th><b>Lokasi Datang</b></th>
            <th><b>Prov/Kab/Kec/Desa Datang</b></th>
            <th><b>Status Spot Pulang</b></th>
            <th><b>Lokasi Pulang</b></th>
            <th><b>Prov/Kab/Kec/Desa Pulang</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr>
                <td style="color:{{ $row->tgl_hari_color }}">{{ Carbon\Carbon::make($row->tgl)->format('d-m-Y') }}</td>
                <td>{{ $row->hari }}</td>
                <td>{{ $row->absen_datang }}</td>
                <td>{{ $row->absen_pulang }}</td>
                <td>{{ $row->telat_jam }}</td>
                <td>{{ $row->total_jam }}</td>
                <td style="color:{{ $row->keterangan_color }}">{{ $row->keterangan }}</td>
                <td>{{ $row->aktifitas }}</td>
                <td style="color:{{ $row->datang_status_spot_color }}">{{ $row->datang_status_spot }}</td>
                <td>{{ $row->datang_lokasi }}</td>
                <td>{{ $row->datang_wilayah }}</td>
                <td style="color:{{ $row->pulang_status_spot_color }}">{{ $row->pulang_status_spot }}</td>
                <td>{{ $row->pulang_lokasi }}</td>
                <td>{{ $row->pulang_wilayah }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
