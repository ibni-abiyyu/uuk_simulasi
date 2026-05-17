

<!DOCTYPE html>
<html>
<head>
   <title>Data Absensi</title>
</head>
<body>

<h2>Data Absensi Siswa</h2>

<p>Jumlah Hadir: {{ $jumlahHadir }}</p>

<a href="/attendance/create">Tambah Absensi</a>

<br><br>

<form method="GET" action="/attendance">
   <input type="text" name="search" placeholder="Cari nama siswa" value="{{ $search }}">
   <button type="submit">Search</button>
</form>

<br>

@if(session('success'))
   <p style="color: green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10" cellspacing="0">
   <tr>
       <th>Nama</th>
       <th>Kelas</th>
       <th>Tanggal</th>
       <th>Status</th>
       <th>Aksi</th>
   </tr>

   @forelse($attendances as $attendance)
       <tr>
           <td>{{ $attendance->student->name }}</td>
           <td>{{ $attendance->student->class }}</td>
           <td>{{ $attendance->date }}</td>
           <td>{{ $attendance->status }}</td>
           <td>
               <a href="/attendance/{{ $attendance->id }}/edit">Edit</a>

               <form action="/attendance/{{ $attendance->id }}" method="POST" style="display:inline">
                   @csrf
                   @method('DELETE')
                   <button type="submit" onclick="return confirm('Yakin hapus data?')">
                       Hapus
                   </button>
               </form>
           </td>
       </tr>
   @empty
       <tr>
           <td colspan="5">Data absensi belum ada.</td>
       </tr>
   @endforelse
</table>

<br>

{{ $attendances->links() }}

</body>
</html>
