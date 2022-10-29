<table>
    <tr>
        <td>Judul</td>
        <td><b>Laporan Rekap Kehadiran</b></td>
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
            <th><b>Personil</b></th>
            <th><b>Peran</b></th>
            <th><b>Hari Kehadiran</b></th>
            <th><b>Jam Kehadiran</b></th>
            <th><b>Total Hari Kerja</b></th>
            <th><b>Total Jam Kerja</b></th>
            <th><b>Hari Kerja</b></th>
            <th><b>(-+) Jam Kerja</b></th>
            <th><b>(%) Hari Kehadiran</b></th>
            <th><b>(%) Jam Kehadiran</b></th>
            <th><b>Tidak Absen Pulang</b></th>
            <th><b>Telat Hari</b></th>
            <th><b>Telat Jam</b></th>
            <th><b>Total Hari Izin dan Cuti</b></th>
            <th><b>Total Hari Alpa</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr>
                <td><b>{{ $row->nama }}</b></td>
                <td>{{ $row->peran }}</td>
                <td>{{ $row->hari_kehadiran }}</td>
                <td>{{ $row->jam_kehadiran }}</td>
                <td>{{ $row->total_hari_kerja }}</td>
                <td>{{ $row->total_jam_kerja }}</td>
                <td>{{ $row->kurleb_hari_kerja }}</td>
                <td>{{ $row->kurleb_jam_kerja }}</td>
                <td>{{ $row->persen_hari_kehadiran }}</td>
                <td>{{ $row->persen_jam_kehadiran }}</td>
                <td>{{ $row->tidak_absen_pulang }}</td>
                <td>{{ $row->total_hari_telat }}</td>
                <td>{{ $row->total_jam_telat }}</td>
                <td>{{ $row->total_hari_izin_cuti }}</td>
                <td>{{ $row->total_hari_alpa }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
