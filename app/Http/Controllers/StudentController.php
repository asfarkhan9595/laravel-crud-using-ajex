<?php

namespace App\Http\Controllers;
    use Illuminate\Support\Facades\Validator;
use App\Models\Students;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index() {
        return view('student');
    }


    public function addstudent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules for the image
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        if ($request->hasFile('file')) {
            $file = $request->file('file');
    
            if ($file->isValid()) {
                $fileName = time() . '' . $file->getClientOriginalName();
                $filePath = $file->storeAs('images', $fileName, 'public');
    
                $student = new Students;
                $student->name = $request->name;
                $student->email = $request->email;
                $student->image = $filePath;
                $student->save();
    
                return response()->json(['result' => 'Student Created Successfully']);
            } else {
                return response()->json(['e' => 'Invalid file'], 422);
            }
        } else {
            return response()->json(['e' => 'No file uploaded'], 422);
        }
    }
    
    public function getstudent() {
        $studentlist =Students::all();
        return response()->json(['studentlist'=>$studentlist]);
    }

    public function edit ($id){
        $student =Students::where('id',$id)->get();
        return view ('studentEdit',['student'=>$student]);
    }

    public function update(Request $request) {
        $student = Students::find($request->id);
        $student->name = $request->name;
        $student->email = $request->email;
        
        if($request->file('file')){
            $file = $request->file('file');
            $fileName = time().''.$file->getClientOriginalName();
            $filePath = $file->storeAs('images',$fileName,'public');
            $student->image = $filePath;
        }
        $student->save();
        return response()->json(['result' => 'Student updated successfully']);
    }
    public function destroy($id)
{
    // Find the student by ID
    $student = Students::findOrFail($id);

    // Perform the deletion
    $student->delete();

    // Return a JSON response
    return response()->json(['result' => 'Student deleted successfully']);
}

}
