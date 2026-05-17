<!DOCTYPE html>
<html>
<head>
   <title>Form Absensi</title>
</head>
<body>

<h2>Form Absensi Siswa</h2>

<a href="/attendance">Kembali</a>

<br><br>

@if($errors->any())
   <ul style="color: red">
       @foreach($errors->all() as $error)
           <li>{{ $error }}</li>
       @endforeach
   </ul>
@endif

<form action="/attendance/store" method="POST">
   @csrf

   <label>Nama Siswa</label><br>
   <select name="student_id">
       <option value="">-- Pilih Siswa --</option>
       @foreach($students as $student)
           <option value="{{ $student->id }}">
               {{ $student->name }} - {{ $student->class }}
           </option>
       @endforeach
   </select>

   <br><br>

   <label>Tanggal</label><br>
   <input type="date" name="date">

   <br><br>

   <label>Status</label><br>
   <select name="status">
       <option value="">-- Pilih Status --</option>
       <option value="hadir">Hadir</option>
       <option value="izin">Izin</option>
       <option value="sakit">Sakit</option>
   </select>

   <br><br>

   <button type="submit">Simpan</button>
</form>

</body>
</html>
