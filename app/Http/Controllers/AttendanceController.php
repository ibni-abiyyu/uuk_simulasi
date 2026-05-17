<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AttendanceController extends Controller
{
   public function index(Request $request)
   {
       $search = $request->search;

       $attendances = Attendance::with('student')
           ->when($search, function ($query) use ($search) {
               $query->whereHas('student', function ($q) use ($search) {
                   $q->where('name', 'like', '%' . $search . '%');
               });
           })
           ->latest()
           ->paginate(5);

       $jumlahHadir = Attendance::where('status', 'hadir')->count();

       return view('attendance.index', compact('attendances', 'search', 'jumlahHadir'));
   }

   public function create()
   {
       $students = Student::all();

       return view('attendance.create', compact('students'));
   }

   public function store(Request $request)
   {
       $request->validate([
           'student_id' => [
               'required',
               Rule::unique('attendances')->where(function ($query) use ($request) {
                   return $query
                       ->where('student_id', $request->student_id)
                       ->where('date', $request->date);
               }),
           ],
           'date' => 'required|date',
           'status' => 'required|in:hadir,izin,sakit',
       ], [
           'student_id.unique' => 'Siswa sudah absen pada tanggal tersebut.',
       ]);

       Attendance::create($request->only('student_id', 'date', 'status'));

       return redirect('/attendance')->with('success', 'Absensi berhasil disimpan.');
   }

   public function edit($id)
   {
       $attendance = Attendance::findOrFail($id);
       $students = Student::all();

       return view('attendance.edit', compact('attendance', 'students'));
   }

   public function update(Request $request, $id)
   {
       $attendance = Attendance::findOrFail($id);

       $request->validate([
           'student_id' => [
               'required',
               Rule::unique('attendances')->where(function ($query) use ($request) {
                   return $query
                       ->where('student_id', $request->student_id)
                       ->where('date', $request->date);
               })->ignore($attendance->id),
           ],
           'date' => 'required|date',
           'status' => 'required|in:hadir,izin,sakit',
       ], [
           'student_id.unique' => 'Siswa sudah absen pada tanggal tersebut.',
       ]);

       $attendance->update($request->only('student_id', 'date', 'status'));

       return redirect('/attendance')->with('success', 'Absensi berhasil diperbarui.');
   }

   public function destroy($id)
   {
       $attendance = Attendance::findOrFail($id);
       $attendance->delete();

       return redirect('/attendance')->with('success', 'Absensi berhasil dihapus.');
   }
}

