<!DOCTYPE html>
<html>
<head>
   <title>Edit Absensi</title>
</head>
<body>

<h2>Edit Absensi Siswa</h2>

<a href="/attendance">Kembali</a>

<br><br>

@if($errors->any())
   <ul style="color: red">
       @foreach($errors->all() as $error)
           <li>{{ $error }}</li>
       @endforeach
   </ul>
@endif

<form action="/attendance/{{ $attendance->id }}" method="POST">
   @csrf
   @method('PUT')

   <label>Nama Siswa</label><br>
   <select name="student_id">
       @foreach($students as $student)
           <option value="{{ $student->id }}"
               {{ $attendance->student_id == $student->id ? 'selected' : '' }}>
               {{ $student->name }} - {{ $student->class }}
           </option>
       @endforeach
   </select>

   <br><br>

   <label>Tanggal</label><br>
   <input type="date" name="date" value="{{ $attendance->date }}">

   <br><br>

   <label>Status</label><br>
   <select name="status">
       <option value="hadir" {{ $attendance->status == 'hadir' ? 'selected' : '' }}>Hadir</option>
       <option value="izin" {{ $attendance->status == 'izin' ? 'selected' : '' }}>Izin</option>
       <option value="sakit" {{ $attendance->status == 'sakit' ? 'selected' : '' }}>Sakit</option>
   </select>

   <br><br>

   <button type="submit">Update</button>
</form>

</body>
</html>
